@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h3 class="card-title">
                All User
            </h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>NO</td>
                        <td>NAME</td>
                        <td>EMAIL</td>
                        <td>ROLE</td>
                        <td>ACTION</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $acc)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $acc->name }}</td>
                            <td>{{ $acc->email }}</td>
                            <td>{{ $acc->role }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#basicModal{{ $acc->id }}">
                                    <i class="bi bi-pencil"></i>
                                    Basic Modal
                                </button>
                                <div class="modal fade" id="basicModal{{ $acc->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Reset Password {{ $acc->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Default Password Became : 123456
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Close</button>
                                                <form action="{{ route('resetPassword', $acc->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-primary">Reset Password</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End Basic Modal-->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
