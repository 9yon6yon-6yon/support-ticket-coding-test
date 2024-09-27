<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{

    public function index()
    {
        $tickets = Tickets::with('user')->where('status', 'open')->get();
        return view('admin.dashboard', compact('tickets'));
    }
    public function show(Request $request)
    {
        $tickets = Tickets::with('user')->where('status', 'open')->get();
        return view('admin.dashboard', compact('tickets'));
    }


    public function respond(Request $request, $id)
    {
        $request->validate([
            'response' => 'required|string',
        ]);

        $ticket = Tickets::findOrFail($id);
        $ticket->response = $request->response;
        $ticket->save();

        return redirect()->back()->with('success', 'Response saved successfully');
    }

    public function close($id)
    {
        $ticket = Tickets::findOrFail($id);
        $ticket->status = 'closed';
        $ticket->save();

        $from = config('mail.from.address');
        $name = config('mail.from.name');
        
        $user = User::findOrFail($ticket->user_id); 
        $email = $user->email; 
    
        $from = config('mail.from.address');  
        $name = config('mail.from.name');    
        $body = "Dear {$user->name},<br><br>Your issue has been responded to, and the ticket has been closed.<br>Thank you for your patience.";
    
        Mail::send('email-close', ['user' => $user, 'ticket' => $ticket, 'body' => $body], function ($message) use ($email, $from, $name) {
            $message->from($from, $name);  
            $message->to($email, 'User')   
                    ->subject('Your Ticket Has Been Closed');  
        });

        return redirect()->back()->with('success', 'Ticket closed successfully');
    }
}
