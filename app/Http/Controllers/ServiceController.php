<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceInfoRequest;
use App\Interfaces\ConfigurationCompanyServiceInterface;
use App\Mail\ServiceInfoMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ServiceController extends Controller
{
    public function __construct(
        private ConfigurationCompanyServiceInterface $configService
    ) {}

    public function index()
    {
        $services = DB::table('type_services')
            ->orderBy('status', 'asc')
            ->orderBy('name')
            ->get();

        return view('services', compact('services'));
    }

    public function sendInfo(StoreServiceInfoRequest $request)
    {
        try {
            $configs = $this->configService->getAll();
            $whatsapp = '312 2777482';

            foreach ($configs as $config) {
                if ($config->name === 'cellphone') {
                    $whatsapp = $config->value;
                }
            }

            Mail::to($request->email)->send(new ServiceInfoMail($whatsapp));

            return response()->json([
                'success' => true,
                'message' => '¡Gracias! Te enviaremos la información a tu correo pronto.',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error al enviar correo de información de servicios: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'email' => $request->email,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al enviar el correo. Intenta nuevamente.',
            ], 500);
        }
    }
}
