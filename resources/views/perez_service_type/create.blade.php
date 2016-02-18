@extends('layouts.master')

@section('content')

    <h1>Create New Perez_service_type</h1>
    <hr/>

    {!! Form::open(['url' => 'perez_service_type', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('SERVICE') ? 'has-error' : ''}}">
                {!! Form::label('SERVICE', 'Service: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('SERVICE', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('SERVICE', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection