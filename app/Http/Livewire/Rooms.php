<?php

namespace App\Http\Livewire;

use App\Models\Room;
use Livewire\Component;

class Rooms extends Component
{
    public $addModal = false;
    public $updateModal = false;
    public $deleteModal = false;
    public $room = [
        'room' => '',
        'description' => '',
        'location' => '',
    ];

    protected $listeners = ['showAddModal', 'showUpdateModal', 'showDeleteModal'];

    protected $rules = [
        'room.room' => 'required',
        'room.description' => 'nullable',
        'room.location' => 'required',
    ];

    public function render()
    {
        return view('livewire.rooms');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function showAddModal()
    {
        $this->room = [
            'room' => '',
            'description' => '',
            'location' => '',
        ];
        $this->addModal = true;
    }


    public function showUpdateModal(Room $room)
    {
        $this->room = $room;
        $this->updateModal = true;
    }

    public function showDeleteModal(Room $room)
    {
        $this->room = $room;
        $this->toggleDeleteModal();
    }

    public function toggleDeleteModal()
    {
        $this->deleteModal = !$this->deleteModal;
    }

    public function updateComponent($msg = '', $title = '', $type = 'success')
    {
        $this->emitTo(RoomTable::class, 'pg:eventRefresh-default');
        $this->emit('showToastNotification', ['type' => $type, 'message' => $msg, 'title' => $title]);
    }


    public function store()
    {
        Room::create($this->room);
        $this->addModal = false;
        $this->updateComponent('Room data has been created!', 'Created');
    }

    public function update()
    {
        $this->room->save();
        $this->updateModal = false;
        $this->updateComponent('Room updated successfully!', 'Updated');
    }

    public function destroy()
    {
        $this->room->delete();
        $this->deleteModal = false;
        $this->updateComponent('Room data was deleted successfully!', 'Deleted');
    }

}
