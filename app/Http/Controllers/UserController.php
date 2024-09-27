<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        $tickets = Tickets::where('user_id', Auth::id())->get();
        return view('user.dashboard', compact('tickets'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'issue' => 'required|string',
        ]);

        $ticket = new Tickets();
        $ticket->user_id = Auth::id();
        $ticket->issue = $request->issue;
        $ticket->save();

        $from = config('mail.from.address');
        $name = config('mail.from.name');
        $user = Auth::user();
        $email = $user->email;
        
        $body = "We have received your issue. Thanks for creating this ticket.<br> Our admin will respond as soon as possible.";
        //sending mail to user
        Mail::send('email-open', ['user' => $user, 'body' => $body], function ($message) use ($email, $from, $name) {
            $message->from($from, $name);   
            $message->to($email, 'User') 
                    ->subject('Ticket Created');  
        });

        $adminBody = "A new ticket has been created by " . $user->name . " (Email: " . $email . ").\n";
        $adminBody .= "Issue: " . $ticket->issue . "\n";
        $adminBody .= "Ticket ID: " . $ticket->id . "\n";
        $adminBody .= "Please respond to this ticket as soon as possible.";
        //sending mail to admin
        Mail::raw($adminBody, function ($message) use ($from, $name) {
            $message->from($from, $name);   
            $message->to($from, 'Admin')  
                    ->subject('New Ticket Created');  
        });


        return redirect()->back()->with('success', 'Ticket submitted successfully');
    }
}
