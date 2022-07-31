<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Livewire\Component;

class SendMessage extends Component
{

    public $mensagem, $msg_receiver;

    protected $listeners = ['getReceiverId'];

    protected $rules = [
        'mensagem' => 'required',
    ];

    public function sendMessage(){

        $this->validate();

        $newMessage = new Message;
        $newMessage->message = $this->mensagem;
        $newMessage->sender_id = auth()->user()->id;
        $newMessage->receiver_id = $this->msg_receiver;
        $newMessage->is_seen = 0;
        $newMessage->save();

        $this->reset('mensagem');
        $this->emitTo('mensagem', 'render');
        $this->dispatchBrowserEvent('scrollDown');

    }
    
    public function scrollDown(){
        $this->dispatchBrowserEvent('scrollDown');
    }

    public function getReceiverId($receiverId){
        $this->msg_receiver = $receiverId;
    }

    public function render()
    {

        return view('livewire.send-message');
    }
}
