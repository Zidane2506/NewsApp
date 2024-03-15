@extends('home.parent')

@section('content')
    <div class="card p-5">
        @if (session('success'))
            <div class="alert alert-success mb-3">
                <strong>{{ session('success') }}
        @endif
        <div class="row">
            <div class="col-md-6 d-flex justify-content-center">
                @if (empty(Auth::user()->profile->image))
                    <img class="w-75" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="">
                @else
                    <img class="w-75" src="{{ Auth::user()->profile->image }}" alt="ini gambar profile">
                @endif
            </div>
            <div class="col-md-6 text-center">
                <h3>Profile Account</h3>
                <ul class="list-group">
                    <li class="list-group-item" aria-current="true">Name : {{ Auth::user()->name }}</li>
                    <li class="list-group-item">Your Email : {{ Auth::user()->email }}</li>
                    <li class="list-group-item">Your Role : {{ Auth::user()->role }}</li>
                </ul>
                @if (empty(Auth::user()->profile->image))
                <a href="{{ route('createProfile') }}" class="btn btn-primary mt-5">
                    Create<i class="bi bi-plus"></i>
                </a>
                @else
                    <a href="{{ route('editProfile') }}" class="btn btn-warning mt-5">
                        <i class="bi bi-pencil"></i>Edit Profile
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
