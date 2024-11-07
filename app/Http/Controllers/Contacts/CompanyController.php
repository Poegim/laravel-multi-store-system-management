<?php

namespace App\Http\Controllers\Contacts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(){
        return view('contacts.company.index');
    }

    public function create(){
        return 'create';
    }

    public function store() {
        return 'store';
    }

    public function edit() {
        return 'edit';
    }

    public function update() {
        return 'update';
    }
}
