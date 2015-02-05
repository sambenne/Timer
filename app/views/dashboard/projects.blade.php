@extends('master')

@section('content')
    @if(isset($success))
        <div class="alert alert-success" role="alert">{{$success}}</div>
    @endif

    <h2>Projects</h2>
    <div class="row">
        <div class="login col-md-6">
            {{ Form::open(['url' => 'projects', 'class'=>'form', 'method' => 'POST']) }}
            <p>
                {{ $errors->first('name') }}
            </p>
            {{ Form::text('name', null, ['placeholder' => 'Projects', 'class'=> 'form-control', 'required' => 'required', 'autofocus' => 'autofocus' ]) }}
            {{ Form::submit('Add', ['class' => 'btn btn-lg btn-primary btn-block']) }}
            {{ Form::close() }}
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="login col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                        <tr>
                            <td>{{$project->name}}</td>
                            <td></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">You have not yet created any projects.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop