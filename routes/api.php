<?php

use App\Http\Controllers\Api\ServiceAccessController;
use Illuminate\Support\Facades\Route;

Route::post('/activate-service', [ServiceAccessController::class, 'activateService']);
