<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Chat extends Component
{
    public $users;
    public $message;
    public $receiver_id;
    public $conversationMessages = [];

    public function boot()
    {

        $last = Message::where('transmitter_id', Auth::user()->id)->where('receiver_id', Auth::user()->id)->latest()->first();

        // dd($last);


        $this->users = User::where('id', '<>', Auth::user()->id)->get();
    }
    public function render()
    {
        return view('livewire.chat');
    }

    public function getReceiveId($receiver_id)
    {
        Log::debug($receiver_id);
        $this->receiver_id = $receiver_id;
    }

    public function getConversationWithUser()
    {
        $this->conversationMessages = Message::where('transmitter_id', Auth::user()->id)->where('receiver_id', $this->receiver_id)->orWhere('transmitter_id', $this->receiver_id)->Where('receiver_id', Auth::user()->id)->get();
    }

    public function sendMessage()
    {
        $message = new Message;

        $data = [
            'transmitter_id' => Auth::user()->id,
            'receiver_id' => $this->receiver_id,
            'message' => $this->message
        ];

        $message->create($data);
        // $this->getConversationWithUser($this->receiver_id);
        $this->message = "";
    }
}
