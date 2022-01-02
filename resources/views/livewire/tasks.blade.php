@if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

@if(!$modalOpen)
<table class="table table-hover mb-0 mt-2">
    <thead>
        <tr class="table-success">
            <th style="padding: 5px 12px"><i class="fas fa-sort"></i></th>
            <th style="padding: 5px 12px"><i class="fas fa-hashtag"></i></th>
            <th style="padding: 5px 12px">Name</th>
            <th style="padding: 5px 12px">Actions</th>
        </tr>
    </thead>
    <tbody wire:sortable="updateTaskOrder">
    @forelse($tasks as $task)
        <tr wire:sortable.item="{{ $task->id }}" wire:key="task-{{ $task->id }}" style="cursor: pointer; border: solid thin;" data-toggle="collapse" data-target  ="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <td wire:sortable.handle data-toggle="tooltip" style="cursor: move; width: 20px" data-placement="top" title="Clique e Arraste para mover essa opçao"><i class="fas fa-grip-vertical" style="font-size: 20px;"></i></td>
            <td wire:sortable.handle>{{$task->priority}}</td>
            <td wire:sortable.handle>{{$task->name}}</td>
            <td>
                <div class="float-left">
                    <a class="btn btn-sm btn-warning" wire:click="edit({{ $task->id }})" title="Edit Task">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-sm btn-danger" wire:click="delete({{ $task->id }})" title="Delete Task">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td class="justify-content-center" colspan="4">No tasks added in this project...</td>
        </tr>
    @endforelse
    <tr style="cursor: pointer" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"  onclick="window.location='{{ route("tasks.create", ["project" => $project->id]) }}'">
        <td wire:click="create()" colspan="4"><i class="fas fa-plus"></i>&nbsp&nbsp Add Task</td>
    </tr>
    </tbody>
</table>

@else
    <h1>For the day I die</h1>
@endif