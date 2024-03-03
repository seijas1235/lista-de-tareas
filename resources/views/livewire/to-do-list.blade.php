<div class="container">
    @if (session()->has('msg'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Mensaje!</strong> {{session('msg')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

    @endif
    <div class="row justify-content-center text-center">
        <div class="col-6">
            <input wire:model="task" wire:keydown.enter="addTask" type="text" class="form-control">
            @error('task')
            <div class="m-4">
                <span class="alert alert-danger"> {{$message}}</span>
            </div>


            @enderror
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Hecha</th>
                    <th scope="col">Tarea</th>
                    <th scope="col">...</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($tasks as $task)
                    <tr class="{{$task->done ? 'bg-success text-white text-decoration-line-through' : ''}}" >
                        <th scope="row">
                            <input wire:click="AddDone( {{$task->id}} )" type="checkbox"
                            {{$task->done ? 'checked':''}}>
                        </th>
                        <td>{{$task->task}}</td>
                        <td>
                            <button wire:click="deleteTask({{ $task->id}})" class="btn btn-danger btn-sm">eliminar</button>
                        </td>
                      </tr>
                    @empty
                        <p>No hay tareas disponibles</p>
                    @endforelse


                </tbody>
              </table>
        </div>
    </div>

</div>
