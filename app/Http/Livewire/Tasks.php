<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Tasks extends Component
{
    protected $listeners = ['updateTasks'];
    public $modalOpen = false;
    public $isEdit = false;
    public $taskToEdit = null;
    public $name;

    public function mount()
    {
        $this->project = Project::first();
        $this->tasks = $this->project->tasks->sortBy('priority');
    }

    public function render()
    {
        return view('livewire.tasks', [
            'tasks' => $this->tasks
        ]);
    }

    public function updateTasks(Project $project)
    {
        $this->project = $project;
        $this->tasks = $this->project->tasks->sortBy('priority');
    }

    public function updateTaskOrder($list)
    {
        foreach ($list as $item){
            Task::find($item['value'])->update(['priority' => $item['order']]);
        }
        
        $this->tasks = Task::where('project_id', $this->project->id)->get()->sortBy('priority');
    }

    public function create()
    {
        $this->name = '';
        $this->isEdit = false;
        $this->modalOpen = true;
    }

    public function edit(Task $task)
    {
        $this->isEdit = true;
        $this->taskToEdit = $task;
        $this->name = $task->name;
        $this->modalOpen = true;
    }

    public function cancel()
    {
        $this->modalOpen = false;
    }

    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $newTask = Task::create([
            'user_id' => auth()->id(),
            'project_id' => $this->project->id,
            'priority' => $this->tasks ? $this->tasks->max('priority') + 1 : 0,
            'name' => $this->name
        ]);

        $this->tasks->push($newTask);
        $this->modalOpen = false;
        $this->name = '';

        session()->flash('message', 'Task Created');
    }

    public function update(Task $task)
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $task->update([
            'name' => $this->name
        ]);

        $this->modalOpen = false;
        $this->tasks = Task::where('project_id', $this->project->id)->get()->sortBy('priority');

        session()->flash('message', 'Task Updated');
    }

    public function delete(Task $task)
    {
        $currPriority = $task->priority;

        $task->delete();

        $ids = $this->tasks->filter(fn($item) => $item->priority > $currPriority)->pluck('id');
        DB::table('tasks')->whereIn('id', $ids)->decrement('priority');

        $this->tasks = Task::where('project_id', $this->project->id)->get()->sortBy('priority');

        session()->flash('message', 'Task Deleted');
    }
}