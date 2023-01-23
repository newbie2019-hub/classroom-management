<?php

namespace App\Http\Livewire;

use App\Models\Professor;
use Livewire\Component;

class Professors extends Component
{

    public $addModal = false;
    public $updateModal = false;
    public $deleteModal = false;
    public $professor = [
        'first_name' => '',
        'middle_name' => '',
        'last_name' => '',
        'gender' => '',
        'contact' => '',
        'address' => '',
        'email' => '',
    ];

    protected $listeners = ['showAddModal', 'showUpdateModal', 'showDeleteModal'];

    protected $rules = [
        'professor.first_name' => 'required',
        'professor.middle_name' => 'nullable',
        'professor.last_name' => 'required',
        'professor.gender' => 'required',
        'professor.contact' => 'required',
        'professor.address' => 'required',
        'professor.email' => 'required|email',
    ];

    public function render()
    {
        return view('livewire.professors');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function showAddModal()
    {
        $this->professor = [
            'first_name' => '',
            'middle_name' => '',
            'last_name' => '',
            'gender' => '',
            'contact' => '',
            'address' => '',
            'email' => '',
        ];
        $this->addModal = true;
    }

    public function showUpdateModal(Professor $professor)
    {
        $this->professor = $professor;
        $this->updateModal = true;
    }

    public function showDeleteModal(Professor $professor)
    {
        $this->professor = $professor;
        $this->toggleDeleteModal();
    }

    public function toggleDeleteModal()
    {
        $this->deleteModal = !$this->deleteModal;
    }

    public function updateComponent($msg = '', $title = '', $type = 'success')
    {
        $this->emitTo(ProfessorTable::class, 'pg:eventRefresh-default');
        $this->emit('showToastNotification', ['type' => $type, 'message' => $msg, 'title' => $title]);
    }

    public function store()
    {
        Professor::create($this->professor);
        $this->addModal = false;
        $this->updateComponent('Professor\'s data has been created!', 'Created');
    }

    public function update()
    {
        $this->professor->save();
        $this->updateModal = false;
        $this->updateComponent('Professor updated successfully!', 'Updated');
    }

    public function destroy()
    {
        $this->professor->delete();
        $this->deleteModal = false;
        $this->updateComponent('Professor\'s data was deleted successfully!', 'Deleted');
    }
}
