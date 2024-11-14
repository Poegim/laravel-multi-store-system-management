<?php

namespace App\Repositories\ContactRepository ;

use App\Models\Contact;

class ContactRepository implements ContactRepositoryInterface
{
    public function store(array $data) {
        $contact = new Contact();
        $contact = $this->associate($contact, $data);
        $contact->user_id = auth()->user()->id;
        return $contact->save();
    }

    public function update(array $data, Contact $contact) {
        $contact = $this->associate($contact, $data);
        return $contact->save();
    }

    private function associate(Contact $contact, array $data)
    {
        $contact->name = $data['name'];
        $contact->surname = $data['surname'];
        $contact->identification_number = $data['identification_number'];
        $contact->type = $data['type'];
        $contact->city = $data['city'];
        $contact->postcode = $data['postcode'];
        $contact->street = $data['street'];
        $contact->building_number = $data['building_number'];
        $contact->apartment_number = $data['apartment_number'];
        $contact->email = $data['email'];
        $contact->phone = $data['phone'];
        $contact->second_phone = $data['second_phone'];
        $contact->www = $data['www'];
        $contact->description = $data['description'];
        $contact->user_id = auth()->user()->id;
        return $contact;
    }
}
