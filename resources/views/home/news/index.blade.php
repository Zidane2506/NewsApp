@extends('home.parent')

@section('content')
<div class="row">
    <div class="card p-4">
        <h3>News Index</h3>
        <div class="d-flex justify-content-end">
            <a href="{{ route('news.create') }}">
            <i class="bi bi-plus"></i>
            Create News
        </a>
        </div>
    </div>
</div>
@endsection