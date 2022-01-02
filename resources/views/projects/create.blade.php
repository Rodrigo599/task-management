@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-lg-12 margin-tb">
            <form action="{{ route('projects.store') }}" method="POST">
                @csrf
                <div class="row mb-4">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>New Project Name:</strong>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-lg btn-success"> Create Project</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection