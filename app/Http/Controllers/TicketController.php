<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateticketRequest;
use App\Http\Resources\TicketResource;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Admin')) {
            $myTicket = Ticket::all();
        }

        if ($user->hasRole('Developer')) {
            $myTicket = Ticket::where('developer_id', $user->id)->get();
        }

        if ($user->hasRole('Client')) {
            $myTicket = Ticket::where('user_id', $user->id)->get();
        }

        return TicketResource::collection($myTicket);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreticketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Auth::user()->hasRole('Client')) {
            $ticket = Auth::user()->tickets()->create($request->all());
            return new TicketResource($ticket);
        } else {
            abort(403, "Only Client is able to create ticket");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        if ($ticket->user_id == Auth::id()) {
            return ticketresource::collection($ticket);
        }
        abort(403, "You are not authorized to access this");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateticketRequest  $request
     * @param  \App\Models\ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateticketRequest $request, Ticket $ticket)
    {
        // dd($request);
        if (Auth::user()->hasRole("Admin") || Auth::user()->hasRole("Developer")) {
            $ticket->update($request->except(["title", "user_id", "description", 'category_id']));
            return new TicketResource($ticket);
        } else {
            abort(403, "Unable to update ticket");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        if ($ticket->user_id == Auth::id() && (Auth::user()->hasRole('Client') || Auth::user()->hasRole('Admin'))) {
            $ticket->delete();
            return response()->json(null, 204);
        }
        abort(403);
    }
}