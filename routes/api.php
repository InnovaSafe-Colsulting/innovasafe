<?php

use App\Http\Controllers\Api\ServiceAccessController;
use Illuminate\Support\Facades\Route;

Route::post('/check-access', [ServiceAccessController::class, 'check']);
