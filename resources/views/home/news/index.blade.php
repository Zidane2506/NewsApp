@extends('home.parent')

@section('content')
    <div class="row">
        @if (session('success'))
            <div class="alert alert-success">
                <strong>{{ session('success') }}
        @endif
        <div class="card p-4">
            <h3>News Index</h3>
            <div class="d-flex justify-content-end">
                <a href="{{ route('news.create') }}">
                    <i class="bi bi-plus"></i>
                    Create News
                </a>
            </div>

            <div class="container mt-3">
                <div class="card p-3">
                    <h5 class="card-title">
                        Data News
                    </h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Image Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($news as $brosky)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $brosky->title }}</td>
                                    <td>{{ $brosky->category->name }}</td>
                                    <td>
                                        <img src="{{ $brosky->image }}" alt="" width="100px"></td>
                                    <td>
                                        <img src="{{ $brosky->category->image }}" alt="" width="100px">
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">  
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <a href="#" class="btn btn-warning">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="#" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            <p class="text-center">
                                Data masih Kosong
                            </p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
