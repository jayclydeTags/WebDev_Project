@extends('layouts.dashboard')

@section('title', 'Activity 1 - CRUD')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>View Details</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-info" href="{{ route('file.index') }}">Back</a>
                    <a class="btn btn-success" href="{{ route('file.edit', $file->id) }}">Edit</a>
                </div>
            </div>
        </div>
        <br>
        <div>
            <div class="card">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                @endif

                <img src="{{ url($filepath) }}" class="card-img-top" style="height: auto; width: 500px;">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Filename:</strong>
                            {{ $file->filename }}
                        </li>
                        <li class="list-group-item">
                            <strong>Filetype:</strong>
                            {{ $file->filetype }}
                        </li>
                        <li class="list-group-item">
                            <strong>Date Uploaded:</strong>
                            {{ $file->created_at }}
                        </li>
                        <li class="list-group-item">
                            <strong>Date Updated:</strong>
                            {{ $file->updated_at }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
