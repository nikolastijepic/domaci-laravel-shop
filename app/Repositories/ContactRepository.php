<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{
    public function all()
    {
        return Contact::all();
    }

    public function create(array $validated)
    {
        return Contact::create($validated);
    }

    public function update(Contact $contact, array $validated)
    {
        return $contact->update($validated);
    }

    public function delete(Contact $contact)
    {
        return $contact->delete();
    }
}
