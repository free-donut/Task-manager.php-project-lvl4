@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create new Task') }}</div>
                <div class="card-body">
                    {{ Form::model($task, ['url' => route('tasks.store')]) }}
                        {{Form::token()}}
                        @include('task.form')
                        <div class="form-group row mb-0">
                             <div class="col-md-6 offset-md-4">
                                {{ Form::submit(__('Create'), ['class' => 'btn btn-primary']) }}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
