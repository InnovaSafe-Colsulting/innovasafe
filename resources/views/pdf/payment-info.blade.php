<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #1f2937;
            position: relative;
            margin: 0;
            padding: 40px;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.05;
            z-index: -1;
        }
        .watermark img {
            width: 350px;
            height: 350px;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 3px solid #2268bd;
            padding-bottom: 20px;
        }
        .header img {
            width: 60px;
            height: 60px;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 22px;
            color: #0a0f2c;
            margin: 5px 0;
        }
        .header p {
            font-size: 12px;
            color: #6b7280;
        }
        .payment-type-badge {
            text-align: center;
            margin: 20px 0;
        }
        .payment-type-badge span {
            background-color: #2268bd;
            color: #ffffff;
            padding: 8px 24px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        .details-table th,
        .details-table td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        .details-table th {
            background-color: #f3f4f6;
            font-size: 13px;
            color: #374151;
            width: 40%;
        }
        .details-table td {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 11px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
        }
        .bank-name {
            text-align: center;
            margin: 15px 0;
            font-size: 18px;
            font-weight: bold;
            color: #0a0f2c;
        }
    </style>
</head>
<body>
    <div class="watermark">
        <img src="{{ public_path('images/home/company-icon.png') }}">
    </div>

    <div class="header">
        <img src="{{ public_path('images/home/company-icon.png') }}">
        <h1>InnovaSafe Consulting</h1>
        <p>Datos para realizar tu pago</p>
    </div>

    <div class="payment-type-badge">
        <span>{{ $paymentType->name }}</span>
    </div>

    @if($paymentType->name === 'Consignación Bancaria' && $detail->bank)
        <p class="bank-name">{{ $detail->bank }}</p>
    @endif

    <table class="details-table">
        @if($detail->agreement)
        <tr>
            <th>Convenio</th>
            <td>{{ $detail->agreement }}</td>
        </tr>
        @endif
        @if($detail->reference)
        <tr>
            <th>Referencia</th>
            <td>{{ $detail->reference }}</td>
        </tr>
        @endif
        @if($detail->bank)
        <tr>
            <th>Banco</th>
            <td>{{ $detail->bank }}</td>
        </tr>
        @endif
        @if($detail->account_type)
        <tr>
            <th>Tipo de Cuenta</th>
            <td>{{ $detail->account_type }}</td>
        </tr>
        @endif
        @if($detail->account_number)
        <tr>
            <th>Número de Cuenta</th>
            <td>{{ $detail->account_number }}</td>
        </tr>
        @endif
        @if($detail->holder)
        <tr>
            <th>Titular</th>
            <td>{{ $detail->holder }}</td>
        </tr>
        @endif
        @if($detail->nit)
        <tr>
            <th>NIT</th>
            <td>{{ $detail->nit }}</td>
        </tr>
        @endif
    </table>

    <div class="footer">
        <div style="background-color: #fffbeb; border: 1px solid #f59e0b; border-radius: 8px; padding: 15px; margin-bottom: 20px; text-align: left;">
            <p style="font-size: 12px; color: #92400e; margin: 0;">
                Una vez realices el pago, envía el comprobante al correo 
                <strong>servicioalcliente@innovasafeconsulting.com</strong> 
                para verificar tu pago y comunicarnos contigo.
            </p>
        </div>
        <p>Documento generado el {{ now()->format('d/m/Y H:i') }} — InnovaSafe Consulting</p>
    </div>
</body>
</html>
