<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0;padding:0;background-color:#f0f4f8;font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f0f4f8;padding:40px 0;">
    <tr>
        <td align="center">
            <table width="620" cellpadding="0" cellspacing="0" style="background-color:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 8px 32px rgba(0,0,0,0.12);">

                {{-- Header --}}
                <tr>
                    <td style="background:linear-gradient(135deg,#01020e 0%,#0a1628 50%,#2268bd 100%);padding:40px;text-align:center;">
                        <p style="color:#2596be;font-size:11px;letter-spacing:3px;margin:0 0 10px;text-transform:uppercase;font-weight:600;">InnovaSafe Consulting</p>
                        <h1 style="color:#ffffff;font-size:26px;margin:0 0 8px;font-weight:800;letter-spacing:-0.5px;">Nueva Solicitud de Asesoría</h1>
                        <p style="color:#93c5fd;font-size:13px;margin:0;">Un cliente está interesado en recibir asesoría</p>
                        <div style="margin-top:20px;">
                            <span style="display:inline-block;background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.3);color:#ffffff;font-size:12px;padding:6px 18px;border-radius:20px;font-weight:600;">
                                💼 Solicitud de Asesoría
                            </span>
                        </div>
                    </td>
                </tr>

                {{-- Datos del cliente --}}
                <tr>
                    <td style="padding:36px 40px 0;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="background:linear-gradient(135deg,#f8faff,#eef2ff);border-radius:12px;padding:24px;border-left:4px solid #2268bd;">
                                    <p style="color:#0a0f2c;font-size:13px;font-weight:700;margin:0 0 16px;text-transform:uppercase;letter-spacing:1px;">
                                        👤 Datos del Cliente
                                    </p>
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="padding:6px 0;">
                                                <table width="100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="140" style="color:#6b7280;font-size:13px;font-weight:600;">Nombre completo:</td>
                                                        <td style="color:#0a0f2c;font-size:13px;font-weight:700;">{{ $datos['names'] }} {{ $datos['last_names'] }}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:6px 0;border-top:1px solid #e5e7eb;">
                                                <table width="100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="140" style="color:#6b7280;font-size:13px;font-weight:600;">Correo electrónico:</td>
                                                        <td style="color:#2268bd;font-size:13px;font-weight:700;">{{ $datos['email'] }}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:6px 0;border-top:1px solid #e5e7eb;">
                                                <table width="100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="140" style="color:#6b7280;font-size:13px;font-weight:600;">Teléfono:</td>
                                                        <td style="color:#0a0f2c;font-size:13px;font-weight:700;">{{ $datos['phone'] }}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:6px 0;border-top:1px solid #e5e7eb;">
                                                <table width="100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="140" style="color:#6b7280;font-size:13px;font-weight:600;">Tipo de servicio:</td>
                                                        <td style="color:#0a0f2c;font-size:13px;font-weight:700;">{{ $datos['type_service_name'] }}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- Alerta acción --}}
                <tr>
                    <td style="padding:24px 40px 0;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="background:linear-gradient(135deg,#fef3c7,#fde68a);border-radius:10px;padding:16px 20px;border-left:4px solid #f59e0b;">
                                    <p style="color:#92400e;font-size:13px;font-weight:700;margin:0 0 4px;">⚡ Acción Requerida</p>
                                    <p style="color:#78350f;font-size:13px;margin:0;">Este cliente está esperando ser contactado. Comunícate con él a la brevedad posible para brindarle la asesoría solicitada.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- Footer --}}
                <tr>
                    <td style="padding:36px 40px;text-align:center;">
                        <hr style="border:none;border-top:1px solid #e5e7eb;margin:0 0 24px;">
                        <p style="color:#0a0f2c;font-size:14px;font-weight:700;margin:0 0 4px;">InnovaSafe Consulting SAS</p>
                        <p style="color:#9ca3af;font-size:12px;margin:0 0 4px;">Impulsamos organizaciones seguras, eficientes y sostenibles.</p>
                        <p style="color:#d1d5db;font-size:11px;margin:0;">Este correo fue generado automáticamente desde el sitio web.</p>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>
</html>
