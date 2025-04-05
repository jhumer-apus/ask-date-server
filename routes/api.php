<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

use App\Mail\CasualDateMail;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/send-mail', function (Request $request) {
    $girl_name = $request["girl_name"];

    $message = $request['message'];
    $email = $request['email'];

    $subject = "CASUAL DATE WITH ".$girl_name;

    Mail::to($email)->send(new CasualDateMail($subject, $message));
});