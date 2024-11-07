<?php

namespace App\Livewire\Contacts\Company;

use App\Models\Contacts\Company;
use App\Traits\Searchable;
use App\Traits\Sortable;
use Livewire\Component;

class IndexCompanies extends Component
{
    use Searchable;
    use Sortable;

    public function render()
    {
        return view('livewire.contacts.company.index-companies', [
            'companies' => Company::paginate(10),
        ]);
    }
}
