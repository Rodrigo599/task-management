<div>
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
                <th style="padding: 5px 12px"><i class="fas fa-hashtag"></i> Priority</th>
                <th style="padding: 5px 12px">Name</th>
                <th style="padding: 5px 12px">Actions</th>
            </tr>
        </thead>
        <tbody wire:sortable="updateTaskOrder">
        @forelse($tasks as $task)
            <tr wire:sortable.item="{{ $task->id }}" wire:key="task-{{ $task->id }}" style="cursor: pointer; border: solid thin;" data-toggle="collapse" data-target  ="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <td wire:sortable.handle data-toggle="tooltip" style="cursor: move; width: 20px" data-placement="top" title="Click and drag to sort task"><i class="fas fa-grip-vertical" style="font-size: 20px;"></i></td>
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
        <tr style="cursor: pointer" wire:click="create()">
            <td colspan="4"><i class="fas fa-plus"></i>&nbsp&nbsp Add Task</td>
        </tr>
        </tbody>
    </table>

    @else
        <form>
            <div class="row justify-content-center mb-3">
                <div class="col-lg-12 margin-tb">
                    <div class="row mb-4">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Task Name:</strong>
                                <input type="text" wire:model="name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        @if(!$isEdit)
                            <button wire:click.prevent="store()" type="button" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Create Task
                            </button>
                        @else
                            <button wire:click.prevent="update({{ $taskToEdit }})" type="button" class="btn btn-primary">
                                Update Task
                            </button>
                        @endif
                        <button wire:click="cancel()" type="button" class="btn btn-danger">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </div>
            </div>
        </form>

    @endif
</div>