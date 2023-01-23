<?php

namespace App\Http\Livewire;

use App\Models\Professor;
use Livewire\Component;
use Livewire\WithPagination;

class Professors extends Component
{
    use WithPagination;

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

    protected $listeners = ['showUpdateModal', 'showDeleteModal'];

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

    public function update()
    {
        $this->professor->save();
        $this->updateModal = false;
        $this->emitTo(ProfessorTable::class, 'pg:eventRefresh-default');
        $this->emit('showToastNotification', ['type' => 'success', 'message' => 'Professor updated successfully!', 'title' => 'Success']);
    }

    public function destroy()
    {
        $this->professor->delete();
        $this->deleteModal = false;
        $this->emit('showToastNotification', ['type' => 'success', 'message' => 'Professor\'s data was deleted successfully!', 'title' => 'Success']);
        $this->emitTo(ProfessorTable::class, 'pg:eventRefresh-default');
    }
}
