@extends('layouts.app')

@section('content')
    <div class="mb-md-5 mt-md-4 pb-5">
        <h2 class="fw-bold mb-2 text-uppercase">Tambah User</h2>
        <p class="text-white-50 mb-5">Please enter your details to create an account!</p>

        <!-- Form register -->
        <form method="POST" action="{{ route('store-user') }}">
            @csrf <!-- Laravel CSRF protection -->

            <!-- Name input -->
            <div class="form-outline form-white mb-4">
                <label class="form-label" for="typeNameX">Name</label>
                <input type="text" id="typeNameX" name="name" class="form-control form-control-lg" required />
            </div>

            <!-- Email input -->
            <div class="form-outline form-white mb-4">
                <label class="form-label" for="typeEmailX">Email</label>
                <input type="email" id="typeEmailX" name="email" class="form-control form-control-lg" required />
            </div>

            <!-- Password input -->
            <div class="form-outline form-white mb-4">
                <label class="form-label" for="typePasswordX">Password</label>
                <input type="password" id="typePasswordX" name="password" class="form-control form-control-lg" required />
            </div>

            <!-- Confirm Password input -->
            <div class="form-outline form-white mb-4">
                <label class="form-label" for="typeConfirmPasswordX">Confirm Password</label>
                <input type="password" id="typeConfirmPasswordX" name="password_confirmation"
                    class="form-control form-control-lg" required />
            </div>

            <button class="btn btn-primary btn-lg px-5" type="submit">Register</button>
        </form>
    </div>
@endsection
