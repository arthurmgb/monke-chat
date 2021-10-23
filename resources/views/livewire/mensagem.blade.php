<div>
    @if($receiver)
    
    <div id="page-chat" class="card border-top-0">
        <div id="online-poll" class="card-body px-0 py-0" wire:poll.1000ms="update_unseen">

            <div class="card-title mb-0">
                <div class="d-flex flex-row align-items-center justify-content-between">
                    <div class="div-left ms-2 d-flex flex-row align-items-center justify-content-between">

                        <div class="div-back-to-users me-2 ms-0" wire:click.prevent="backToUsers()">
                            <button class="btn-right ms-0">
                                <i class="far fa-arrow-left fa-lg fx-back"></i>                      
                            </button>
                        </div>

                        <div class="div-user-profile d-flex flex-row align-items-center" data-bs-toggle="modal" data-bs-target="#userFoto">
                            <img class="img-user img-user-in-chat" src="{{$user_info->profile_photo_url}}">
                            <div class="d-flex flex-column">

                                <span class="user-name user-in-chat ps-3">{{$user_info->name}}</span>
                                @if($user_info->isOnline())
                                <span class="is-online ps-3">online</span>
                                @endif

                            </div>
                        </div>
                        
                    </div>
    
                    <div class="div-right" wire:ignore>

                        <div class="dropdown">
                            <button class="btn-right" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="far fa-ellipsis-v fa-lg"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#userFoto">Ver contato</a></li>                              
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <div class="chat-messages" id="chat-box-messages">

                @foreach ($pack_messages as $message)

                    @php
                        $hora_msg = $message->created_at->format('H:i');
                        $formated_msg = nl2br($message->message);
                    @endphp
                    
                    @if($message->sender_id == auth()->user()->id)
                        <div class="d-flex flex-row-reverse">
                            <div class="single-msg-sender single-msg">
                            <div class="d-flex flex-row">
                                <span class="f-msg f-msg-sender">
                                    {!! $formated_msg !!}
                                    <p class="time-of-msg float-end">{{$hora_msg}} <i class="far fa-check-double ms-1 @if($message->is_seen === 1) check-viewed @else check-sent @endif"></i></p>
                                </span>                          
                            </div>
                            </div>
                        </div>

                    @elseif($message->sender_id == $receiver)
                        <div class="d-flex flex-row">
                            <div class="single-msg-receiver single-msg">
                            <div class="d-flex flex-column">
                                <span class="f-msg f-msg-receiver">
                                    {!! $formated_msg !!}
                                    <p class="time-of-msg float-end">{{$hora_msg}}</p> 
                                </span>    
                            </div>
                            </div>
                        </div>
                    @endif
                

                @endforeach
              
            </div>
            
            <div class="chat-input d-flex flex-row align-items-center" wire:ignore>

                <textarea class="input-msg mx-2" rows="1" autofocus autocomplete="off" placeholder="Mensagem" wire:model.defer="mensagem" wire:click.prevent="scrollDown"></textarea>

                <button class="btn btn-lg me-2 btn-send" wire:click.prevent="sendMessage()" wire:loading.attr="disabled">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>

        </div>
    </div>
    
    @else 

    <div id="page-user" class="card border-top-0">
        <div class="card-body px-0 pt-0">

            <div style="margin-bottom: 2px;" class="card-title" wire:ignore>
                <div class="d-flex flex-row align-items-center justify-content-between">
                    <div class="div-left ms-1">
                        <img style="-webkit-user-drag: none;" src="{{asset('img/monkey.png')}}">
                        <span class="fw-500 ms-1">MonkeChat</span>
                    </div>
    
                    <div class="div-right" wire:ignore>
                        <div class="dropdown dropstart">
                            <button class="btn-right" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="far fa-ellipsis-v fa-lg"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{route('profile.show')}}">Editar perfil</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                            Sair
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="list-of-users" wire:poll.1000ms>

                @foreach ($users as $user)

                @php
                    
                    $ultima_mensagem = App\Models\Message::where('sender_id', auth()->user()->id)
                                    ->where('receiver_id', $user->id)
                                    ->orWhere('sender_id', $user->id)
                                    ->where('receiver_id', auth()->user()->id)
                                    ->latest()
                                    ->first();
                                                       
                    if($ultima_mensagem){

                        $data_hoje = Carbon\Carbon::now()->format('Y-m-d');
                        $data_msg = $ultima_mensagem->created_at->format('Y-m-d');

                        $date1 = date_create($data_hoje);
                        $date2 = date_create($data_msg);
                        $diff = date_diff($date1,$date2);
                        $diferenca = $diff->format('%d');
                        $diferenca = intval($diferenca);
                        
                        if($diferenca >= 1){
                            $ultima_mensagem_hora = $ultima_mensagem->created_at->format('d/m/Y');
                        }else{
                            $ultima_mensagem_hora = $ultima_mensagem->created_at->format('H:i');
                        }
                        
                    }

                    $mensagens_pendentes = App\Models\Message::where('sender_id', $user->id)
                                        ->where('receiver_id', auth()->id())
                                        ->where('is_seen', 0)
                                        ->count();

                @endphp

                    <div class="user-block" wire:click.prevent="selectUser({{$user->id}})">
                        <div class="d-flex flex-row align-items-center">
                            <img class="img-user" src="{{ $user->profile_photo_url }}">
                            <span style="margin-top: -30px;" class="user-name ps-3">{{$user->name}}</span>
                            <div style="margin-top: -30px;" class="ms-auto">
                                @if($ultima_mensagem)
                                <span class="@if($mensagens_pendentes > 0) msg-hour-unseen @else msg-hour @endif">{{$ultima_mensagem_hora}}</span>
                                @else
                                <span style="color: transparent;" class="msg-hour">00:00</span>
                                @endif
                            </div>
                        </div>

                        <div class="last-msg-block">
                            <div class="d-flex flex-row align-items-center">

                                @if($ultima_mensagem)
                                <span class="last-msg">
                                    @if($ultima_mensagem->sender_id == auth()->user()->id)
                                    <i style="margin-right: 2px;" class="far fa-check-double @if($ultima_mensagem->is_seen === 1) check-viewed-user @else check-sent-user @endif"></i>
                                    {{$ultima_mensagem->message}}
                                    @else
                                    {{$ultima_mensagem->message}}
                                    @endif
                                </span>
                                @else
                                <span style="color: transparent;" class="last-msg">...</span>
                                @endif

                                @if($mensagens_pendentes > 0)
                                    <div class="ntf-msg ms-auto">
                                        {{$mensagens_pendentes}}
                                    </div>
                                @else
                                    <div style="color: transparent; background-color: transparent;" class="ntf-msg ms-auto">
                                        {{$mensagens_pendentes}}
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    @endif

  <!-- Modal Foto Usuário-->
  <div wire:ignore.self style="user-select: none;" class="modal fade" id="userFoto" tabindex="-1" aria-labelledby="userFotoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header py-1">
          <h5 class="modal-title modal-title-2" id="userFotoLabel">@if($user_info){{$user_info->name}}@endif</h5>
          <button type="button" class="btn-close btn-close-2" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-0">
            <div class="d-flex flex-row align-items-center justify-content-center">
                <img style="width: 100%; height: 400px; object-fit: cover;" class="img-fluid" src="@if($user_info){{$user_info->profile_photo_url}}@endif">
            </div>
        </div>
      </div>
    </div>
  </div>

</div>
