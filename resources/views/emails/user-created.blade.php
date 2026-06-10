<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f7; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f7; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">

                    {{-- Header --}}
                    <tr>
                        <td style="background-color: #01020e; padding: 40px 40px 30px; text-align: center;">
                            <h1 style="color: #ffffff; font-size: 22px; margin: 0 0 8px;">InnovaSafe Consulting</h1>
                            <p style="color: #2596be; font-size: 12px; letter-spacing: 2px; margin: 0; text-transform: uppercase;">Seguridad · Calidad · Innovación</p>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding: 40px;">
                            <h2 style="color: #0a0f2c; font-size: 20px; margin: 0 0 20px;">Nuevo usuario creado</h2>

                            <p style="color: #4a5568; font-size: 15px; line-height: 1.7; margin: 0 0 20px;">
                                Se ha creado un nuevo usuario en el sistema. A continuación los detalles:
                            </p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 0 0 30px; background-color: #f7fafc; border-radius: 8px; padding: 20px;">
                                <tr>
                                    <td style="padding: 10px 0;">
                                        <strong style="color: #0a0f2c;">Nombre:</strong>
                                        <span style="color: #4a5568;">{{ $newUser->names }} {{ $newUser->last_names }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0;">
                                        <strong style="color: #0a0f2c;">Correo:</strong>
                                        <span style="color: #4a5568;">{{ $newUser->email }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0;">
                                        <strong style="color: #0a0f2c;">Celular:</strong>
                                        <span style="color: #4a5568;">{{ $newUser->cellphone ?? 'No registrado' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0;">
                                        <strong style="color: #0a0f2c;">Rol:</strong>
                                        <span style="color: #4a5568;">{{ $newUser->role->role ?? 'Sin rol' }}</span>
                                    </td>
                                </tr>
                            </table>

                            <p style="color: #4a5568; font-size: 15px; line-height: 1.7; margin: 0;">
                                Puedes gestionar este usuario desde el panel de administración.
                            </p>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background-color: #01020e; padding: 30px 40px; text-align: center;">
                            <p style="color: #ffffff; font-size: 14px; font-weight: 600; margin: 0 0 5px;">InnovaSafe Consulting SAS</p>
                            <p style="color: #718096; font-size: 12px; margin: 0;">Impulsamos organizaciones seguras, eficientes y sostenibles.</p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
