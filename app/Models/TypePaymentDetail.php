<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TypePaymentDetail extends Model
{
    protected $fillable = [
        'id_payment_detail', 'agreement', 'reference', 'bank',
        'account_type', 'account_number', 'holder', 'nit',
        'cellphone', 'value', 'status'
    ];

    public function typePayment(): BelongsTo
    {
        return $this->belongsTo(TypePayment::class, 'id_payment_detail');
    }
}
