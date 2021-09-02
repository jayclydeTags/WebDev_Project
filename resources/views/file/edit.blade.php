@extends('layouts.dashboard')

@section('title', 'Activity 1 - CRUD')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit File</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-info" href="{{ route('file.index') }}"> Back</a>
                </div>
            </div>
        </div>
        <br>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Warning!</strong> Please check your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
            </div>
        @endif

        @if(Session::has('file_updated'))
            <div class="alert alert-success" role="alert">
                {{Session::get('file_updated')}}
            </div>
        @endif

        <div>
            <div class="card">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                @endif

                <img src="{{ asset($filepath) }}" class="card-img-top" style="height: auto; width: 500px;">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="ml-4 mt-0">
                                <form method="POST" action="{{ route('file.update', $file->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="id" value="{{$file->id}}"/>
                                    <strong>Filename:</strong>
                                    <div class="d-flex">
                                        <div class="ml-2"><div class="row">
                                            <div class="form-group">
                                                <input type="text" name="filename" class="form-control" value="{{ $file->filename }}" placeholder="Filename">
                                            </div>
                                        <div>
                                        <div><button type="submit" class="btn btn-info" >Rename</button></div>
                                    </div>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
