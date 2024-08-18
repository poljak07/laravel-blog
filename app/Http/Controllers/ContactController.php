<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()

    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $validatedData = request()->validate([
           'first-name' => ['required', 'min:3'],
           'last-name' => ['required', 'min:3'],
           'email' => ['required', 'email'],
            'message' => ['required', 'min:10'],
        ]);




        return back()->with('success', 'Thank you for contacting us. We will reach you soon!');


    }
}
