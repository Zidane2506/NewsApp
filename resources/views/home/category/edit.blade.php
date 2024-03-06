@extends('home.parent')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>
                        <strong>{{ $error }}</strong>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="card">
            <h5 class="mt-2">Ini halaman Edit</h5>

            <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-12 mt-2">
                    <label for="inputNanme4" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="inputNanme" name="name" value="{{ $category->name }}">
                </div>
                <div class="col-12 mt-2">
                    <label for="inputImage" class="form-label">Category Image</label>
                    <input type="file" class="form-control" id="inputFile" name="image">
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('category.index') }}" class="btn btn-danger mx-2">
                        <i class="bi bi-arrow-left"></i></a>
                    <button type="submit" class="btn btn-primary ">
                        <i class="bi bi-plus"></i> Finish Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
