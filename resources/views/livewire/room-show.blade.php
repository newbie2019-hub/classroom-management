<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rooms') }}
        </h2>
    </x-slot>

    <div class="pb-10 pt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6">
                <div class="mb-4">
                    <p class="text-lg text-medium">Rooms Schedule</p>
                    <p class="text-gray-600">Shown on the table are the schedule for the rooms.</p>
                </div>
                <div class="row mb-8">
                    <div id="calendar"></div>
                </div>
                <livewire:room-schedule-table :room-id="request()->route('room')" />
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <x-jet-dialog-modal wire:model="addModal" max-width="md">
        <x-slot name="title">
            {{ __('Add Schedule') }}
        </x-slot>
        <x-slot name="subtitle">
            Please make sure that the data are valid and to fill-in all the fields.
        </x-slot>

        <x-slot name="content">
            <div class="relative mt-2" id="professor_id">
                <select wire:model="schedule.professor_id" required name="professor_id"
                    class="block w-full p-3 text-sm text-gray-900 bg-transparent border-gray-300 rounded-lg appearance-none peer border dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600">
                    <option selected value="">
                        Select Professor
                    </option>
                    @forelse ($professors as $professor)
                        <option value="{{ $professor->id }}">
                            {{ $professor->first_name . ' ' . $professor->last_name }}
                        </option>
                    @empty
                        <option value="" disabled>
                            No Professors added.
                        </option>
                    @endforelse
                </select>
                <p
                    class="absolute px-2 text-gray-600 duration-150 ease-in-out bg-white pointer-events-none left-2 peer-valid:left-1 peer-valid:top-0 peer-valid:-translate-y-2 top-3 peer-valid:text-xs">
                    Select Professor</p>
            </div>

            <div class="relative mt-3" id="subject_id">
                <select wire:model.debounce="schedule.subject_id" required name="subject_id"
                    class="block w-full p-3 text-sm text-gray-900 bg-transparent border-gray-300 rounded-lg appearance-none peer border dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600">
                    <option selected value="">
                        Select Subject
                    </option>
                    @forelse ($subjects as $subject)
                        <option value="{{ $subject->id }}">
                            {{ $subject->subject }}
                        </option>
                    @empty
                        <option value="" disabled>
                            No Subject available.
                        </option>
                    @endforelse
                </select>
                <p
                    class="absolute px-2 text-gray-600 duration-150 ease-in-out bg-white pointer-events-none left-2 peer-valid:left-1 peer-valid:top-0 peer-valid:-translate-y-2 top-3 peer-valid:text-xs">
                    Select Subject</p>
            </div>

            <div class="relative mt-2 mb-2.5">
                <x-forms.floating-input wire:model="schedule.remarks" type="text" id="remarks" name="remarks"
                    class="block w-full " />
                <x-forms.floating-label for="remarks" :value="__('Remarks')" />
            </div>

            <x-datetime-picker :min="now()" min-time="06:00" max-time="21:00" parse-format="YYYY-MM-DD HH:mm"
                interval="30" label="" id="date_from" class="mt-2.5 py-3 shadow-none text-gray-600"
                placeholder="Date From" wire:model="schedule.date_from" />

            <x-datetime-picker min="{{ now() }}" min-time="06:00" max-time="22:00"
                parse-format="YYYY-MM-DD HH:mm" interval="30" id="date_to" label=""
                class="mt-2.5 py-3 shadow-none text-gray-600" placeholder="Date To" wire:model="schedule.date_to" />
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('addModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-buttons.success-button class="ml-3" wire:click="store" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-buttons.success-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Update Modal -->
    <x-jet-dialog-modal wire:model="updateModal" max-width="md">
        <x-slot name="title">
            {{ __('Update Data') }}
        </x-slot>
        <x-slot name="subtitle">
            Please make sure that the data are valid and to fill-in all the fields.
        </x-slot>

        <x-slot name="content">
            <div class="relative mt-4">
                <select wire:model.debounce="schedule.professor_id" required name="professor_id" id="professor_id"
                    class="block w-full p-3 text-sm text-gray-900 bg-transparent border-gray-300 rounded-lg appearance-none peer border dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600">
                    <option selected value="">
                        Select Professor
                    </option>
                    @forelse ($professors as $professor)
                        <option value="{{ $professor->id }}">
                            {{ $professor->first_name . ' ' . $professor->last_name }}
                        </option>
                    @empty
                        <option value="" disabled>
                            No Professors added.
                        </option>
                    @endforelse
                </select>
                <p
                    class="absolute px-2 text-gray-600 duration-150 ease-in-out bg-white pointer-events-none left-2 peer-valid:left-1 peer-valid:top-0 peer-valid:-translate-y-2 top-3 peer-valid:text-xs">
                    Select Professor</p>
            </div>

            <div class="relative mt-4">
                <select wire:model.debounce="schedule.subject_id" required name="subject_id" id="subject_id"
                    class="block w-full p-3 text-sm text-gray-900 bg-transparent border-gray-300 rounded-lg appearance-none peer border dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600">
                    <option selected value="">
                        Select Subject
                    </option>
                    @forelse ($subjects as $subject)
                        <option value="{{ $subject->id }}">
                            {{ $subject->subject }}
                        </option>
                    @empty
                        <option value="" disabled>
                            No Subject available.
                        </option>
                    @endforelse
                </select>
                <p
                    class="absolute px-2 text-gray-600 duration-150 ease-in-out bg-white pointer-events-none left-2 peer-valid:left-1 peer-valid:top-0 peer-valid:-translate-y-2 top-3 peer-valid:text-xs">
                    Select Professor</p>
            </div>

            <div class="relative mt-2">
                <x-forms.floating-input wire:model.debounce="schedule.remarks" type="text" id="remarks"
                    name="remarks" class="block w-full " />
                <x-forms.floating-label for="remarks" :value="__('Remarks')" />
            </div>

            <x-datetime-picker :min="now()" id="date_from" min-time="06:00" max-time="21:00" label=""
                interval="30" parse-format="YYYY-MM-DD HH:mm" class="mt-2.5 py-3 shadow-none text-gray-600"
                placeholder="Date From" wire:model.defer="schedule.date_from" />

            <x-datetime-picker min="{{ now() }}" id="date_to" min-time="06:00" max-time="22:00"
                interval="30" parse-format="YYYY-MM-DD HH:mm" label=""
                class="mt-2.5 py-3 shadow-none text-gray-600" placeholder="Date To"
                wire:model.defer="schedule.date_to" />
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('updateModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-buttons.success-button class="ml-3" wire:click="update" wire:loading.attr="disabled">
                {{ __('Update') }}
            </x-buttons.success-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="deleteModal">
        <x-slot name="title">
            {{ __('Confirm Delete') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to this data? Once this account is deleted, all of its resources and data will be permanently deleted.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('deleteModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="destroy" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    <script type="text/javascript" src="{{ URL::asset('js/full-calendar.global.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                slotMinTime: '6:00:00',
                slotMaxTime: '22:00:00',
                events: @json($events),
            });
            calendar.render();
        });
    </script>
</div>
