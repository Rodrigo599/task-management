<div class="form-group row mb-3">
    <label for="project" class="col-md-3 col-form-label form-control-lg" style="font-weight: 600;"> Selected Project</label>
    <div class="col-md-3">
        <select wire:model="selectedProject" wire:change="updateTasks" class="form-control form-control-lg">
            @foreach($projects as $project)
                @if($loop->first)
                    <option selected value="{{ $project->id }}">{{ $project->name }}</option>
                @else
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-form-label form-control-lg" style="font-weight: 600;">Tasks</label>
</div>
@livewire('tasks')
