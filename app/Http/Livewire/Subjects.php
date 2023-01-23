<?php

namespace App\Http\Livewire;

use App\Models\Professor;
use App\Models\Subject;
use Livewire\Component;

class Subjects extends Component
{
    public $addModal = false;
    public $updateModal = false;
    public $deleteModal = false;
    public $subject = [
        'subject' => '',
        'professor_id' => '',
        'description' => '',
        'units' => '',
    ];

    protected $listeners = ['showAddModal', 'showUpdateModal', 'showDeleteModal'];

    protected $rules = [
        'subject.subject' => 'required',
        'subject.professor_id' => 'required|exists:professors,id',
        'subject.description' => 'required',
        'subject.units' => 'required',
    ];

    public function render()
    {
        $professors = Professor::get(['id', 'first_name', 'last_name']);
        return view('livewire.subjects', compact('professors'));
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function showAddModal()
    {
        $this->subject = [
            'subject' => '',
            'professor_id' => '',
            'description' => '',
            'units' => '',
        ];
        $this->addModal = true;
    }


    public function showUpdateModal(Subject $subject)
    {
        $this->subject = $subject;
        $this->updateModal = true;
    }

    public function showDeleteModal(Subject $subject)
    {
        $this->subject = $subject;
        $this->toggleDeleteModal();
    }

    public function toggleDeleteModal()
    {
        $this->deleteModal = !$this->deleteModal;
    }

    public function updateComponent($msg = '', $title = '', $type = 'success')
    {
        $this->emitTo(SubjectTable::class, 'pg:eventRefresh-default');
        $this->emit('showToastNotification', ['type' => $type, 'message' => $msg, 'title' => $title]);
    }


    public function store()
    {
        Subject::create($this->subject);
        $this->addModal = false;
        $this->updateComponent('Subject data has been created!', 'Created');
    }

    public function update()
    {
        $this->subject->save();
        $this->updateModal = false;
        $this->updateComponent('Subject updated successfully!', 'Updated');
    }

    public function destroy()
    {
        $this->subject->delete();
        $this->deleteModal = false;
        $this->updateComponent('Subject has deleted successfully!', 'Deleted');
    }

}
