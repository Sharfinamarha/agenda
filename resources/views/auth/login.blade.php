@extends('layouts.main')
@section('title', 'Login')
@section('container')
    <div class="row d-flex justify-content-center">
        <div class="col-8">
            @if (session('alert_message'))
                <div class="alert alert-{{ session('alert_type') }}">
                    {{ session('alert_message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h1 class="display-6 text-secondary">LOGIN</h1>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><span class="bi bi-mailbox2"></span></span>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" aria-label="Email" value="{{ old('value') }}" required />
                            </div>
                            @error('email')
                            <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><span class="bi bi-key-fill"></span></span>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" aria-label="Password"
                                    required>
                            </div>
                            @error('password')
                            <div id="passwordHelp" class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
