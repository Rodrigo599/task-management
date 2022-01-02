<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class Tasks extends Component
{
    protected $listeners = ['updateTasks'];
    public $modalOpen = false;
    public $isEdit = false;

    public function mount()
    {
        $this->project = Project::first();
    }

    public function render()
    {
        return view('livewire.tasks', [
            'tasks' => $this->project->tasks
        ]);
    }

    public function updateTasks(Project $project)
    {
        $this->project = $project;
        $this->tasks = $this->project->tasks;
    }

    public function create()
    {
        $this->isEdit = false;
        $this->modalOpen = true;
    }

    public function edit()
    {
        $this->isEdit = true;
        $this->modalOpen = true;
    }

    public function cancel()
    {
        $this->modalOpen = false;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['string', 'max:255']
        ]);

        $data['user_id'] = auth()->id();
        $data['priority'] = $this->tasks->max('priority');

        Task::create($data);

        $this->tasks = $this->project->tasks;
        $this->modalOpen = true;
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'name' => ['string', 'max:255']
        ]);

        $task->update($data);

        $this->tasks = $this->project->tasks;
    }

    public function delete(Task $task)
    {
        $task->delete();

        $this->tasks = $this->project->tasks;
    }
}