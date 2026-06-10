<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class UserService extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_id',
        'order_id',
        'payment_date',
        'payment_type',
        'billing_period',
        'expires_at',
        'status',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'expires_at' => 'date',
    ];

    /**
     * Relación con el usuario
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con el plan
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Relación con la orden
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Calcular fecha de expiración basada en billing_period
     */
    public static function calculateExpirationDate($paymentDate, $billingPeriod)
    {
        $payment = Carbon::parse($paymentDate);
        
        if ($billingPeriod === 'monthly') {
            // Si es mensual, expira el último día del mes siguiente
            return $payment->addMonth()->endOfMonth();
        } else {
            // Si es anual, expira el último día del mismo mes del año siguiente
            return $payment->addYear()->endOfMonth();
        }
    }

    /**
     * Obtener servicios activos del usuario
     */
    public static function getActiveUserServices($userId)
    {
        return self::with(['plan'])
            ->where('user_id', $userId)
            ->where('status', 'active')
            ->where('expires_at', '>=', now())
            ->get();
    }

    /**
     * Obtener servicios expirados/cancelados del usuario
     */
    public static function getInactiveUserServices($userId)
    {
        return self::with(['plan'])
            ->where('user_id', $userId)
            ->where(function($query) {
                $query->where('status', 'canceled')
                      ->orWhere('expires_at', '<', now());
            })
            ->get();
    }
}