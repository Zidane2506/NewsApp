@extends('home.parent')
@section('content')
    <div class="row">
        <div class="card p-4">
            <h5 class="card-title">
                {{ $news->title }}
                <p class="badge rounded-pill bg-info text-white">{{ $news->category->name }}</p>
            </h5>
            <p>
                <img src="{{ $news->image }}" alt="" class="image-fluid">

                <p id="editor" disabled>
                    {!! $news->content !!}
                </p>
            </p>

            <div class="container">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('news.index') }}" class="btn btn-primary">GO BACK!</a>
                </div>
            </div>
        </div>
    </div>
@endsection
