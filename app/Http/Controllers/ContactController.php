<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evenement;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{

    public function index(){
        $now = Carbon::now();
        $thirtyDaysFromNow = $now->copy()->addDays(30);        
        
        return $evenements = Evenement::where('date','>',$now)
        ->where('date', '<', $thirtyDaysFromNow)
        ->orderByDesc('date')
        ->get();
    }

    public function submitForm(Request $request)
    {
        // dd($request);
        // Valider la requête
        $data = $request->validate([
            'nom' => 'required',
            'email' => 'required|email',
            'demande' => 'required',
            'mess' => 'required',
        ]);
        // dd($data);
        // Envoi d'un email
        Mail::to('leodelmas31@gmail.com')->send(new ContactMail(
            $data['nom'],
            $data['email'],
            $data['demande'],
            $data['mess'],
        ));
        // Renvoyer une réponse
        // dd($data);
        return redirect()->back();
    }
}
