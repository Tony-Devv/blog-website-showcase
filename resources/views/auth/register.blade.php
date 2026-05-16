@extends('layouts.app')

@section('content')
    <main id="signup"
        class="min-h-screen antialiased overflow-hidden
        bg-[radial-gradient(circle_at_top,#13203f_0%,#050816_40%,#02040b_100%)]
        text-[#e2e2e9] font-[Inter,sans-serif] relative">

        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-blue-600/10 blur-[140px] rounded-full"></div>
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-indigo-500/10 blur-[140px] rounded-full"></div>

        <section class="flex min-h-screen w-full relative">

            <section
                class="hidden lg:flex lg:w-1/2 min-h-screen relative overflow-hidden items-center justify-center border-r border-white/5">

                <div
                    class="absolute inset-0 [background-image:radial-gradient(rgba(255,255,255,0.04)_1px,transparent_1px)] [background-size:24px_24px] z-0">
                </div>

                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 via-transparent to-indigo-500/10">
                </div>

                <div class="relative z-20 p-16 flex flex-col justify-between h-full w-full">

                    <div class="flex items-center gap-3">
                        <div
                            class="w-11 h-11 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                            <i class="fa-solid fa-pen-clip text-white text-lg"></i>
                        </div>
                        <span class="text-2xl font-black tracking-tight text-white uppercase">InkWell</span>
                    </div>

                    <div>
                        <h1 class="text-7xl font-black tracking-tighter text-white leading-[0.9] max-w-md">
                            CREATE YOUR
                            <span class="bg-gradient-to-r from-blue-400 to-indigo-400 bg-clip-text text-transparent">DIGITAL</span>
                            LEGACY
                        </h1>
                        <p class="mt-8 text-slate-400 text-lg max-w-sm leading-relaxed">
                            Join a modern platform crafted for writers, thinkers, and creators who
                            want their stories to stand out.
                        </p>
                    </div>

                    <div class="flex gap-12">
                        <div>
                            <div class="text-white text-2xl font-bold">12k+</div>
                            <div class="text-slate-500 text-xs tracking-widest uppercase mt-1">Stories Published</div>
                        </div>
                        <div>
                            <div class="text-white text-2xl font-bold">4.8m</div>
                            <div class="text-slate-500 text-xs tracking-widest uppercase mt-1">Monthly Readers</div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="w-full lg:w-1/2 min-h-screen flex items-center justify-center p-8 relative overflow-y-auto">

                <div
                    class="relative z-10 w-full max-w-md bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-3xl p-8 shadow-[0_20px_80px_rgba(0,0,0,0.45)]">

                    <div class="space-y-4 mb-8">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/[0.03] border border-white/10">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-pulse"></span>
                            <span class="text-[10px] font-bold tracking-[0.2em] text-slate-400 uppercase">JOIN INKWELL</span>
                        </div>
                        <h2 class="text-4xl font-black tracking-tight text-white">Create your account</h2>
                        <p class="text-slate-400 text-sm">Start your journey with the next generation writing platform.</p>
                    </div>

                    <div id="signup-error" class="hidden bg-red-500/10 border border-red-500/20 text-red-400 p-4 rounded-xl text-sm mb-6"></div>

                    <form action="{{ route('register.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="text-[11px] font-black tracking-widest text-slate-400 uppercase ml-1">Full Name</label>
                                <input id="full-name" name="name" value="{{ old('name') }}" type="text"
                                    placeholder="John Doe"
                                    class="w-full bg-white/[0.04] border border-white/5 rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500/30 placeholder:text-slate-500 transition-all duration-300" />
                                <span id="signup-error-name" class="text-red-400 text-[10px] hidden">Name must be at least 3 characters</span>
                                @error('name')<p class="text-red-400 text-xs ml-1">{{ $message }}</p>@enderror
                            </div>

                            <div class="space-y-1">
                                <label class="text-[11px] font-black tracking-widest text-slate-400 uppercase ml-1">Username</label>
                                <input id="username" name="username" value="{{ old('username') }}" type="text"
                                    placeholder="username"
                                    class="w-full bg-white/[0.04] border border-white/5 rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500/30 placeholder:text-slate-500 transition-all duration-300" />
                                <span id="signup-error-username" class="text-red-400 text-[10px] hidden">Username must be at least 3 characters</span>
                                @error('username')<p class="text-red-400 text-xs ml-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="text-[11px] font-black tracking-widest text-slate-400 uppercase ml-1">Email Address</label>
                            <input id="signup-email" name="email" value="{{ old('email') }}" type="email"
                                placeholder="john@inkwell.com"
                                class="w-full bg-white/[0.04] border border-white/5 rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500/30 placeholder:text-slate-500 transition-all duration-300" />
                            <span id="signup-error-email" class="text-red-400 text-[10px] hidden">Please enter a valid email address</span>
                            @error('email')<p class="text-red-400 text-xs ml-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="space-y-1">
                            <label class="text-[11px] font-black tracking-widest text-slate-400 uppercase ml-1">Phone Number</label>
                            <input id="phone" name="phone" value="{{ old('phone') }}" type="tel"
                                placeholder="12345678"
                                class="w-full bg-white/[0.04] border border-white/5 rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500/30 placeholder:text-slate-500 transition-all duration-300" />
                            <span id="signup-error-phone" class="text-red-400 text-[10px] hidden">Please enter a valid phone number</span>
                            @error('phone')<p class="text-red-400 text-xs ml-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="space-y-1">
                            <label class="text-[11px] font-black tracking-widest text-slate-400 uppercase ml-1">Password</label>
                            <input id="signup-password" name="password" type="password"
                                placeholder="••••••••"
                                class="w-full bg-white/[0.04] border border-white/5 rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500/30 placeholder:text-slate-500 transition-all duration-300" />
                            <div id="password-requirements" class="space-y-1 mt-2 hidden">
                                <div id="req-length" class="text-[10px] text-slate-400 flex items-center gap-2"><i class="fa-solid fa-circle-xmark"></i> 8+ characters</div>
                                <div id="req-special" class="text-[10px] text-slate-400 flex items-center gap-2"><i class="fa-solid fa-circle-xmark"></i> Special character (@$!%*?&)</div>
                                <div id="req-case" class="text-[10px] text-slate-400 flex items-center gap-2"><i class="fa-solid fa-circle-xmark"></i> Upper & Lowercase</div>
                                <div id="req-digit" class="text-[10px] text-slate-400 flex items-center gap-2"><i class="fa-solid fa-circle-xmark"></i> At least one digit</div>
                            </div>
                            @error('password')<p class="text-red-400 text-xs ml-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="space-y-1">
                            <label class="text-[11px] font-black tracking-widest text-slate-400 uppercase ml-1">Confirm Password</label>
                            <input id="confirm-password" type="password"
                                placeholder="••••••••"
                                class="w-full bg-white/[0.04] border border-white/5 rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500/30 placeholder:text-slate-500 transition-all duration-300" />
                            <div id="confirm-match-msg" class="text-[10px] text-slate-400 flex items-center gap-2 mt-1 hidden">
                                <i class="fa-solid fa-circle-xmark"></i> Passwords match
                            </div>
                        </div>

                        <div class="flex items-start gap-3 pt-1">
                            <input id="terms" type="checkbox"
                                class="mt-1 rounded border-white/10 bg-white/[0.04] text-blue-500 focus:ring-blue-500/20" />
                            <label class="text-xs text-slate-400 leading-relaxed">
                                I agree to the
                                <a class="text-white font-semibold hover:text-blue-400 transition-colors" href="#">Terms of Service</a>
                                and
                                <a class="text-white font-semibold hover:text-blue-400 transition-colors" href="#">Privacy Policy</a>.
                            </label>
                        </div>
                        <span id="terms-error" class="hidden text-red-400 text-[10px]">You must agree to the Terms of Service</span>

                        <button type="submit"
                            class="w-full py-4 rounded-2xl bg-gradient-to-r from-blue-500 to-indigo-600 hover:scale-[1.01] hover:brightness-110 active:scale-[0.98] transition-all duration-300 font-black text-white shadow-[0_10px_40px_rgba(59,130,246,0.35)]">
                            Create Account
                        </button>
                    </form>

                    <p class="text-slate-400 text-sm mt-8 text-center">
                        Already a member?
                        <a class="text-blue-400 font-semibold hover:underline" href="{{ route('login') }}">Sign in</a>
                    </p>
                </div>
            </section>
        </section>
    </main>

<script>
(function() {
    const form = document.querySelector('form');
    const name = document.getElementById('full-name');
    const username = document.getElementById('username');
    const email = document.getElementById('signup-email');
    const phone = document.getElementById('phone');
    const password = document.getElementById('signup-password');
    const confirm = document.getElementById('confirm-password');
    const terms = document.getElementById('terms');
    const errBox = document.getElementById('signup-error');
    const termsErr = document.getElementById('terms-error');

    const touched = {};

    function showError(id, show) {
        const el = document.getElementById(id);
        if (el) el.classList.toggle('hidden', !show);
    }

    function validateName() {
        const ok = name.value.trim().length >= 3;
        if (touched.name) showError('signup-error-name', !ok);
        return ok;
    }

    function validateUsername() {
        const ok = username.value.trim().length >= 3;
        if (touched.username) showError('signup-error-username', !ok);
        return ok;
    }

    function validateEmail() {
        const ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim());
        if (touched.email) showError('signup-error-email', !ok);
        return ok;
    }

    function validatePhone() {
        if (!phone.value.trim()) { showError('signup-error-phone', false); return true; }
        const ok = /^[0-9]{6,15}$/.test(phone.value.trim());
        if (touched.phone) showError('signup-error-phone', !ok);
        return ok;
    }

    // Blur-first: show error on first blur, then live-validate on input
    function addBlurValidation(id, key, fn) {
        const el = document.getElementById(id);
        if (!el) return;
        el.addEventListener('blur', function() { touched[key] = true; fn(); });
        el.addEventListener('input', function() { if (touched[key]) fn(); });
    }

    addBlurValidation('full-name', 'name', validateName);
    addBlurValidation('username', 'username', validateUsername);
    addBlurValidation('signup-email', 'email', validateEmail);
    addBlurValidation('phone', 'phone', validatePhone);

    // Password requirements
    function updateReq(id, ok) {
        const el = document.getElementById(id);
        if (!el) return;
        el.querySelector('i').className = ok ? 'fa-solid fa-circle-check' : 'fa-solid fa-circle-xmark';
        el.classList.toggle('text-green-400', ok);
        el.classList.toggle('text-slate-400', !ok);
    }

    function checkPassword() {
        const pw = password.value;
        updateReq('req-length', pw.length >= 8);
        updateReq('req-special', /[@$!%*?&]/.test(pw));
        updateReq('req-case', /[A-Z]/.test(pw) && /[a-z]/.test(pw));
        updateReq('req-digit', /\d/.test(pw));
    }

    function checkConfirm() {
        const ok = password.value.length > 0 && password.value === confirm.value;
        const msg = document.getElementById('confirm-match-msg');
        if (msg) {
            msg.querySelector('i').className = ok ? 'fa-solid fa-circle-check' : 'fa-solid fa-circle-xmark';
            msg.classList.toggle('text-green-400', ok);
            msg.classList.toggle('text-slate-400', !ok);
        }
    }

    password.addEventListener('focus', function() {
        document.getElementById('password-requirements').classList.remove('hidden');
    });

    password.addEventListener('input', function() {
        document.getElementById('password-requirements').classList.remove('hidden');
        checkPassword();
        checkConfirm();
    });

    password.addEventListener('blur', function() {
        touched.password = true;
        if (document.querySelectorAll('.text-green-400').length === 4) {
            document.getElementById('password-requirements').classList.add('hidden');
        }
    });

    confirm.addEventListener('focus', function() {
        document.getElementById('confirm-match-msg').classList.remove('hidden');
    });

    confirm.addEventListener('input', checkConfirm);

    confirm.addEventListener('blur', function() {
        touched.confirm = true;
        if (password.value.length > 0 && password.value === confirm.value) {
            document.getElementById('confirm-match-msg').classList.add('hidden');
        }
    });

    form.addEventListener('submit', function(e) {
        errBox.classList.add('hidden');
        termsErr.classList.add('hidden');

        // Mark all as touched so errors show
        ['name', 'username', 'email', 'phone', 'password', 'confirm'].forEach(function(k) { touched[k] = true; });

        var errors = [];
        if (!validateName()) errors.push('Name must be at least 3 characters');
        if (!validateUsername()) errors.push('Username must be at least 3 characters');
        if (!validateEmail()) errors.push('Please enter a valid email address');
        if (!validatePhone()) errors.push('Please enter a valid phone number (6-15 digits)');
        if (!terms.checked) { termsErr.classList.remove('hidden'); errors.push('You must agree to the Terms of Service'); }

        if (errors.length > 0) {
            e.preventDefault();
            errBox.innerHTML = '<ul class="list-disc pl-4">' + errors.map(function(e) { return '<li>' + e + '</li>'; }).join('') + '</ul>';
            errBox.classList.remove('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });
})();
</script>
@endsection