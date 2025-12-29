<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - MunchMate</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #ff6b6b;
            --primary-hover: #ff5252;
            --bg-gradient: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-gradient);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 900px;
            min-height: 600px;
            position: relative;
            display: flex;
        }

        .auth-side-img {
            flex: 1;
            background: url("{{asset('hero_burger.png')}}") no-repeat center center;
            background-size: contain;
            background-color: #ffeaa7;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        /* Decorative circle behind image */
        .auth-side-img::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 107, 107, 0.1);
            border-radius: 50%;
            z-index: 1;
        }

        .auth-form-container {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        /* ... existing styles ... */

        .brand-logo {
            /* Removed absolute positioning to prevent overlap */
            margin-bottom: 30px;
            font-weight: 800;
            font-size: 1.5rem;
            color: #2d3436;
            display: flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
            width: fit-content;
        }

        @media (max-width: 768px) {
            .auth-card {
                flex-direction: column;
                min-height: auto;
            }
            .auth-side-img {
                height: 200px;
                order: -1;
            }
            .auth-form-container {
                padding: 30px;
            }
        }
        
        /* Animation classes */
        .form-section {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="auth-card">
        
        <!-- Forms Container -->
        <div class="auth-form-container">
            
            <!-- Brand Logo -->
            <a href="/" class="brand-logo">
                <span class="material-symbols-outlined text-danger fs-2" style="font-variation-settings: 'FILL' 1;">lunch_dining</span>
                <span>Munch<span class="text-danger">Mate</span></span>
            </a>

            <!-- Login Form -->
            <div id="loginForm" class="form-section">
                <h2 class="form-title">Welcome Back</h2>
                <p class="text-muted mb-4">Please enter your details to sign in.</p>

                @if(Session::has('error'))
                <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4">
                    {{Session::get('error')}}
                </div>
                @endif

                <form action="{{route('login')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted ps-1">Phone Number</label>
                        <input type="number" name="phone" class="form-control" placeholder="Enter your phone" value="{{ old('phone') }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted ps-1">Password</label>
                        <input type="password" name="pass" class="form-control" placeholder="••••••••" required>
                    </div>
                    
                    <button type="submit" class="btn btn-auth">Sign In</button>
                    
                    <div class="toggle-text">
                        Don't have an account? <span class="toggle-link" onclick="toggleAuth('signup')">Sign Up</span>
                    </div>
                </form>
            </div>

            <!-- Signup Form -->
            <div id="signupForm" class="form-section d-none">
                <h2 class="form-title">Create Account</h2>
                <p class="text-muted mb-4">Join MunchMate today!</p>

                <form action="{{route('signup')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Full Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" name="phone" class="form-control" placeholder="Phone Number" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                    </div>
                    <div class="row g-2 mb-4">
                        <div class="col-6">
                            <input type="password" name="pass" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="col-6">
                            <input type="password" name="cpass" class="form-control" placeholder="Confirm" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-auth">Sign Up</button>
                    
                    <div class="toggle-text">
                        Already have an account? <span class="toggle-link" onclick="toggleAuth('login')">Sign In</span>
                    </div>
                </form>
            </div>

        </div>

        <!-- Illustration Side -->
        <div class="auth-side-img">
            <!-- Image set via CSS background -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleAuth(mode) {
            const loginForm = document.getElementById('loginForm');
            const signupForm = document.getElementById('signupForm');
            
            if(mode === 'signup') {
                loginForm.classList.add('d-none');
                signupForm.classList.remove('d-none');
            } else {
                signupForm.classList.add('d-none');
                loginForm.classList.remove('d-none');
            }
        }
    </script>
</body>
</html>