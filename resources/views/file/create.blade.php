@extends('layouts.dashboard')

@section('title', 'Activity 1 - CRUD')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Upload New File</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-info" href="{{ route('file.index') }}"> Back</a>
                </div>
            </div>
        </div><br>

        <div>
            @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
            @endif

            @error('file')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror

            @if(Session::has('file_uploaded'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('file_uploaded')}}
                    </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="d-flex">
                            <div class="mr-5">
                                <input type="file" name="file">
                            </div>
                        </div>
                        <div class="d-flex mt-3">
                            <div class="mr-5">
                                <button class="btn btn-danger" type="submit" href="{{ route('file.index') }}">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
