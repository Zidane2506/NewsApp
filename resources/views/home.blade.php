@extends('home.parent')

@section('content')
    <div class="container">
        <div class="row card p-3">
            <h1>
                Welcome {{ Auth::user()->name }}
            </h1>
            <hr>
            <div class="card-body">
                <h5 class="card-title">I Know Your...</h5>
                <!-- List group with active and disabled items -->
                <ul class="list-group">
                    <li class="list-group-item" aria-current="true">Name : {{ Auth::user()->name }}</li>
                    <li class="list-group-item">Your Email : {{ Auth::user()->email }}</li>
                    <li class="list-group-item">Your Role : {{ Auth::user()->role }}</li>
                </ul><!-- End ist group with active and disabled items -->

            </div>
        </div>
    </div>
@endsection
