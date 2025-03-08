<?php

namespace App\Http\Controllers;


use App\Events\SendMessageEvent;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    function index() {
      //  $users = User::where('id', '!=', auth()->user()->id)->get();
        $users = User::where('id', '!=', Auth::id())->get();
        return view('dashboard', compact('users'));
    }


    function fetchMessages(Request $request) {
        $contact = User::findOrFail($request->contact_id);

        $messages = Message::where('from_id', Auth::user()->id)->where('to_id', $request->contact_id)
        ->orWhere('from_id', $request->contact_id)->where('to_id', Auth::user()->id)
        ->get();

        return response()->json([
            'contact' => $contact,
            'messages' => $messages
        ]);
    }

    function sendMessage(Request $request) {
        // if (!Auth::check()) {
        //     return response()->json(['error' => 'User not authenticated'], 401);
        // }


        $request->validate([
            'contact_id' => ['required'],
            'message' => ['required', 'string']
        ]);

        $message = new Message();
        $message->from_id = Auth::user()->id;
        $message->to_id = $request->contact_id;
        $message->message = $request->message;
        $message->save();

        event(new SendMessageEvent($message->message,Auth::user()->id, $request->contact_id));

        return response($message);
    }




}
