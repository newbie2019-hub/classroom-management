<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Professors') }}
        </h2>
    </x-slot>

    <div class="pb-10 pt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6">
                <div class="mb-4">
                    <p class="text-lg text-medium">Subjects Table</p>
                    <p class="text-gray-600">Shown on the table are the data of the subjects.</p>
                </div>
                <livewire:subject-table />
            </div>
        </div>
    </div>

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
                <x-forms.floating-input wire:model.debounce="subject.subject" type="text" id="subject"
                    name="subject" class="block w-full " />
                <x-forms.floating-label for="subject" :value="__('Subject')" />
            </div>
            @error('subject.subject')
                <p id="outlined_error_help" class="mt-2 text-xs text-left text-red-600 dark:text-red-400">
                    {{ $message }}</p>
            @enderror
            <div class="relative mt-4">
                <x-forms.floating-input wire:model.debounce="subject.description" type="text" id="description"
                    name="description" class="block w-full " />
                <x-forms.floating-label for="description" :value="__('Description')" />
            </div>
            @error('subject.description')
                <p id="outlined_error_help" class="mt-2 text-xs text-left text-red-600 dark:text-red-400">
                    {{ $message }}</p>
            @enderror
            <div class="relative mt-4">
                <x-forms.floating-input wire:model.debounce="subject.units" type="text" id="units"
                    name="units" class="block w-full " />
                <x-forms.floating-label for="units" :value="__('Units')" />
            </div>
            @error('subject.units')
                <p id="outlined_error_help" class="mt-2 text-xs text-left text-red-600 dark:text-red-400">
                    {{ $message }}</p>
            @enderror
            <div class="relative mt-4">
                <select wire:model.debounce="subject.professor_id" required name="professor_id" id="professor_id"
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
            @error('subject.professor_id')
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
</div>
