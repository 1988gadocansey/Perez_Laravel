@extends('layouts.master')

@section('content')

    <h1>Perez_service_type</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>SERVICE</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $perez_service_type->id }}</td> <td> {{ $perez_service_type->SERVICE }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection