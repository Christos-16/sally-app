<?php

namespace App\DataTables;

use App\Models\UserLog;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;

class UserLogsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'userlogs.action')
            ->editColumn('user', function ($log) {
                return $log->user ? $log->user->id : ''; // Assuming you want to show the user ID
            })
            ->editColumn('created_at', function ($log) {
                return $log->created_at->format('Y-m-d H:i:s'); // Adjust the format as needed
            })
            ->addColumn('email', function ($log) {
                return $log->user ? $log->user->email : '';
            })
            ->addColumn('conversation', function ($log) {
                return Str::limit($log->new_column2, 50); // Adjust the length as needed
            })
            ->addColumn('no_of_turns_words', function ($log) {
                // Assume 'no_of_words' is already calculated and saved in the database
                return $log->no_of_words;
            })


            ->setRowId('id');

    }


    /**
     * Get the query source of dataTable.
     */
    public function query(UserLog $model): QueryBuilder
    {
        return $model->newQuery()->with('user')->select('user_logs.*');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('userlogs-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataρTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id')->title('ID'), // Renamed from 'user' to 'ID'
            Column::make('email'), // Already added, but ensure it is correctly fetching the data
            Column::make('created_at')->title('Timestamp'), // Renamed from 'date' to 'Timestamp'
            Column::make('new_column1')->title('Email'), // Ensure this matches the database column name for emails
            Column::make('new_column2')->title('Conversation'), // New column for conversation
            Column::make('conversation')->title('Conversation'),
            Column::make('no_of_words')->title('No of Turns (Words)'),
        ];
    }


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'UserLogs_' . date('YmdHis');
    }
}
