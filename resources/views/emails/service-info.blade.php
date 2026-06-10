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
                            <h2 style="color: #0a0f2c; font-size: 20px; margin: 0 0 20px;">Hola, queremos que seas parte de nuestro día a día</h2>

                            <p style="color: #4a5568; font-size: 15px; line-height: 1.7; margin: 0 0 20px;">
                                A continuación te enviamos la información de nuestros servicios. Cuando desees comunicarte con nosotros, solamente contáctanos a nuestro WhatsApp:
                            </p>

                            {{-- WhatsApp Button --}}
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 0 0 30px;">
                                <tr>
                                    <td align="center">
                                        <a href="https://wa.me/57{{ str_replace(' ', '', $whatsapp) }}" style="display: inline-block; background-color: #25d366; color: #ffffff; text-decoration: none; padding: 14px 30px; border-radius: 8px; font-size: 15px; font-weight: 600;">
                                            📱 WhatsApp: +57 {{ $whatsapp }}
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="color: #4a5568; font-size: 15px; line-height: 1.7; margin: 0 0 20px;">
                                Adjunto encontrarás nuestro portafolio comercial con toda la información detallada de nuestros servicios y soluciones.
                            </p>

                            {{-- Divider --}}
                            <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 30px 0;">

                            {{-- Services highlight --}}
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="background-color: #f7fafc; border-radius: 8px; padding: 20px;">
                                        <p style="color: #0a0f2c; font-size: 14px; font-weight: 600; margin: 0 0 10px;">Nuestros servicios incluyen:</p>
                                        <ul style="color: #4a5568; font-size: 13px; line-height: 2; margin: 0; padding-left: 20px;">
                                            @foreach($activeServices as $service)
                                                <li>{{ $service->name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            </table>
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
