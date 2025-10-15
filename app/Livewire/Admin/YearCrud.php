<?php

namespace App\Livewire\Admin;

use App\Models\Year;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;


class YearCrud extends Component
{

 use WithPagination;

    public $yearId;
    public $name;
    public $search = '';
    public $isOpen = false;
    public $isEdit = false;

    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255|unique:years,name',
        ];

        if ($this->isEdit && $this->yearId) {
            $rules['name'] = 'required|string|max:255|unique:years,name,' . $this->yearId;
        }

        return $rules;
    }

    protected $messages = [
        'name.required' => 'El nombre es obligatorio.',
        'name.unique' => 'Este año ya existe.',
        'name.max' => 'El nombre no puede tener más de 255 caracteres.',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $years = Year::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('name', 'desc')
            ->paginate(10);

        return view('livewire.admin.year-crud', [
            'years' => $years
        ])->layout('layouts.app');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isEdit = false;
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $year = Year::findOrFail($id);
        $this->yearId = $year->id;
        $this->name = $year->name;
        $this->isEdit = true;
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate();

        Year::create([
            'name' => $this->name,
        ]);

        $this->dispatch('year-created');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function update()
    {
        $this->validate();

        $year = Year::findOrFail($this->yearId);
        $year->update([
            'name' => $this->name,
        ]);

        $this->dispatch('year-updated');
        $this->closeModal();
        $this->resetInputFields();
    }

    #[On('delete-year')]
    public function delete($id)
    {
        Year::findOrFail($id)->delete();
        $this->dispatch('year-deleted');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
        $this->resetValidation();
    }

    private function resetInputFields()
    {
        $this->yearId = null;
        $this->name = '';
    }




}
