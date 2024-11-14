<?php

namespace App\Repositories\ContactRepository ;

use App\Models\Contact;

interface ContactRepositoryInterface
{
    public function store(array $data);
    public function update(array $data, Contact $product);
}