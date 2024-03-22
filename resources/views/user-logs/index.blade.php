<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Logs</title>
    <link href="{{ asset('css/theme-styles.css') }}" rel="stylesheet">
</head>
<body>
    <x-app-layout>
        <div class="relative flex h-full" x-data="{ sidebarOpen: true }">

            <div class="grow flex flex-col md:translate-x-0 transition-transform duration-300 ease-in-out" :class="{ 'translate-x-1/3': sidebarOpen, 'translate-x-0': !sidebarOpen }">

                <!-- Body -->
                <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700 p-6 divide-y divide-slate-200 dark:divide-slate-700">
                    <table class="min-w-full">
                        <thead>
                            <tr class="text-left">
                                <th class="px-6 py-3 text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-700">
                            @foreach ($logs as $log)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->created_at }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->action }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="py-3 bg-white dark:bg-slate-800 px-6 border-t border-slate-200 dark:border-slate-700">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </x-app-layout>
    <!-- Include your theme's script links here, replace with your actual script paths -->
    <script src="{{ asset('js/theme-scripts.js') }}"></script>
</body>
</html>
