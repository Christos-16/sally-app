<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Logs</title>
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
</head>
<style>
    .dark .yajra-table thead th {
        background-color: #1e293b;
        color: #D4D4D4;
    }
    .dark .yajra-table tbody tr td {
        background-color: #1e293b;
        color: #D4D4D4;
    }
    .dark .dataTables_wrapper .dataTables_length,
    .dark .dataTables_wrapper .dataTables_filter,
    .dark .dataTables_wrapper .dataTables_info,
    .dark .dataTables_wrapper .dataTables_processing,
    .dark .dataTables_wrapper .dataTables_paginate {
        color: #D4D4D4;
    }
    .dark .dataTables_wrapper .dt-button {
        color: #D4D4D4;
    }
    ul, li {
    list-style-type: none;
    padding-left: 0;
    margin-left: 0;
}




</style>

<body>
<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-5">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 dark:text-slate-100 font-bold">User Logs ✨</h1>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700 p-6 divide-y divide-slate-200 dark:divide-slate-700">
            <table class="min-w-full yajra-table" id="logs-table">
                <thead>
                    <tr class="text-left">
                        <th class="px-6 py-3 text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</x-app-layout>

<!-- DataTables Script -->
<script>
    $(function() {
        $('#logs-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('logs.data') }}',
            order: [[ 0, "desc" ]],
            dom: 'Bfrtip',
            buttons: [
                'csvHtml5'
            ],
            columns: [
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data, type, row) {
                        var date = new Date(data);
                        return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
                    }
                },
                { data: 'user', name: 'user' },
                {
                    data: 'id',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `<button onclick="deleteLog(${data})" class="delete-btn">Delete</button>`;
                    }
                }
            ]
        });
    });

    function deleteLog(id) {
        if(confirm('Are you sure you want to delete this log?')) {
            $.ajax({
                url: `/logs/delete/${id}`,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    $('#logs-table').DataTable().ajax.reload(null, false); // Reload DataTables without resetting paging
                    alert('Log deleted successfully');
                },
                error: function(response) {
                    alert('Error deleting log');
                }
            });
        }
    }
    </script>


</body>
</html>
