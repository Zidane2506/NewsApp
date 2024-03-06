@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h3>Create News</h3>
            <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="mb-3">
                    <label for="inputTitle" class="form-label">Title Name</label>
                    <input type="text" class="form-control" id="inputTitle" name="title" value="{{ old('title') }}">
                </div>

                <div class="mb-3">
                    <label for="inputImage" class="form-label">Image File</label>
                    <input type="file" class="form-control" id="inputImage" name="image" value="{{ old('image') }}">
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Select</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" name="category_id">
                            <option selected="">==== Choose Your Bro ====</option>
                            @foreach ($category as $row)
                                <option value="{{ $row->id }}">Bro {{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <label class="col-sm-2 col-form-label">Content</label>
                <textarea name="content" id="editor">
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

                <div class="d-flex justify-content-end mt-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-plus"></i>
                        Create News
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
