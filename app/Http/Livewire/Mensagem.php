<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class Mensagem extends Component
{

    public $receiver, $user_info, $pack_messages;

    protected $listeners = ['render'];

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
        $this->emit('getReceiverId', $this->receiver);
        $this->dispatchBrowserEvent('scrollDown');

    }

    public function showUserPhoto(){
        $this->dispatchBrowserEvent('showUserPhoto');
    }

    public function backToUsers(){
        $this->reset('receiver');
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

        if($this->receiver){
            $receiver_to_send_message = $this->receiver;
            return view('livewire.mensagem', compact('users', 'receiver_to_send_message'))
            ->layout('pages.chat');
        }
        else{
            return view('livewire.mensagem', compact('users'))
            ->layout('pages.chat');
        }

    }
}
