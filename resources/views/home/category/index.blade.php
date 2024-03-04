@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h5>Category</h5>
            <div class="d-flex justify-content-end">
                <a href="{{ route('category.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i>
                    Create Category
                </a>
            </div>
            <div class="container mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="">Data Category</h5>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Menampilkan data dengan perulangan foreach dari category Model --}}
                                @forelse ($category as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->slug }}</td>
                                        <td>
                                            <img src="{{ $row->image }}" alt="Image Brosky" width="100px">
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#basicModal{{ $row->id }}">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <a href="{{ route('category.edit', $row->id) }}" class="btn btn-warning">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <form action="{{ route('category.destroy', $row->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            @include('home.includes.modalShow')
                                        </td>
                                    @empty
                                        <p>Belum ada cateogry, data masih kosong.</p>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- Paginate --}}
                        {{ $category->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
