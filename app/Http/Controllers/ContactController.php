<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        return view('Front.contact-us');
    }
    public function store(ContactRequest $request)
    {
        Contact::create($request->validated());
        return redirect()->back()->with('success', 'Your message has been sent successfully');
    }
}
