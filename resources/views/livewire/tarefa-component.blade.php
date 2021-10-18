<div class="container mx-auto">

    <div class="bg-white rounded-lg shadow overflow-hidden max-w-4xl mx-auto p-4 mb-6">
        <div class="flex">
            
            <input wire:model="name" @if ($acao == "store") wire:keydown.enter="store" @else wire:keydown.enter="update" @endif id="name" @if(auth()->user()->id == 4) placeholder="Eu te amo &#60;4" @else placeholder="Sua tarefa..." @endif class="w-full bg-gray-100 px-4 py-3 rounded text-gray-700 focus:bg-white focus:outline-none border border-gray-200 focus:border-gray-200 tracking-wider" autocomplete="off">      
           
            @if ($acao == "store")

                <button wire:loading.attr="disabled" wire:click="store" class="bg-green-500 hover:bg-green-600 text-white font-bold ml-2 px-4 py-2 rounded focus:outline-none">Adicionar</button>

            @else
                <button wire:click="update" class="bg-green-500 hover:bg-green-600 text-white font-bold ml-2 px-4 py-2 rounded focus:outline-none">Editar</button>
                <button wire:click="default" class="bg-gray-500 hover:bg-gray-600 text-white font-bold ml-2 px-4 py-2 rounded focus:outline-none">Cancelar</button>
            @endif
       
        </div>
            @error('name')
                <p class="text-red-500 text-sm py-3 px-1">{{$message}}</p>        
            @enderror

            <div>
                @if (session()->has('message'))
                
                    <div id="updated" class="text-green-500 py-3 px-1">
                        {{ session('message') }}
                    </div>

                    <script>
                        $(document).ready(function(){
                        $('#updated').fadeIn().delay(1200).fadeOut();
                        });
                    </script>
                    
                @endif
            </div>

    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden max-w-4xl mx-auto mb-8">
                @if ($tarefas->count())

        <table class="w-full">
            
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr class="text-xs font-medium text-gray-500 uppercase text-left tracking-wider">
                    <th class="px-6 py-3"><i class="far fa-check-square text-xl"></i></th>
                    <th class="px-6 py-3">Anotação</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                
                    @foreach ($tarefas as $tarefa)
                        <tr class="text-sm text-gray-500">
                            <td width="5px" class="px-6 py-4">
                                <input style="transform: scale(1.3);" wire:click="toggle({{$tarefa}})" name="checkbox" type="checkbox" class="cursor-pointer form-checkbox h-5 w-5 text-gray-600 rounded focus:ring-transparent" @if ($tarefa->checked == 1)
                                    checked
                                @endif>
                            </td>
                            <td style="word-break: break-word;" class="text-lg px-6 py-4 @if($tarefa->checked == 1)line-through @endif">{{$tarefa->nome}}</td>
                            <td width="10px" class="px-6 py-4">
                                <button wire:click="edit({{$tarefa}})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded mb-2 w-full focus:outline-none"><i class="fas fa-edit"></i></button>

                                <button wire:loading.attr="disabled" wire:click="destroy({{$tarefa}})" class="bg-red-500 hover:bg-red-700 text-white font-bold px-4 py-2 rounded mb-2 w-full focus:outline-none"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
            
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                {{$tarefas->links()}}
            </div>
                @else
                @endif
    </div>
    @if ($tarefas->count() == 0)
    <div class="flex justify-center">
        <button wire:click="gotoPage(1)" wire:loading.attr="disabled" class="rounded-full h-10 w-10 flex items-center justify-center bg-blue-500 hover:bg-blue-700 text-white font-bold rounded mb-2 focus:outline-none"><i class="fas fa-sync-alt"></i></button>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgba(241, 242, 243, 0); display: block; shape-rendering: auto;" width="130px" height="130px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
        <circle cx="84" cy="50" r="10" fill="#3be8b0">
            <animate attributeName="r" repeatCount="indefinite" dur="0.3846153846153846s" calcMode="spline" keyTimes="0;1" values="10;0" keySplines="0 0.5 0.5 1" begin="0s"></animate>
            <animate attributeName="fill" repeatCount="indefinite" dur="1.5384615384615383s" calcMode="discrete" keyTimes="0;0.25;0.5;0.75;1" values="#3be8b0;#ffb900;#6a67ce;#1aafd0;#3be8b0" begin="0s"></animate>
        </circle><circle cx="16" cy="50" r="10" fill="#3be8b0">
          <animate attributeName="r" repeatCount="indefinite" dur="1.5384615384615383s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="0;0;10;10;10" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="0s"></animate>
          <animate attributeName="cx" repeatCount="indefinite" dur="1.5384615384615383s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="16;16;16;50;84" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="0s"></animate>
        </circle><circle cx="50" cy="50" r="10" fill="#1aafd0">
          <animate attributeName="r" repeatCount="indefinite" dur="1.5384615384615383s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="0;0;10;10;10" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.3846153846153846s"></animate>
          <animate attributeName="cx" repeatCount="indefinite" dur="1.5384615384615383s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="16;16;16;50;84" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.3846153846153846s"></animate>
        </circle><circle cx="84" cy="50" r="10" fill="#6a67ce">
          <animate attributeName="r" repeatCount="indefinite" dur="1.5384615384615383s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="0;0;10;10;10" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.7692307692307692s"></animate>
          <animate attributeName="cx" repeatCount="indefinite" dur="1.5384615384615383s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="16;16;16;50;84" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.7692307692307692s"></animate>
        </circle><circle cx="16" cy="50" r="10" fill="#ffb900">
          <animate attributeName="r" repeatCount="indefinite" dur="1.5384615384615383s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="0;0;10;10;10" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-1.1538461538461537s"></animate>
          <animate attributeName="cx" repeatCount="indefinite" dur="1.5384615384615383s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="16;16;16;50;84" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-1.1538461538461537s"></animate>
        </circle>
        <!-- [ldio] generated by https://loading.io/ --></svg>
        
    @endif
</div>