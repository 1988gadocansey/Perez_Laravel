@extends('layouts.master')

@section('content')

    <h1>Edit Perez_service_type</h1>
    <hr/>

    {!! Form::model($perez_service_type, [
        'method' => 'PATCH',
        'url' => ['perez_service_type', $perez_service_type->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('SERVICE') ? 'has-error' : ''}}">
                {!! Form::label('SERVICE', 'Service: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('SERVICE', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('SERVICE', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
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