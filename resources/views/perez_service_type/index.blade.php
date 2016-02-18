@extends('layouts.master')

@section('content')

    <h1>Perez_service_type <a href="{{ url('perez_service_type/create') }}" class="btn btn-primary pull-right btn-sm">Add New Perez_service_type</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>SERVICE</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($perez_service_type as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('perez_service_type', $item->id) }}">{{ $item->SERVICE }}</a></td>
                    <td>
                        <a href="{{ url('perez_service_type/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['perez_service_type', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $perez_service_type->render() !!} </div>
    </div>

@endsection
