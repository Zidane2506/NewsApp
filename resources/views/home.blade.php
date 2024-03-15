@extends('home.parent')

@section('content')
    <div class="container">
        <div class="row card p-4">
            <h1>
                Welcome {{ Auth::user()->name }}
            </h1>
            <hr>
            <div class="card">
                <div class="card-title">
                    <h3>Detail Card</h3>
                </div>
                <!-- List group with active and disabled items -->
                <ul class="list-group">
                    <li class="list-group-item active" aria-current="true">Name Account : <strong>Admin</strong></li>
                    <li class="list-group-item">Email Account : <strong>{{ Auth::user()->email }}</strong></li>
                    <li class="list-group-item">Role Account : <strong>{{ Auth::user()->role }}</strong></li>
                    <li class="list-group-item disabled" aria-disabled="true">A disabled item</li>
                </ul><!-- End ist group with active and disabled items -->

            </div>

        </div>
        
    </div>
@endsection