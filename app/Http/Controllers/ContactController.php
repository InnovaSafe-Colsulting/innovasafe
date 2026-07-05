<?php

namespace App\Http\Controllers;

use App\Interfaces\ContactServiceInterface;
use App\Interfaces\ConfigurationCompanyServiceInterface;
use App\Http\Requests\StoreAdvisoryRequest;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\StoreDemoRequest;
use App\Models\TypeService;
use App\Models\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdquirirProductoMail;
use App\Mail\SolicitudAsesoriaMail;

class ContactController extends Controller
{
    public function __construct(
        private ContactServiceInterface $contactService,
        private ConfigurationCompanyServiceInterface $configService
    ) {}

    public function showForm()
    {
        $services = TypeService::where('status', '1')->get();
        $configs = $this->configService->getAll();

        $companyConfig = [];
        foreach ($configs as $config) {
            $companyConfig[$config->name] = $config->value;
        }

        return view('contact', compact('services', 'companyConfig'));
    }

    public function index()
    {
        return response()->json($this->contactService->getAll());
    }

    public function show(int $id)
    {
        return response()->json($this->contactService->getById($id));
    }

    public function store(StoreContactRequest $request)
    {
        try {
            $data = [
                'names' => $request->names,
                'last_names' => $request->last_names,
                'email' => $request->email,
                'cellphone' => $request->cellphone,
                'service_id' => $request->service_id,
                'message' => $request->message,
            ];

            $this->contactService->create($data);

            return response()->json([
                'success' => true,
                'message' => 'Mensaje enviado correctamente. Te contactaremos pronto.',
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error al guardar contacto: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'data' => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al procesar tu solicitud. Intenta nuevamente.',
            ], 500);
        }
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'names' => 'string|max:120',
            'last_names' => 'string|max:120',
            'company' => 'string|max:120',
            'cellphone' => 'string|max:12',
            'service_id' => 'exists:type_services,id',
            'message' => 'string',
        ]);

        return response()->json($this->contactService->update($id, $data));
    }

    public function destroy(int $id)
    {
        $this->contactService->delete($id);
        return response()->json(null, 204);
    }

    public function storeAdvisory(StoreAdvisoryRequest $request)
    {
        try {
            $data = [
                'names'      => $request->names,
                'last_names' => $request->last_names,
                'email'      => $request->email,
                'cellphone'  => $request->phone,
                'service_id' => $request->type_service[0],
            ];

            $this->contactService->create($data);

            $serviceNombres = DB::table('type_services')
                ->whereIn('id', $request->type_service)
                ->pluck('name')
                ->implode(', ');

            $datos = [
                'names'             => $request->names,
                'last_names'        => $request->last_names,
                'email'             => $request->email,
                'phone'             => $request->phone,
                'type_service_name' => $serviceNombres,
            ];

            $destinatarios = [
                'gerenciatecnologica@innovasafeconsulting.com',
                'gerenciageneral@innovasafeconsulting.com',
                'gerenciaproyectos@innovasafeconsulting.com',
            ];
            foreach ($destinatarios as $email) {
                Mail::to($email)->send(new SolicitudAsesoriaMail($datos));
            }

            $config = DB::table('configuration_company')->where('id', 2)->first();
            if ($config && !empty($config->value)) {
                $numero = preg_replace('/[^0-9]/', '', $config->value);
                $mensaje = urlencode(
                    "Nueva solicitud de asesoría:\n" .
                    "Cliente: {$datos['names']} {$datos['last_names']}\n" .
                    "Email: {$datos['email']}\n" .
                    "Teléfono: {$datos['phone']}\n" .
                    "Servicio: {$datos['type_service_name']}"
                );
                $url = "https://api.callmebot.com/whatsapp.php?phone=57{$numero}&text={$mensaje}&apikey=YOUR_API_KEY";
                try {
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                    curl_exec($ch);
                    curl_close($ch);
                } catch (\Exception $e) {
                    Log::warning('WhatsApp send failed: ' . $e->getMessage());
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Solicitud enviada correctamente. Te contactaremos pronto.',
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error al guardar solicitud de asesoría: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'data'  => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al procesar tu solicitud. Intenta nuevamente.',
            ], 500);
        }
    }
    
    public function storeNewClient(Request $request)
    {
        try {
            // Log para debug
            Log::info('storeNewClient - Datos recibidos:', $request->all());
            
            $validation = [
                'email' => 'required|email'
            ];
            
            // Validar campos según el tipo de formulario - revisar qué campos tienen valores
            if ($request->filled('nombre_nuevo') && $request->filled('telefono_nuevo')) {
                // Formulario de nuevo cliente
                $validation['nombre_nuevo'] = 'required|string|max:255';
                $validation['telefono_nuevo'] = 'required|string|max:20';
            } elseif ($request->filled('nombre_mas') && $request->filled('telefono_mas')) {
                // Formulario de comprar más servicios
                $validation['nombre_mas'] = 'required|string|max:255';
                $validation['telefono_mas'] = 'required|string|max:20';
                $validation['servicio_adicional'] = 'required|exists:type_services,id';
            } else {
                // Si no hay campos de nombre y teléfono, es inválido
                return response()->json([
                    'success' => false,
                    'message' => 'Faltan datos requeridos (nombre y teléfono).',
                ], 422);
            }
            
            Log::info('storeNewClient - Reglas de validación:', $validation);
            
            $request->validate($validation);
            
            // Determinar datos según el tipo de formulario
            $nombre = $request->nombre_nuevo ?? $request->nombre_mas ?? '';
            $telefono = $request->telefono_nuevo ?? $request->telefono_mas ?? '';
            $mensaje = $request->custom_message ?? 'Solicitud de renovación desde modal';
            $serviceId = $request->servicio_adicional ?? null;
            
            // Si se seleccionó un servicio, obtener su nombre para el mensaje
            if ($serviceId) {
                $serviceName = DB::table('type_services')->where('id', $serviceId)->value('name');
                if ($serviceName) {
                    $mensaje = "Solicitud de servicio adicional: {$serviceName} - " . $mensaje;
                }
            }
            
            Log::info('storeNewClient - Datos procesados:', [
                'nombre' => $nombre,
                'email' => $request->email,
                'telefono' => $telefono,
                'service_id' => $serviceId,
                'mensaje' => $mensaje
            ]);
            
            // Guardar en la tabla contacts
            $contactData = [
                'names' => $nombre,
                'email' => $request->email,
                'cellphone' => $telefono,
                'message' => $mensaje,
                'service_id' => $serviceId
            ];
            
            $this->contactService->create($contactData);
            
            // Enviar email a servicioalcliente@innovasafeconsulting.com
            $emailData = [
                'nombre' => $nombre,
                'email' => $request->email,
                'telefono' => $telefono,
                'mensaje' => $mensaje,
                'servicio' => $serviceId ? DB::table('type_services')->where('id', $serviceId)->value('name') : null
            ];
            
            $emailContent = "Nueva solicitud de cliente:\n\n" .
                "Nombre: {$emailData['nombre']}\n" .
                "Email: {$emailData['email']}\n" .
                "Teléfono: {$emailData['telefono']}\n";
            
            if ($emailData['servicio']) {
                $emailContent .= "Servicio solicitado: {$emailData['servicio']}\n";
            }
            
            $emailContent .= "Mensaje: {$emailData['mensaje']}";
            
            \Illuminate\Support\Facades\Mail::raw(
                $emailContent,
                function ($message) {
                    $message->to('servicioalcliente@innovasafeconsulting.com')
                           ->subject('Nueva Solicitud de Renovación - InnovaSafe');
                }
            );
            
            return response()->json([
                'success' => true,
                'message' => 'Solicitud enviada correctamente. Nos pondremos en contacto contigo pronto.',
            ], 201);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('storeNewClient - Error de validación:', [
                'errors' => $e->errors(),
                'data' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Por favor verifica los datos ingresados.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error al procesar solicitud de renovación: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al procesar tu solicitud. Intenta nuevamente.',
            ], 500);
        }
    }
    
    public function storeAdquirirProducto(Request $request)
    {
        try {
            $request->validate([
                'names'        => 'required|string|max:120',
                'last_names'   => 'required|string|max:120',
                'email'        => 'required|email',
                'phone'        => 'required|string|max:20',
                'type_service' => 'required|exists:type_services,id',
                'productos'    => 'required|string',
            ]);

            $productos = json_decode($request->productos, true);
            if (empty($productos)) {
                return response()->json(['success' => false, 'errors' => ['productos' => ['Debes seleccionar al menos un producto.']]], 422);
            }

            $serviceNombre = DB::table('type_services')->where('id', $request->type_service)->value('name');

            $cliente = [
                'names'             => $request->names,
                'last_names'        => $request->last_names,
                'email'             => $request->email,
                'phone'             => $request->phone,
                'type_service_name' => $serviceNombre,
                'message'           => $request->message ?? null,
            ];

            // Guardar en contacts
            $this->contactService->create([
                'names'      => $request->names,
                'last_names' => $request->last_names,
                'email'      => $request->email,
                'cellphone'  => $request->phone,
                'service_id' => $request->type_service,
                'message'    => 'Solicitud de adquisición de producto: ' . implode(', ', array_column($productos, 'name')),
            ]);

            // Enviar correos
            $destinatarios = [
                'gerenciatecnologica@innovasafeconsulting.com',
                'gerenciageneral@innovasafeconsulting.com',
                'gerenciaproyectos@innovasafeconsulting.com',
            ];
            foreach ($destinatarios as $email) {
                Mail::to($email)->send(new AdquirirProductoMail($cliente, $productos));
            }

            // Enviar WhatsApp via CallMeBot
            $config = DB::table('configuration_company')->where('id', 2)->first();
            if ($config && !empty($config->value)) {
                $numero = preg_replace('/[^0-9]/', '', $config->value);
                $mensaje = urlencode(
                    "Nueva solicitud de adquisición:\n" .
                    "Cliente: {$cliente['names']} {$cliente['last_names']}\n" .
                    "Email: {$cliente['email']}\n" .
                    "Teléfono: {$cliente['phone']}\n" .
                    "Productos: " . implode(', ', array_column($productos, 'name'))
                );
                $url = "https://api.callmebot.com/whatsapp.php?phone=57{$numero}&text={$mensaje}&apikey=YOUR_API_KEY";
                try {
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                    curl_exec($ch);
                    curl_close($ch);
                } catch (\Exception $e) {
                    Log::warning('WhatsApp send failed: ' . $e->getMessage());
                }
            }

            return response()->json(['success' => true], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error en storeAdquirirProducto: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error al procesar la solicitud.'], 500);
        }
    }

    public function validateEmailForRenewal(Request $request)
    {
        try {
            $email = $request->input('email');
            
            if (!$email) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email requerido'
                ], 400);
            }
            
            // Verificar si el usuario existe en users o contacts
            $userExists = DB::table('users')->where('email', $email)->exists();
            $contactExists = DB::table('contacts')->where('email', $email)->exists();
            
            // Si no existe en ninguna tabla, es completamente nuevo
            if (!$userExists && !$contactExists) {
                return response()->json([
                    'success' => true,
                    'userExists' => false,
                    'contactExists' => false,
                    'hasPendingOrders' => false,
                    'services' => [],
                    'hasServices' => false
                ]);
            }
            
            // Si existe en contacts pero no en users, también mostrar formulario nuevo cliente
            if ($contactExists && !$userExists) {
                return response()->json([
                    'success' => true,
                    'userExists' => false,
                    'contactExists' => true,
                    'hasPendingOrders' => false,
                    'services' => [],
                    'hasServices' => false
                ]);
            }
            
            // Si existe en users, verificar órdenes pending
            $user = DB::table('users')->where('email', $email)->first();
            
            $hasPendingOrders = DB::table('orders')
                ->where('user_id', $user->id)
                ->where('status', 'pending')
                ->exists();
                
            // Si tiene órdenes pending, mostrar mensaje especial
            if ($hasPendingOrders) {
                // Obtener todos los servicios disponibles
                $allServices = DB::table('type_services')
                    ->where('status', '1')
                    ->select('id', 'name', 'description')
                    ->get();
                    
                return response()->json([
                    'success' => true,
                    'userExists' => true,
                    'contactExists' => $contactExists,
                    'hasPendingOrders' => true,
                    'services' => [],
                    'hasServices' => false,
                    'availableServices' => $allServices
                ]);
            }
            
            // Buscar servicios cancelados/expirados del usuario en user_services
            $userServices = DB::table('user_services')
                ->join('plans', 'user_services.plan_id', '=', 'plans.id')
                ->where('user_services.user_id', $user->id)
                ->whereIn('user_services.status', ['canceled', 'expired'])
                ->select('plans.name', 'user_services.billing_period', 'user_services.expires_at', 'user_services.status')
                ->get();
                
            return response()->json([
                'success' => true,
                'userExists' => true,
                'contactExists' => $contactExists,
                'hasPendingOrders' => false,
                'services' => $userServices,
                'hasServices' => $userServices->count() > 0
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error en validateEmailForRenewal: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error interno del servidor'
            ], 500);
        }
    }
}
