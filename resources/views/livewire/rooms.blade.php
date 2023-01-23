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
                    <p class="text-lg text-medium">Rooms Table</p>
                    <p class="text-gray-600">Shown on the table are the data of the rooms.</p>
                </div>
                <livewire:room-table />
            </div>
        </div>
    </div>

    <x-jet-dialog-modal wire:model="addModal" max-width="md">
        <x-slot name="title">
            {{ __('Update Data') }}
        </x-slot>
        <x-slot name="subtitle">
            Please make sure that the data are valid and to fill-in all the fields.
        </x-slot>

        <x-slot name="content">
            <div class="relative mt-2">
                <x-forms.floating-input wire:model.debounce="room.room" type="text" id="room"
                    name="room" class="block w-full " />
                <x-forms.floating-label for="room" :value="__('Room')" />
            </div>
            @error('room.room')
                <p id="outlined_error_help" class="mt-2 text-xs text-left text-red-600 dark:text-red-400">
                    {{ $message }}</p>
            @enderror
            <div class="relative mt-4">
                <x-forms.floating-input wire:model.debounce="room.description" type="text" id="description"
                    name="description" class="block w-full " />
                <x-forms.floating-label for="description" :value="__('Description')" />
            </div>
            @error('room.description')
                <p id="outlined_error_help" class="mt-2 text-xs text-left text-red-600 dark:text-red-400">
                    {{ $message }}</p>
            @enderror
            <div class="relative mt-4">
                <x-forms.floating-input wire:model.debounce="room.location" type="text" id="location"
                    name="location" class="block w-full " />
                <x-forms.floating-label for="location" :value="__('Location')" />
            </div>
            @error('room.location')
                <p id="outlined_error_help" class="mt-2 text-xs text-left text-red-600 dark:text-red-400">
                    {{ $message }}</p>
            @enderror
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('updateModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-buttons.success-button class="ml-3" wire:click="store" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-buttons.success-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="updateModal" max-width="md">
        <x-slot name="title">
            {{ __('Update Data') }}
        </x-slot>
        <x-slot name="subtitle">
            Please make sure that the data are valid and to fill-in all the fields.
        </x-slot>

        <x-slot name="content">
            <div class="relative mt-2">
                <x-forms.floating-input wire:model.debounce="room.room" type="text" id="room"
                    name="room" class="block w-full " />
                <x-forms.floating-label for="room" :value="__('Room')" />
            </div>
            @error('room.room')
                <p id="outlined_error_help" class="mt-2 text-xs text-left text-red-600 dark:text-red-400">
                    {{ $message }}</p>
            @enderror
            <div class="relative mt-4">
                <x-forms.floating-input wire:model.debounce="room.description" type="text" id="description"
                    name="description" class="block w-full " />
                <x-forms.floating-label for="description" :value="__('Description')" />
            </div>
            @error('room.description')
                <p id="outlined_error_help" class="mt-2 text-xs text-left text-red-600 dark:text-red-400">
                    {{ $message }}</p>
            @enderror
            <div class="relative mt-4">
                <x-forms.floating-input wire:model.debounce="room.location" type="text" id="location"
                    name="location" class="block w-full " />
                <x-forms.floating-label for="location" :value="__('Location')" />
            </div>
            @error('room.location')
                <p id="outlined_error_help" class="mt-2 text-xs text-left text-red-600 dark:text-red-400">
                    {{ $message }}</p>
            @enderror
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
            {{ __('Are you sure you want to this data? Once this room is deleted, all of its resources and data will be permanently deleted.') }}
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
</div>
