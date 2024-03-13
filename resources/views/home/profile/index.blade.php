@extends('home.parent')

@section('content')
<div class="card">
    <div class="row">
        <div class="col-md-6 d-flex justify-content-center">
            <img class="w-25" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="">
        </div>
        <div class="col-md-6 text-center">
            <h3>Profile Account</h3>
            <ul class="list-group">
                <li class="list-group-item" aria-current="true">Name : {{ Auth::user()->name }}</li>
                <li class="list-group-item">Your Email : {{ Auth::user()->email }}</li>
                <li class="list-group-item">Your Role : {{ Auth::user()->role }}</li>
            </ul>
        </div>
    </div>
</div>
@endsection