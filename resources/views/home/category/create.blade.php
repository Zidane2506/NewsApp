@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card">
            <h3 class="mt-2">Create Category</h3>
            <div class="card-body p-3">
                <hr>
                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                    @csrf
                    @method('POST')
                    <div class="col-12 mt-2">
                        <label for="inputNanme4" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="inputNanme" name="name"
                            value="{{ old('name') }}">
                    </div>
                    <div class="col-12 mt-2">
                        <label for="inputImage" class="form-label">Category Image</label>
                        <input type="file" class="form-control" id="inputFile" name="image">
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <button type="submit" class="btn btn-primary mt-3">
                            <i class="bi bi-pencil-squere"></i> Edit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
