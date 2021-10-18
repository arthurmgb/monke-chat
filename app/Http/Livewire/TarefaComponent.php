<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tarefa;
use Livewire\WithPagination;

class TarefaComponent extends Component
{
    use WithPagination;

    public $name, $tarefa_id;
    public $acao = "store";

    protected $rules = [
        'name' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Qual o sentido de adicionar uma anotação vazia? =)'
    ];

    public function render()
    {
        $tarefas = Tarefa::where('user_id', auth()->user()->id)
                            ->latest('id')
                            ->paginate(5);
        return view('livewire.tarefa-component', compact('tarefas'));
    }
    public function store(){

        $this->validate();

        Tarefa::create([
            'nome' => $this->name,
            'checked' => 0,
            'user_id' => auth()->user()->id,
        ]);

        $this->reset([
            'name',
        ]);
        
        $this->resetPage();
        
        session()->flash('message', 'Anotação criada com sucesso.');
    }

    public function edit(Tarefa $tarefa){
        $this->name = $tarefa->nome;
        $this->tarefa_id = $tarefa->id;
        $this->acao = "update";
    }

    public function update(){

        $this->validate();

        $tarefa = Tarefa::find($this->tarefa_id);
        $tarefa->update([
            'nome'=> $this->name,
        ]);

        $this->reset([
            'name',
            'acao',
            'tarefa_id',
        ]);

        session()->flash('message', 'Anotação editada com sucesso.');

    }

    public function default(){
        $this->reset([
            'name',
            'acao',
            'tarefa_id',
        ]);
    }

    public function destroy(Tarefa $tarefa){

        $tarefa->delete();
        
    }

    public function toggle(Tarefa $tarefa){

        $this->tarefa_id = $tarefa->id;
        $this->tarefa_checked = $tarefa->checked;
        $tarefa = Tarefa::find($this->tarefa_id);
        if($this->tarefa_checked == 0){
            $tarefa->update([
                'checked'=> '1',
            ]);
        }else{
            $tarefa->update([
                'checked'=> '0',
            ]);
        }

        
    }

}
