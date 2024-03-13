@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h3>Create News</h3>
            <form action="{{ route('news.update', $news->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="inputTitle" class="form-label">Title Name</label>
                    <input type="text" class="form-control" id="inputTitle" name="title" value="{{ $news->title }}">
                </div>

                <div class="mb-3">
                    <label for="inputImage" class="form-label">Image File</label>
                    <input type="file" class="form-control" id="inputImage" name="image" value="{{ old('image') }}">
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Select</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" name="category_id">
                            <option selected value="{{ $news->category->id }}">{{ $news->category->name }} ({{ $news->category->id }})</option>
                            @foreach ($category as $row)
                                <option value="{{ $row->id }}">Bro {{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <label class="col-sm-2 col-form-label">Content</label>
                <textarea name="content" id="editor">
                    {!! "$news->content" !!}
                </textarea>
                <script>
                    ClassicEditor
                        .create(document.querySelector('#editor'))
                        .then(editor => {
                            console.log(editor);
                        })
                        .catch(error => {
                            console.error(error);
                        });
                </script>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('news.index') }}" class="btn btn-danger mx-2">
                        <i class="bi bi-arrow-left"></i></a>
                    <button type="submit" class="btn btn-primary ">
                        <i class="bi bi-plus"></i> EDIT GAN!?
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
