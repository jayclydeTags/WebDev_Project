@extends('layouts.dashboard')

@section('title', 'Activity 1 - CRUD')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Laravel 8 CRUD</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('products.create') }}">Add Product</a>
                </div>
            </div>
        </div>
        <br>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered table-responsive-lg">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Date Created</th>
                <th>Actions</th>
            </tr>
            @foreach ($products as $product)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->created_at }}</td>

                    <td>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">

                            <a href="{{ route('products.show', $product->id) }}" title="show">
                                <button type="button" class="btn btn-success">View</button>
                            </a>

                            <a href="{{ route('products.edit', $product->id) }}">
                                <button type="button" class="btn btn-primary">Edit</button>
                            </a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete</button>

                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {!! $products->links() !!}
@endsection
