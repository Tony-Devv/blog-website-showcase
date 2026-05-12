<!DOCTYPE html>
<html>
<head>
    <title>Laravel Quick Test UI</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial; padding: 20px; }
        input, textarea { display:block; margin:5px 0; padding:8px; width:300px; }
        button { padding:8px 12px; margin-top:5px; }
        .box { border:1px solid #ccc; padding:15px; margin-bottom:20px; width:350px; }
    </style>
</head>
<body>

<h1>🔥 Laravel Quick Test UI</h1>

{{-- ================= REGISTER ================= --}}
<div class="box">
    <h3>Register</h3>

    <input id="reg_name" placeholder="Name">
    <input id="reg_username" placeholder="Username">
    <input id="reg_email" placeholder="Email">
    <input id="reg_phone" placeholder="Phone">
    <input id="reg_password" placeholder="Password" type="password">
    <input id="reg_confirm" placeholder="Confirm Password" type="password">

    <button onclick="register()">Register</button>
</div>

{{-- ================= LOGIN ================= --}}
<div class="box">
    <h3>Login</h3>

    <input id="login_email" placeholder="Email">
    <input id="login_password" placeholder="Password" type="password">

    <button onclick="login()">Login</button>
</div>

{{-- ================= POSTS ================= --}}
<div class="box">
    <h3>Create Post</h3>

    <input id="title" placeholder="Title">
    <textarea id="desc" placeholder="Description"></textarea>

    <button onclick="createPost()">Add Post</button>
</div>

{{-- ================= OUTPUT ================= --}}
<h3>Response:</h3>
<pre id="output"></pre>

<script>
const output = document.getElementById("output");

function show(data) {
    output.innerText = JSON.stringify(data, null, 2);
}

// CSRF
function csrf() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

// REGISTER
function register() {
    fetch("/register", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrf()
        },
        body: JSON.stringify({
            name: reg_name.value,
            username: reg_username.value,
            email: reg_email.value,
            phone: reg_phone.value,
            password: reg_password.value,
            confirmPassword: reg_confirm.value
        })
    })
    .then(res => res.json())
    .then(show);
}

// LOGIN
function login() {
    fetch("/login", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrf()
        },
        body: JSON.stringify({
            email: login_email.value,
            password: login_password.value
        })
    })
    .then(res => res.json())
    .then(show);
}

// CREATE POST
function createPost() {
    fetch("/posts", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrf()
        },
        body: JSON.stringify({
            title: title.value,
            description: desc.value
        })
    })
    .then(res => res.json())
    .then(show);
}
</script>

</body>
</html>