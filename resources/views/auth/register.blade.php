<div class="container mt-5" style="max-width: 500px;">

    <div class="card shadow p-4 rounded-4">

        <h2 class="text-center mb-4">Create Account</h2>

        <form action="{{ route('register.store') }}" method="POST">

            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label class="form-label">Full Name</label>

                <input type="text" name="name" placeholder="Enter your name" class="form-control"
                value="{{ old('name') }}">

                @error('name')
                    <div class="invalid-feedback" style="color: red">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email Address</label>

                <input type="text" name="email" class="form-control"
                    value="{{ old('email') }}" placeholder="Enter your email" >

                @error('email')
                    <div class="invalid-feedback"  style="color: red">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="form-label">Password</label>

                <input type="password" name="password" class="form-control"
                    placeholder="Enter your password">

                @error('password')
                    <div class="invalid-feedback"  style="color: red">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Button -->
            <button type="submit" class="btn btn-dark w-100">
                Sign Up
            </button>

        </form>

    </div>

</div>
