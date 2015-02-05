@extends('master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>Hello {{$user->name}}</h2>
        </div>
    </div>
    @if(isset($success))
        <div class="alert alert-success" role="alert">{{$success}}</div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="timer-controls">
                <div class="input">
                    @if($running)
                        <input type="text" name="name" id="name" value="{{$running->name}}" disabled/>
                    @else
                        <input type="text" name="name" id="name" placeholder="What are you working on?"/>
                    @endif
                </div>
                <div class="projects">
                    <select name="project" id="project">
                        @forelse($projects as $project)
                            <option value="{{$project->id}}" {{ ( $running && $project->id === $running->project_id ? 'selected' : '' ) }}>{{$project->name}}</option>
                        @empty
                            <option value="-1">You have no projects</option>
                        @endforelse
                    </select>

                </div>
                <div class="timer">
                    @if($running)
                        <span class="timer-clock" data-start="{{ $running->start }}000"></span>
                        <button class="timer-btn-stop btn btn-default btn-large btn-danger" data-id="{{$running->id}}">Stop</button>
                    @else
                        <button class="timer-btn-start btn btn-default btn-large btn-success">Start</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <td>Name</td>
                    <td>Start</td>
                    <td>End</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @forelse($timers as $timer)
                    <tr>
                        <td>{{$timer->name}}<br/><small>{{$timer->project->name}}</small></td>
                        <td>{{$timer->getStartTimer()}}</td>
                        <td>{{$timer->getEndTimer()}}</td>
                        <td></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">You have not yet created any timers.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop