<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Partner Registration - MunchMate</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #ff6b6b;
            --primary-hover: #ff5252;
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(255, 255, 255, 0.2);
            --text-dark: #2d3436;
            --text-light: #636e72;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow-x: hidden;
            position: relative;
            padding: 20px 0;
        }

        /* Abstract Background Shapes */
        body::before, body::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            z-index: -1;
            filter: blur(80px);
            opacity: 0.6;
        }

        body::before {
            background: #ff9a9e;
            top: -100px;
            left: -100px;
            animation: float 10s ease-in-out infinite;
        }

        body::after {
            background: #a18cd1;
            bottom: -100px;
            right: -100px;
            animation: float 15s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(30px, 30px); }
        }

        .login-container {
            width: 100%;
            max-width: 1000px;
            margin: 20px;
            background: var(--glass-bg);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--glass-border);
            overflow: hidden;
            backdrop-filter: blur(20px);
            display: flex;
            flex-wrap: wrap;
        }

        .visual-side {
            flex: 1;
            min-width: 300px;
            background: linear-gradient(135deg, #fff5f5 0%, #fff 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .visual-side img {
            max-width: 100%;
            height: auto;
            transform: scale(1);
            transition: transform 0.5s ease;
            filter: drop-shadow(0 20px 30px rgba(0,0,0,0.15));
        }

        .visual-side:hover img {
            transform: scale(1.05) translateY(-10px);
        }

        .form-side {
            flex: 1;
            min-width: 300px;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: white;
        }

        .brand-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .brand-subtitle {
            color: var(--text-light);
            margin-bottom: 30px;
            font-size: 15px;
        }

        .form-control {
            background: #f8f9fa;
            border: 2px solid transparent;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: white;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(255, 107, 107, 0.1);
        }

        .btn-custom {
            background: #28a745; 
            color: white;
            border: none;
            padding: 15px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(40, 167, 69, 0.3);
        }

        .btn-custom:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(40, 167, 69, 0.4);
            color: white;
        }

        .auth-link {
            text-align: center;
            margin-top: 25px;
            color: var(--text-light);
            font-size: 14px;
        }

        .auth-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
        }

        .auth-link a:hover {
            text-decoration: underline;
        }

        .floating-shape {
            position: absolute;
            background: linear-gradient(45deg, #ff6b6b, #ff8e53);
            border-radius: 50%;
            opacity: 0.1;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                margin: 15px;
            }
            .visual-side {
                padding: 30px;
                min-height: 200px;
            }
            .visual-side img {
                max-width: 200px;
            }
            .form-side {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Visual Sidebar -->
        <div class="visual-side">
            <div class="floating-shape" style="width: 100px; height: 100px; top: -20px; left: -20px;"></div>
            <div class="floating-shape" style="width: 150px; height: 150px; bottom: -50px; right: -50px;"></div>
            <img src="{{ asset('assets/images/delivery_3d_illustration.png') }}" alt="Delivery Scooter">
            <h4 class="mt-4 text-center fw-bold text-dark">Join the Team</h4>
            <p class="text-center text-muted small">Start your journey with MunchMate today</p>
        </div>

        <!-- Signup Form -->
        <div class="form-side">
            <h2 class="brand-title">Create Account 🚀</h2>
            <p class="brand-subtitle">Fill in your details to get started</p>

            <form action="{{ route('delivery_register') }}" method="POST">
                @csrf
                
                <div class="mb-2">
                    <input type="text" name="username" class="form-control" placeholder="Full Name" required>
                </div>

                <div class="mb-2">
                    <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                </div>

                <div class="mb-2">
                    <input type="number" name="phone" class="form-control" placeholder="Phone Number" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-2">
                        <input type="password" name="pass" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="password" name="cpass" class="form-control" placeholder="Confirm Password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-custom mt-2">
                    Register Now
                </button>

                <div class="auth-link">
                    Already have an account? <a href="{{ route('delivery_login') }}">Login Here</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
