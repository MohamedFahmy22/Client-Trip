<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        return Ticket::where('user_id', Auth::id())->get();
    }

    public function store(TicketRequest $request)
    {
        $ticket = Ticket::create([
            'title' => $request->validated()['title'],
            'description' => $request->validated()['description'],
            'user_id' => Auth::id(),
        ]);

        return response()->json($ticket, 201);
    }

    public function show($id)
    {
        $ticket = Ticket::find($id);
        if (!$ticket || $ticket->user_id !== Auth::id()) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        return $ticket;
    }

    public function update(TicketRequest $request, $id)
    {
        $ticket = Ticket::find($id);
        if (!$ticket || $ticket->user_id !== Auth::id()) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        $ticket->update($request->validated());

        return response()->json($ticket, 200);
    }

    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        if (!$ticket || $ticket->user_id !== Auth::id()) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        $ticket->delete();

        return response()->json(['message' => 'Ticket deleted'], 200);
    }
}
