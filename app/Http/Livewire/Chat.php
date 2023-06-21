<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Chat extends Component
{
    public $users;
    public $message;
    public $receiver_id;
    public $conversationMessages = [];
    public $contador;
    public $viewChatList;

    public function boot()
    {
        $this->contador = 0;
        $this->users = User::where('id', '<>', Auth::user()->id)->get();
    }
    public function render()
    {
        if ($this->viewChatList == 0) {
            $this->emit('show-chat');
        }
        return view('livewire.chat');
    }

    public function backToListChat()
    {
        $this->viewChatList = 1;
    }
    // public function viewChat(){
    //     $this->viewChatList = 0;
    // }

    public function getReceiveId($receiver_id)
    {
        $this->receiver_id = $receiver_id;
        $this->viewChatList = 0;
    }

    public function getConversationWithUser()
    {
        $this->conversationMessages = Message::where('transmitter_id', Auth::user()->id)->where('receiver_id', $this->receiver_id)->orWhere('transmitter_id', $this->receiver_id)->Where('receiver_id', Auth::user()->id)->get();

        if ($this->contador == 0) {
            $this->contador = 1;
            DB::listen(function ($query) {
                $this->emit('bottom-scroll', $query->time);
            });
        }
    }

    public function getLastMessageUser($user_id)
    {
        $response = Message::where('transmitter_id', Auth::user()->id)->where('receiver_id', $user_id)->orWhere('transmitter_id', $user_id)->Where('receiver_id', Auth::user()->id)->latest()->first();

        if (!empty($response)) {
            return $response->message;
        }
        return '';
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
        $this->emit('bottom-scroll', 0);
        $this->message = "";
    }
}
