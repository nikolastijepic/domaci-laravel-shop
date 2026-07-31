<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
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

    public function sendContact(StoreContactRequest $request)
    {
        $validated = $request->validated();

        $this->contactRepository->create($validated);

        return redirect()->back()->with('success', 'Poruka je uspesno poslata.');
    }

    public function getContact(Contact $contact)
    {
        return view('edit-contact', compact('contact'));
    }

    public function editContact(UpdateContactRequest $request, Contact $contact)
    {
        $validated = $request->validated();

        $this->contactRepository->update($contact, $validated);

        return redirect()->route('all.contacts');
    }

    public function deleteContact(Contact $contact)
    {
        $this->contactRepository->delete($contact);

        return redirect()->back();
    }
}
