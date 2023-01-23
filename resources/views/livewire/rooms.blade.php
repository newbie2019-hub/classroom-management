<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Rooms') }}
    </h2>
</x-slot>

<div class="pb-10 pt-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6">
            <livewire:room-table />
        </div>
    </div>
</div>
