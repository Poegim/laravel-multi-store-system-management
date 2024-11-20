<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Services\ContactService;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;

class ContactController extends Controller
{

    public function __construct(
        protected ContactService $contactService
        ) {}

    public function index() {
        return view('contacts.index');
    }

    public function create() {
        return view('contacts.create');
    }

    public function store(StoreContactRequest $request)
    {
        $this->contactService->store($request->validated());
        session()->flash('flash.banner', __('contact_successfully_created!'));
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('contact.index');
    }

    public function edit(Contact $contact) {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Contact $contact, UpdateContactRequest $request) 
    {
        $this->contactService->update($request->validated(), $contact);
        session()->flash('flash.banner', __('contact_successfully_updated!'));
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('contact.index');
    }


}
