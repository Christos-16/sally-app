<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Text</title>
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<style>
    /* Light theme */
    .chat-container {
        background-color: #f7f7f7;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        overflow: hidden;
    }

    .chat-header {
        background-color: #1e293b;
        color: #ffffff;
        padding: 12px;
    }

    /* Dark theme */
    .dark .chat-container {
        background-color: #1e293b;
        border: 1px solid #374151;
    }

    .dark .chat-header {
        background-color: #111827;
        color: #ffffff;
    }

    .dark .text-sm {
        color: #ffffff;
    }

    .dark .text-slate-500 {
        color: #d1d5db;
    }
    .dark .reply-textarea{
        background-color: #1e293b;
        color: #ffffff;
    }


    .participant-photos {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .participant-photo {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    /* Reply section */
    .reply-section {
    /* other styles */
    position: fixed;
    bottom: 100;
    left: 50%;
    transform: translateX(-40%);
    width: 70%;
    box-sizing: border-box;
    padding: 10px 0;
}

.reply-textarea {
    width: 100%;
    resize: none;

}


.reply-icons button:first-child {
    display: none;
}


.reply-icons button:last-child {
    position: absolute;
    left: 1320px;
    bottom: 0px;
}


</style>

<body>
    <x-app-layout>
        <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
            <!-- Page header -->
            <div class="sm:flex sm:justify-between sm:items-center mb-5">
                <div class="mb-4 sm:mb-0">
                    <h1 class="text-2xl md:text-3xl text-slate-800 dark:text-slate-100 font-bold">Full Text ✨</h1>
                </div>
            </div>

            <!-- Participant photos -->
            <div class="participant-photos">
                <img class="participant-photo" src="images/icon.jpeg" alt="Participant 1">
                <img class="participant-photo" src="{{ asset('images/userlogo.jpg') }}" alt="Participant 2">
            </div>

            <!-- Chat Layout with color changes -->
            <div class="chat-container grow flex flex-col md:translate-x-0 duration-300 ease-in-out">
                <!-- Body -->
                <div class="grow px-4 sm:px-6 md:px-5 py-6">
                    <!-- Chat messages -->

                    <!-- Example chat message -->
                    <div class="flex items-start mb-4 last:mb-0">
                        <img class="rounded-full mr-4" src="{{ asset('images/icon.jpeg') }}" width="40" height="40" alt="User 01" />
                        <div>
                            <div class="text-sm bg-white dark:bg-slate-800 text-slate-800 dark:text-slate-100 p-3 rounded-lg rounded-tl-none border border-slate-200 dark:border-slate-700 shadow-md mb-1">
                                {{ $data }}
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="text-xs text-slate-500 font-medium">{{ date('g:i A') }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- Repeat the above structure for each chat message -->
                </div>
            </div>

            <!-- Reply section -->
            <div class="reply-section">
                <textarea class="reply-textarea" placeholder="Write your reply here..."></textarea>
                <div class="reply-icons">
                    <button><i class="far fa-arrow-alt-circle-right"></i></button>
                    <button><i class="far fa-paper-plane"></i></button>
                </div>
            </div>
        </div>
    </x-app-layout>

</body>
</html>
