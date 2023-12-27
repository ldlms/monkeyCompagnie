<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Newsletter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newsletter = Newsletter::all();
        return Inertia::render('Admin/AdminNews',[
            'news' => $newsletter
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mail' => 'required|email|unique:newsletters,mail'
        ]);
        Newsletter::create($data);

        return redirect()->back();
    }



    
    public function destroy(String $id)
    {
        $newsletter = Newsletter::findOrFAil($id);
        $newsletter->delete();

        return redirect()->back();
    }
}
