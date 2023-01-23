<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Professors') }}
        </h2>
    </x-slot>

    <div class="pb-10 pt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6">
                <livewire:professor-table />
            </div>
        </div>
    </div>

    <!-- Delete User Confirmation Modal -->
    <x-jet-dialog-modal wire:model="updateModal" max-width="md">
        <x-slot name="title">
            {{ __('Update Data') }}
        </x-slot>
        <x-slot name="subtitle">
            Please make sure that the data are valid and to fill-in all the fields.
        </x-slot>

        <x-slot name="content">
            <div class="relative mt-2">
                <x-forms.floating-input wire:model.debounce="professor.first_name" type="text" id="first_name"
                    name="first_name" class="block w-full " />
                <x-forms.floating-label for="first_name" :value="__('First Name')" />
            </div>
            @error('professor.first_name')
                <p id="outlined_error_help" class="mt-2 text-xs text-left text-red-600 dark:text-red-400">
                    {{ $message }}</p>
            @enderror
            <div class="relative mt-4">
                <x-forms.floating-input wire:model.debounce="professor.middle_name" type="text" id="middle_name"
                    name="middle_name" class="block w-full " />
                <x-forms.floating-label for="middle_name" :value="__('Middle Name')" />
            </div>
            @error('professor.middle_name')
                <p id="outlined_error_help" class="mt-2 text-xs text-left text-red-600 dark:text-red-400">
                    {{ $message }}</p>
            @enderror
            <div class="relative mt-4">
                <x-forms.floating-input wire:model.debounce="professor.last_name" type="text" id="last_name"
                    name="last_name" class="block w-full " />
                <x-forms.floating-label for="last_name" :value="__('Last Name')" />
            </div>
            @error('professor.last_name')
                <p id="outlined_error_help" class="mt-2 text-xs text-left text-red-600 dark:text-red-400">
                    {{ $message }}</p>
            @enderror
            <div class="relative mt-4">
                <select wire:model.debounce="professor.gender" required name="gender" id="gender"
                    class="block w-full p-3 text-sm text-gray-900 bg-transparent border-gray-300 rounded-lg appearance-none peer border dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600">
                    <option selected value="">
                        Select Gender
                    </option>
                    <option value="Male">
                        Male
                    </option>
                    <option value="Female">
                        Female
                    </option>
                </select>
                <p
                    class="absolute px-2 text-gray-600 duration-150 ease-in-out bg-white pointer-events-none left-2 peer-valid:left-1 peer-valid:top-0 peer-valid:-translate-y-2 top-3 peer-valid:text-xs">
                    Select Gender</p>
            </div>
            @error('professor.gender')
                <p id="outlined_error_help" class="mt-2 text-xs text-left text-red-600 dark:text-red-400">
                    {{ $message }}</p>
            @enderror
            <div class="relative mt-4">
                <x-forms.floating-input wire:model="professor.contact" type="text" id="contact" name="contact"
                    class="block w-full " />
                <x-forms.floating-label for="contact" :value="__('Contact')" />
            </div>
            @error('professor.contact')
                <p id="outlined_error_help" class="mt-2 text-xs text-left text-red-600 dark:text-red-400">
                    {{ $message }}</p>
            @enderror
            <div class="relative mt-4">
                <x-forms.floating-input wire:model="professor.address" type="text" id="address" name="address"
                    class="block w-full " />
                <x-forms.floating-label for="address" :value="__('Address')" />
            </div>
            @error('professor.address')
                <p id="outlined_error_help" class="mt-2 text-xs text-left text-red-600 dark:text-red-400">
                    {{ $message }}</p>
            @enderror
            <div class="relative mt-4">
                <x-forms.floating-input wire:model="professor.email" type="text" id="email" name="email"
                    class="block w-full " />
                <x-forms.floating-label for="email" :value="__('Email')" />
            </div>
            @error('professor.email')
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
            {{ __('Are you sure you want to this data? Once your account is deleted, all of its resources and data will be permanently deleted.') }}
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
