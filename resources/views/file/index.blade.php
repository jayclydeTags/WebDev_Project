@extends('layouts.dashboard')

@section('title', 'Activity 2 - File Upload')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 File Upload</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('file.create') }}">Add file</a>
            </div>
        </div>
    </div><br>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Filename</th>
            <th>FileType</th>
            <th>Date Created</th>
            <th>Date Updated</th>
            <th>Action</th>
        </tr>
        @foreach ($files as $file)
        <tr>
            <td style="max-width: 250px;">{{$file->filename}}</td>
            <td>{{$file->filetype}}</td>
            <td>{{$file->created_at}}</td>
            <td>{{$file->updated_at}}</td>
            <td>
                <form action="{{ route('file.destroy',$file->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <a href="{{ route('file.show',$file->id) }}" title="show">
                        <button type="button" class="btn btn-success">View</button>
                    </a>

                    <a href="{{ route('file.edit',$file->id) }}">
                        <button type="button" class="btn btn-primary">Edit</button>
                    </a>

                    <button type="submit" class="btn btn-danger" >Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

</div>

@endsection
