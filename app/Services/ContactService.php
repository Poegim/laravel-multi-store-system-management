<?php

namespace App\Services;

use App\Models\Contact;
use App\Repositories\ContactRepository\ContactRepositoryInterface;

class ContactService
{
    public function __construct(
        protected ContactRepositoryInterface $contactRepository
    ) {}

    public function store(array $data): bool 
    {
        return $this->contactRepository->store($data);
    }

    public function update(array $data, Contact $contact): bool
    {
        return $this->contactRepository->update($data, $contact);
    }

}