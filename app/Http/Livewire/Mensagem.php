<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class Mensagem extends Component
{

    public $receiver, $user_info, $mensagem, $pack_messages;

    protected $rules = [
        'mensagem' => 'required',
    ];

    public function update_unseen(){

        if(isset($this->receiver)){

            $read_messages = Message::where('sender_id', $this->receiver)
            ->where('receiver_id', auth()->id())
            ->where('is_seen', 0);

            $read_messages->update(['is_seen'=> 1]);
        }
                                      
    }

    public function selectUser($id){

        $this->receiver = $id;
        $this->user_info = User::find($id);
        $this->dispatchBrowserEvent('scrollDown');

    }

    public function showUserPhoto(){
        $this->dispatchBrowserEvent('showUserPhoto');
    }

    public function backToUsers(){
        $this->reset('receiver');
        $this->reset('mensagem');
    }

    public function sendMessage(){

        $this->validate();

        $newMessage = new Message;
        $newMessage->message = $this->mensagem;
        $newMessage->sender_id = auth()->user()->id;
        $newMessage->receiver_id = $this->receiver;
        $newMessage->is_seen = 0;
        $newMessage->save();

        $this->reset('mensagem');
        $this->dispatchBrowserEvent('scrollDown');

    }

    public function render()
    {

        $users = User::where('id', '!=', auth()->id())->orderBy('name', 'ASC')->get();

        if($this->receiver){

        $this->pack_messages = Message::where('sender_id', auth()->user()->id)
                                        ->where('receiver_id', $this->receiver)
                                        ->orWhere('sender_id', $this->receiver)
                                        ->where('receiver_id', auth()->user()->id)
                                        ->orderBy('id', 'ASC')
                                        ->get();
        }

        return view('livewire.mensagem', compact('users'))
        ->layout('pages.chat');
    }
}
