<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Repositories\ContactRepository;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(
        private ContactRepository $contactRepository
    ){}
    public function index()
    {
        return view('contact');
    }

    public function getAllContacts()
    {
        $allContacts = $this->contactRepository->all();

        return view('all-contacts', compact('allContacts'));
    }

    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'subject' => 'required|string|min:3|max:100',
            'message' => 'required|string|min:5|max:1000'
        ]);

        $this->contactRepository->create($validated);

        return redirect()->back()->with('success', 'Poruka je uspesno poslata.');
    }

    public function getContact(Contact $contact)
    {
        return view('edit-contact', compact('contact'));
    }

    public function editContact(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'subject' => 'required|string|min:3|max:100',
            'message' => 'required|string|min:5|max:1000'
        ]);

        $this->contactRepository->update($contact, $validated);

        return redirect()->route('all.contacts');
    }

    public function deleteContact(Contact $contact)
    {
        $this->contactRepository->delete($contact);

        return redirect()->back();
    }
}
