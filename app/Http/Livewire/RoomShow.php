<?php

namespace App\Http\Livewire;

use App\Models\Professor;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\Subject;
use Carbon\Carbon;
use Livewire\Component;

class RoomShow extends Component
{
    public $addModal = false;
    public $updateModal = false;
    public $deleteModal = false;

    public $subjects;
    public $professors;
    public $schedules;

    public $events = [];

    public $roomId;

    public $schedule = [
        'room_id' => '',
        'professor_id' => '',
        'subject_id' => '',
        'remarks' => '',
        'date_from' => '',
        'date_to' => '',
    ];

    protected $listeners = ['showAddModal', 'showUpdateModal', 'showDeleteModal'];

    protected $rules = [
        'schedule.room_id' => 'required|exists:rooms,id',
        'schedule.professor_id' => 'required|exists:professors,id',
        'schedule.subject_id' => 'required|exists:subjects,id',
        'schedule.remarks' => 'required',
        'schedule.date_from' => 'required',
        'schedule.date_to' => 'required',
    ];

    public function mount()
    {
        $this->professors = Professor::get(['id', 'first_name', 'last_name']);
        $this->subjects = Subject::get(['id', 'subject']);
        $this->roomId = request()->route('room');
        $this->schedules = Schedule::where('room_id', $this->roomId)->get();


        foreach ($this->schedules as $schedule) {
            $this->events[] = [
                'title' => $schedule->professor->first_name . ' ' . $schedule->professor->last_name,
                'start' => $schedule->date_from,
                'end' => $schedule->date_to,
            ];
        }
    }

    public function render()
    {
        return view('livewire.room-show');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function showAddModal()
    {
        $this->reset('schedule');
        $this->addModal = true;
    }


    public function showUpdateModal(Schedule $schedule)
    {
        $this->schedule = $schedule;
        $this->updateModal = true;
    }

    public function showDeleteModal(Schedule $schedule)
    {
        $this->schedule = $schedule;
        $this->toggleDeleteModal();
    }


    public function toggleDeleteModal()
    {
        $this->deleteModal = !$this->deleteModal;
    }

    public function updateComponent($msg = '', $title = '', $type = 'success')
    {
        $this->emitTo(RoomScheduleTable::class, 'pg:eventRefresh-default');
        $this->emit('showToastNotification', ['type' => $type, 'message' => $msg, 'title' => $title]);
    }


    public function store()
    {
        $this->validate();

        $schedule = Schedule::where('room_id', $this->roomId)
            ->whereBetween('date_from', [Carbon::parse($this->schedule['date_from'])->subMinutes(30), $this->schedule['date_to']])
            ->whereBetween('date_to',  [Carbon::parse($this->schedule['date_from'])->subMinutes(30), $this->schedule['date_to']])
            ->first();

        if ($schedule) {
            $this->addModal = false;
            return $this->emit('showToastNotification', ['type' => 'error', 'message' => 'Schedule not available', 'title' => 'Reserved']);
        }

        Schedule::create($this->schedule);
        $this->addModal = false;
        $this->updateComponent('Schedule has been created!', 'Created');
    }

    public function updatedSchedule($value, $key)
    {
        if ($key == 'date_from') {
            $this->schedule['date_to'] = $value;
        }
    }

    public function update()
    {
        $this->validate();

        $schedule = Schedule::where('id', '<>', $this->schedule['id'])->where('room_id', $this->roomId)
            ->whereBetween('date_from', [Carbon::parse($this->schedule['date_from'])->subMinutes(30), $this->schedule['date_to']])
            ->whereBetween('date_to',  [Carbon::parse($this->schedule['date_from'])->subMinutes(30), $this->schedule['date_to']])
            ->first();

        if ($schedule) {
            $this->addModal = false;
            return $this->emit('showToastNotification', ['type' => 'error', 'message' => 'Schedule not available', 'title' => 'Reserved']);
        }

        $this->schedule->save();
        $this->updateModal = false;
        $this->updateComponent('Schedule updated successfully!', 'Updated');
    }

    public function destroy()
    {
        $this->schedule->delete();
        $this->deleteModal = false;
        $this->updateComponent('Schedule was deleted successfully!', 'Deleted');
    }
}
