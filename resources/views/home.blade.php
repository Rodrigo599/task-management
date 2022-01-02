@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('projects.create') }}"><i class="fas fa-plus"></i> Create new project</a>
            </div>
        </div>
    </div>

    @livewire('projects')
</div>
@endsection