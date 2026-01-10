<?php 

use App\Services\ExternalApiAuth;
use Illuminate\Support\Facades\Route;


Route::post('/get-token', [ExternalApiAuth::class, 'getToken']);

Route::get('/get-medicines', [ExternalApiAuth::class, 'getMedicine']);

Route::get('/get-medicine-price', [ExternalApiAuth::class, 'getMedicinePrice']);
