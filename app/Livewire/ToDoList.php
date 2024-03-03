<?php

namespace App\Livewire;

use App\Models\ToDoList as AppToDoList;
use Illuminate\Console\View\Components\Task;
use Livewire\Component;

class ToDoList extends Component
{
    public $task='';
    public function render()
    {
        $tasks=AppToDoList::all()->reverse();
        return view('livewire.to-do-list',compact('tasks'));
    }

    public function addTask(){
        $rules=[
            'task'=>'required|min:5'
        ];
        $messages=[
            'task.required'=>'La tarea es requerida',
            'task.min'=>'la tarea debe tener minimo 5 caracteres'
        ];
        $this->validate($rules,$messages);

        $newTask= new AppToDoList();
        $newTask->task=$this->task;
        $newTask->save();
        $this->task='';
        session()->flash('msg','Tarea Creada con exito');

    }
    public function AddDone(AppToDoList $task){
        $task->update(['done'=>!$task->done]);
    }
    public function deleteTask(AppToDoList $task){
        $task->delete();
        session()->flash('msg','Tarea eliminada con exito');

    }
}
