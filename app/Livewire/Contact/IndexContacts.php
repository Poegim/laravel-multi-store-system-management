<?php

namespace App\Livewire\Contact;

use App\Models\Contact;
use App\Traits\Searchable;
use App\Traits\Sortable;
use Livewire\Component;
use Livewire\WithPagination;

class IndexContacts extends Component
{
    use Searchable;
    use Sortable;
    use WithPagination;

    public function render()
    {
        $sortDirection = $this->sortAsc ? 'asc' : 'desc';

        $contacts = Contact::where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('identification_number', 'like', '%'.$this->search.'%')
                    ->orWhere('phone', 'like', '%'.$this->search.'%')
                    ->orderBy($this->sortField, $sortDirection)
                    ->paginate(10);

        return view('livewire.contact.index-contacts', compact('contacts'));
    }
}
