<?php

namespace App\Http\Livewire;

use App\Models\Room;
use App\Models\Schedule;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class RoomScheduleTable extends PowerGridComponent
{
    use ActionButton;
    public $roomId;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
    * PowerGrid datasource.
    *
    * @return Builder<\App\Models\Room>
    */
    public function datasource(): Builder
    {
        return Schedule::query()->with(['professor', 'room'])->where('room_id', $this->roomId);
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [
           'professor' => [
                'first_name',
                'last_name',
           ],
           'subject' => [
                'subject',
           ],
           'room' => [
                'room',
           ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('room', function (Schedule $model) {
                return e($model->room->room);
            })
            ->addColumn('professor', function (Schedule $model) {
                return e($model->professor->first_name) . ' ' . e($model->professor->last_name);
            })
            ->addColumn('subject', function (Schedule $model) {
                return e($model->subject->subject);
            })
            ->addColumn('date_from', fn (Schedule $model) => Carbon::parse($model->date_from)->format('F j, Y h:i A'))
            ->addColumn('date_to', fn (Schedule $model) => Carbon::parse($model->date_to)->format('F j, Y h:i A'))
            ->addColumn('created_at_formatted', fn (Schedule $model) => Carbon::parse($model->created_at)->format('F j, Y h:i A'))
            ->addColumn('updated_at_formatted', fn (Schedule $model) => Carbon::parse($model->updated_at)->format('F j, Y h:i A'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('ID', 'id'),

            Column::make('ROOM', 'room'),

            Column::make('PROFESSOR', 'professor')->searchable(),
            Column::make('SUBJECT', 'subject')->searchable(),

            Column::make('DATE FROM', 'date_from')
                ->sortable()
                ->searchable(),
            Column::make('DATE TO', 'date_to')
                ->sortable()
                ->searchable(),

            Column::make('CREATED AT', 'created_at_formatted', 'created_at')
                ->searchable()
                ->sortable(),
        ];
    }

    public function header(): array
    {
        return [
            Button::add('create')
                ->class('inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition')
                ->caption('New Data')
                ->emitTo('schedules', 'showAddModal', []),
        ];
    }
    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Room Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::add('edit')
                ->class('inline-flex items-center justify-center px-4 py-2 bg-transparent text-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-100 focus:outline-none focus:border-green-200 focus:ring focus:ring-green-200 active:bg-green-200 disabled:opacity-25 transition')
                ->caption('Update')
                ->emitTo('room-show', 'showUpdateModal', ['key' => 'id']),

            Button::add('destroy')
                ->class('inline-flex items-center justify-center px-4 py-2 bg-transparent text-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-100 focus:outline-none focus:border-red-200 focus:ring focus:ring-red-200 active:bg-red-200 disabled:opacity-25 transition')
                ->caption('Delete')
                ->emitTo('room-show', 'showDeleteModal', ['key' => 'id']),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid Room Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($room) => $room->id === 1)
                ->hide(),
        ];
    }
    */
}
