<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

class EmailController extends Controller
{
    function sendEmail (Request $request){
        $tiketData = $request->all();
        Mail::to('marco1102004@gmail.com')->send(new SendEmail($tiketData));
        return response()->json(['message' => 'Correo enviado con éxito']);
    }
}
