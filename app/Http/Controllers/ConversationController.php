<?php

namespace App\Http\Controllers;

use App\DataTables\ConversationsDataTable;
use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index(ConversationsDataTable $dataTable)
    {
        return $dataTable->render('conversations.index');
    }

    public function create(Request $request)
    {
        // Validate the request data
        $request->validate([
            'user_log_id' => 'required',
            'message' => 'required',
            'turns' => 'required',
        ]);

        // Create a new conversation
        $conversation = new Conversation([
            'user_log_id' => $request->user_log_id,
            'message' => $request->message,
            'turns' => $request->turns,
        ]);

        // Save the conversation
        $conversation->save();

        // Redirect to the conversation
        return redirect()->route('conversations.show', ['id' => $conversation->id]);
    }

    public function store(Request $request)
    {
        //
    }

    public function showFull($id)
{
    $conversation = Conversation::findOrFail($id);
    return view('conversations.showFull', ['conversation' => $conversation]);
}


    public function edit(Conversation $conversation)
    {
        //
    }

    public function update(Request $request, Conversation $conversation)
    {
        //
    }

    public function destroy(Conversation $conversation)
    {
        //
    }
}
