@extends('layouts.admin.app')
@section('content')
<div class="container">
    <h2>Tambah User</h2>
    <p>Form untuk menambahkan data user baru.</p>

    {{-- Flash Message Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required> <!--[cite: 1, 3] -->
            </div>

            <div class="col-md-6 mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required> <!--[cite: 1, 3] -->
            </div>

            <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required> <!--[cite: 1, 3] -->
            </div>

            <div class="col-md-6 mb-3">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required> <!--[cite: 1, 3] -->
            </div>
        </div>

        <button type="submit" class="btn btn-dark">Simpan</button>
        <a href="{{ route('user.index') }}" class="btn btn-light">Batal</a>
    </form>
</div>
@endsection