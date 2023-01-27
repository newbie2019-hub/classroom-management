<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="pb-10 pt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6">
                <div class="mb-4">
                    <p class="text-lg font-semibold">Dashboard</p>
                    <p class="text-gray-600">Welcome, here is your summary of data.</p>
                </div>
                <div class="flex gap-2 flex-wrap md:flex-nowrap">
                    <div
                        class="p-4 w-full md:w-1/3 shadow-sm border-l-4 rounded-md border-blue-500 flex justify-between">
                        <p>Total Rooms</p>
                        <p class="font-semibold">{{ $roomCount }}</p>
                    </div>
                    <div
                        class="p-4 w-full md:w-1/3 shadow-sm border-l-4 rounded-md border-blue-500 flex justify-between">
                        <p>Total Professors</p>
                        <p class="font-semibold">{{ $profCount }}</p>
                    </div>
                    <div
                        class="p-4 w-full md:w-1/3 shadow-sm border-l-4 rounded-md border-blue-500 flex justify-between">
                        <p>Total Subjects</p>
                        <p class="font-semibold">{{ $subjectCount }}</p>
                    </div>
                </div>
                <div class="mb-4 mt-7">
                    <p class="text-lg font-semibold">Schedules</p>
                    <p class="text-gray-600">Shown on the table are the schedules for the rooms.</p>
                </div>
                <livewire:dashboard-schedule />
            </div>
        </div>
    </div>
</x-app-layout>
