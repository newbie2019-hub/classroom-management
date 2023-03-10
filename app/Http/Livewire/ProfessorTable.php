<?php

namespace App\Http\Livewire;

use App\Models\Professor;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class ProfessorTable extends PowerGridComponent
{
    use ActionButton;
    public string $sortField = 'created_at';
    public string $sortDirection = 'desc';
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
     * @return Builder<\App\Models\Professor>
     */
    public function datasource(): Builder
    {
        return Professor::query();
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
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ??? IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('first_name')
            ->addColumn('last_name')
            ->addColumn('professor', function (Professor $model) {
                return e($model->first_name) . ' ' . e($model->last_name);
            })
            ->addColumn('gender')
            ->addColumn('contact')
            ->addColumn('address')
            ->addColumn('email')
            ->addColumn('created_at_formatted', fn (Professor $model) => Carbon::parse($model->created_at)->format('F j, Y h:i A'));
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
            Column::make('ID', 'id')->hidden(),

            Column::make('FIRST_NAME', 'first_name')->hidden()->searchable(),
            Column::make('LAST_NAME', 'last_name')->hidden()->searchable(),
            Column::make('PROFESSOR', 'professor')->searchable(),

            Column::make('GENDER', 'gender')
                ->searchable()
                ->sortable(),

            Column::make('CONTACT', 'contact')
                ->sortable(),

            Column::make('ADDRESS', 'address')
                ->sortable(),

            Column::make('EMAIL', 'email')
                ->sortable(),

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
                ->emitTo('professors', 'showAddModal', []),
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
     * PowerGrid Professor Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::add('edit')
                ->class('inline-flex items-center justify-center px-4 py-2 bg-transparent text-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-100 focus:outline-none focus:border-green-200 focus:ring focus:ring-green-200 active:bg-green-200 disabled:opacity-25 transition')
                ->caption('Update')
                ->emitTo('professors', 'showUpdateModal', ['key' => 'id']),

            Button::add('destroy')
                ->class('inline-flex items-center justify-center px-4 py-2 bg-transparent text-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-100 focus:outline-none focus:border-red-200 focus:ring focus:ring-red-200 active:bg-red-200 disabled:opacity-25 transition')
                ->caption('Delete')
                ->emitTo('professors', 'showDeleteModal', ['key' => 'id']),
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
     * PowerGrid Professor Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($professor) => $professor->id === 1)
                ->hide(),
        ];
    }
    */
}
