@extends('layouts.app')

@section('content')
    <div class="mb-md-5 mt-md-4 pb-5">
        <h2 class="fw-bold mb-2 text-uppercase">Edit User</h2>
        <p class="text-white-50 mb-5">Please update the user's details below!</p>

        <!-- Form edit -->
        <form method="POST" action="{{ route('update-user', $user->id) }}">
            @csrf <!-- Laravel CSRF protection -->
            @method('PUT') <!-- Laravel method for updating -->

            <!-- Name input -->
            <div class="form-outline form-white mb-4">
                <label class="form-label" for="typeNameX">Name</label>
                <input type="text" id="typeNameX" name="name" class="form-control form-control-lg" value="{{ old('name', $user->name) }}" required />
            </div>

            <!-- Email input -->
            <div class="form-outline form-white mb-4">
                <label class="form-label" for="typeEmailX">Email</label>
                <input type="email" id="typeEmailX" name="email" class="form-control form-control-lg" value="{{ old('email', $user->email) }}" required />
            </div>

            <!-- Password input (optional) -->
            <div class="form-outline form-white mb-4">
                <label class="form-label" for="typePasswordX">New Password (Leave blank if not changing)</label>
                <input type="password" id="typePasswordX" name="password" class="form-control form-control-lg" />
            </div>

            <!-- Confirm Password input (optional) -->
            <div class="form-outline form-white mb-4">
                <label class="form-label" for="typeConfirmPasswordX">Confirm New Password</label>
                <input type="password" id="typeConfirmPasswordX" name="password_confirmation" class="form-control form-control-lg" />
            </div>

            <button class="btn btn-primary btn-lg px-5" type="submit">Update</button>
        </form>
    </div>
@endsection