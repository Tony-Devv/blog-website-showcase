@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('login.check') }}" method="POST">
    @csrf

    <input type="email" name="email" placeholder="Email"
        class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email') }}">

    @error('email')
        <div class="invalid-feedback" style="color: red">{{ $message }}</div>
    @enderror

    <br>

    <input type="password" name="password" placeholder="Password"
        class="form-control @error('password') is-invalid @enderror">

    @error('password')
        <div class="invalid-feedback" style="color: red">{{ $message }}</div>
    @enderror

    <br>

    <button type="submit" class="btn btn-primary">Login</button>
</form>

<a href="{{route ('register')}}">Register</a>