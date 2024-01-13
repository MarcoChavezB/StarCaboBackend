<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Mail\SendEmailConfirmacion;
use App\Mail\SendEmailRechazo;
use Illuminate\Contracts\View\View;

class EmailController extends Controller
{
    function sendEmail (Request $request){
        $tiketData = $request->all();
        Mail::to('marco1102004@gmail.com')->send(new SendEmail($tiketData));
        return response()->json(['message' => 'Correo enviado con éxito']);
    }


    function sendEmailRechazo (Request $request){
        $email = $request->input('email');
        Mail::to($email)->send(new SendEmailRechazo());
        return response()->json(['message' => 'Correo enviado con éxito']);
    }

    function sendEmailAceptar (Request $request){
        $email = $request->input('email');
        Mail::to($email)->send(new SendEmailConfirmacion());
        return View('RedirectViews.email-enviado');
    }

    


}
