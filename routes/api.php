<?php
use Illuminate\Support\Facades\Route;

$sendRoute=config("mobileLogin.sendRoute",'api/mobile/send');
$verifyRoute=config("mobileLogin.verifyRoute",'api/mobile/verify');

Route::post($sendRoute,[\MobileLogin\http\controller\Authenticate::class,"send"]);
Route::post($verifyRoute,[\MobileLogin\http\controller\Authenticate::class,"verify"]);
