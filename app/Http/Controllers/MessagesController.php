<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class MessagesController extends Controller
{
    public function index()
    {
        $threads = Thread::getAllLatest()->get();

        //$threads = Thread::forUser(Auth::id())->latest('updated_at')->get();

        //$threads = Thread::forUserWithNewMessages(Auth::id())->latest('updated_at')->get();

        return view('messenger.index', compact('threads'));
    }

    public function show($id)
    {
        try
        {
            $thread = Thread::findOrFail($id);
        }
        catch (ModelNotFoundException $e)
        {
            Session::flash('error_message', 'The thread with ID: ' . $id . 'was not found.');
            return redirect()->route('messages');
        }

        //$users = User::whereNotIn('id', $thread->participantsUserIds())->get();

        $userId = Auth::id();
        $users = User::whereNotIn('id', $thread->participantsUserIds())->get();

        $thread->markAsRead($userId);

        return view('messenger.show', compact('thread', 'users'));
    }

    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('messenger.create', compact('users'));
    }

    public function store()
    {
        $input = Input::all();

        $thread = Thread::create([
            'subject' => $input['subject'],
        ]);

        Message::create([
            'thread_id' => $thread->id,
            'user_id'  => Auth::id(),
            'body' => $input['message'],
        ]);

        Participant::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'last_read' => new Carbon,
        ]);

        if(Input::has('recipients'))
        {
            $thread->addParticipant($input['recipients']);
        }

        return redirect()->route('messages');
    }

    public function update($id)
    {
        try
        {
            $thread = Thread::findOrFail($id);
        }
        catch (ModelNotFoundException $e)
        {
            Session::flash('error_message', 'The Thread with ID: ' . $id . ' was not found.');

            return redirect()->route('messages');
        }

        $thread->activateAllParticipants();

        Message::create([
            'thread_id' => $thread->id,
            'user_id' =>Auth::id(),
            'body' =>Input::get('message'),
        ]);

        $participant = Participant::firstOrCreate([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
        ]);

        $participant->last_read = new Carbon;
        $participant->save();

        if (Input::has('recipients'))
        {
            $thread->addParticipant(Input::get('recipients'));
        }

        return redirect()->route('messages.show', $id);
    }
}