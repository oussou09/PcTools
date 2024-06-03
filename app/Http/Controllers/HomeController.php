<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        return view('Home-Page.home');
    }

    public function about() {
        return view('Home-Page.about');
    }

    public function contact() {
        return view('Home-Page.contact');
    }
    public function store(Request $request) {
        $request->validate([
            'email' => 'email|required|string',
            'subject' => 'required|string|min:10',
            'description' => 'required|string|min:20',
        ]);
        $contactdata = [
            'email' => strip_tags($request->input('email')),
            'subject' => strip_tags($request->input('subject')),
            'description' => strip_tags($request->input('description'))
        ];

        Contact::create($contactdata);

        // dd($request);
        return redirect()->route('home.home')->with('message', 'Thank you! '.$request->email.'<br>Your message has been sent successfully. Response within 24 hours on business days.');
    }
}
