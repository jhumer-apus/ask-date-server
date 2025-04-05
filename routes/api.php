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

    $subject = "CASUAL DATE WITH " . $girl_name;

    try {
        // Attempt to send the email
        Mail::to($email)->send(new CasualDateMail($subject, $message));

        // If email is sent successfully, return a 200 response
        return response()->json([
            'message' => 'Email sent successfully!'
        ], 200);
        
    } catch (\Exception $e) {
        // In case of error, return a 500 error with a failure message
        return response()->json([
            'error' => 'Failed to send the email. Please try again later.',
            'details' => $e->getMessage()
        ], 500);
    }
});