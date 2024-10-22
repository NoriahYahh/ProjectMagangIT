@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Data Users</h1>
        <a class="btn btn-primary btn-lg px-5"href="{{ route('add-user') }}">Add user</a>

        @if ($users->isNotEmpty())
            <div class="table-responsive mt-4">
                <table class="table table-bordered text-center table-hover">
                    <thead class="thead-dark thead-custom">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1; // Definisikan nomor urut di luar loop
                        @endphp
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('edit-user', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('delete-user', $user->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning mt-4" role="alert">
                No users found.
            </div>
        @endif
    </div>
@endsection
