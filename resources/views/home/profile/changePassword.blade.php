@extends('home.parent')

@section('content')
    <div class="row">
        

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card p-4">
            <h3 class="card-title">Change Password</h3>
            <form action="{{ route('profile.updatePassword') }}" method="post">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password :</label>
                    <div class="col-sm-10">
                        <input name="currentPassword" type="password" class="form-control" placeholder="Curent Password">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">New Password :</label>
                    <div class="col-sm-10">
                        <input name="password" type="password" class="form-control" placeholder="New Password">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input name="confirmationPassword" type="password" class="form-control"
                            placeholder="Confirmation Password">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
        </div>
    </div>
@endsection
