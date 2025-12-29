<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - MunchMate</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #ff4757;
            --primary-hover: #ff6b81;
            --text-dark: #2f3542;
            --text-muted: #747d8c;
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(255, 255, 255, 0.5);
            --glass-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }

        body {
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            padding: 20px;
            overflow-y: auto; /* Changed from hidden to auto */
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .auth-container {
            width: 100%;
            max-width: 1000px;
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: var(--glass-shadow);
            overflow: hidden;
            display: flex;
            min-height: 600px;
            position: relative;
        }

        .auth-content {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            z-index: 2;
        }

        .auth-image {
            flex: 1;
            background: url("{{asset('hero_burger.png')}}") no-repeat center center;
            background-size: contain;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .auth-image::before {
            content: '';
            position: absolute;
            width: 150%;
            height: 150%;
            background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0) 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
        }

        .brand-logo {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 2rem;
            align-self: flex-start;
        }

        .form-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            color: var(--text-muted);
            margin-bottom: 2rem;
        }

        .form-floating > .form-control {
            border-radius: 12px;
            border: 1px solid rgba(0,0,0,0.1);
            background: rgba(255,255,255,0.5);
        }

        .form-floating > .form-control:focus {
            box-shadow: 0 0 0 4px rgba(255, 71, 87, 0.1);
            border-color: var(--primary-color);
            background: white;
        }

        .btn-primary-custom {
            background: var(--primary-color);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            width: 100%;
            margin-top: 1rem;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 71, 87, 0.3);
            color: white;
        }

        .toggle-text {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-muted);
        }

        .toggle-link {
            color: var(--primary-color);
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: color 0.2s;
        }

        .toggle-link:hover {
            color: var(--primary-hover);
        }

        /* Slide Transition with CSS GRID */
        .form-container-slider {
            display: grid; /* Changed to grid */
            grid-template-areas: "form";
            width: 100%;
            position: relative;
        }
        
        .form-wrapper {
            grid-area: form; /* Overlap items */
            transition: all 0.5s ease-in-out;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
        }

        /* Animation States */
        .form-active {
            opacity: 1;
            transform: translateX(0);
            pointer-events: all;
            z-index: 2;
        }
        
        .form-hidden-left {
            opacity: 0;
            transform: translateX(-100%);
            pointer-events: none;
            z-index: 1;
        }
        
        .form-hidden-right {
            opacity: 0;
            transform: translateX(100%);
            pointer-events: none;
            z-index: 1;
        }

        @media (max-width: 900px) {
            .auth-container {
                flex-direction: column-reverse;
                min-height: auto;
            }
            .auth-image {
                height: 200px;
                flex: none;
            }
            .auth-content {
                padding: 30px;
            }
            .form-wrapper {
                min-height: auto;
            }
        }
    </style>
</head>
<body>

    <div class="auth-container">
        <!-- Content Side -->
        <div class="auth-content">
            <a href="/" class="brand-logo">
                <span class="material-symbols-outlined text-danger fs-1">lunch_dining</span>
                Munch<span class="text-danger">Mate</span>
            </a>

            <div class="form-container-slider">
                <!-- Login Form -->
                <div id="loginForm" class="form-wrapper form-active">
                    <div>
                        <h2 class="form-title">Welcome Back! 👋</h2>
                        <p class="form-subtitle">Enter your credentials to access your account.</p>

                        @if(Session::has('error'))
                        <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center gap-2">
                            <span class="material-symbols-outlined">error</span>
                            {{Session::get('error')}}
                        </div>
                        @endif

                        <form action="{{route('login')}}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="number" name="phone" class="form-control" id="loginPhone" placeholder="Phone" value="{{ old('phone') }}" required>
                                <label for="loginPhone">Phone Number</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="pass" class="form-control" id="loginPass" placeholder="Password" required>
                                <label for="loginPass">Password</label>
                            </div>
                            
                            <button type="submit" class="btn btn-primary-custom">Sign In</button>
                            
                            <div class="toggle-text">
                                Don't have an account? <span class="toggle-link" onclick="showSignup()">Sign Up</span>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Signup Form -->
                <div id="signupForm" class="form-wrapper form-hidden-right">
                    <div>
                        <h2 class="form-title">Get Started 🚀</h2>
                        <p class="form-subtitle">Create your account to start ordering delicious food.</p>

                        <form action="{{route('signup')}}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" name="username" class="form-control" id="signupName" placeholder="Name" required>
                                <label for="signupName">Full Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" name="phone" class="form-control" id="signupPhone" placeholder="Phone" required>
                                <label for="signupPhone">Phone Number</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="signupEmail" placeholder="Email" required>
                                <label for="signupEmail">Email Address</label>
                            </div>
                            <div class="row g-2">
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input type="password" name="pass" class="form-control" id="signupPass" placeholder="Password" required>
                                        <label for="signupPass">Password</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input type="password" name="cpass" class="form-control" id="signupConfirm" placeholder="Confirm" required>
                                        <label for="signupConfirm">Confirm</label>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary-custom">Create Account</button>
                            
                            <div class="toggle-text">
                                Already have an account? <span class="toggle-link" onclick="showLogin()">Sign In</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Side -->
        <div class="auth-image">
            <!-- Image background set via CSS -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const loginForm = document.getElementById('loginForm');
        const signupForm = document.getElementById('signupForm');

        function showSignup() {
            // Move Login out to left
            loginForm.classList.remove('form-active');
            loginForm.classList.add('form-hidden-left');
            
            // Move Signup in from right
            signupForm.classList.remove('form-hidden-right');
            signupForm.classList.add('form-active');
        }

        function showLogin() {
            // Move Signup out to right
            signupForm.classList.remove('form-active');
            signupForm.classList.add('form-hidden-right');
            
            // Move Login in from left
            loginForm.classList.remove('form-hidden-left');
            loginForm.classList.add('form-active');
        }
    </script>
</body>
</html>