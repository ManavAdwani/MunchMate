<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .navbar-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.05);
            padding: 15px 0;
            transition: all 0.3s;
        }

        .navbar-brand img {
            height: 40px;
            width: auto;
        }

        .nav-link {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            color: #2d3436 !important;
            font-size: 0.95rem;
            margin: 0 10px;
            transition: color 0.2s;
            position: relative;
        }

        .nav-link:hover {
            color: #ff6b6b !important;
        }

        /* Fix underline and caret issues */
        .nav-link.dropdown-toggle::after { 
            display: none !important; /* Hides default caret (red dot) */
        }
        
        /* Apply underline only to non-dropdown, non-button links */
        .nav-link:not(.dropdown-toggle):not(.btn-signin)::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: #ff6b6b;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:not(.dropdown-toggle):not(.btn-signin):hover::after {
            width: 100%;
        }

        /* Text Logo Styles */
        .brand-text {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: #2d3436;
            letter-spacing: -0.5px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-glass">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{route('homePage')}}">
                <span class="material-symbols-outlined text-danger fs-2" style="font-variation-settings: 'FILL' 1;">lunch_dining</span>
                <span class="brand-text">Munch<span class="text-danger">Mate</span></span>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="material-symbols-outlined text-dark">menu</span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('homePage')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('yourOrders')}}">Your Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    
                    @if(!session()->get('username'))
                    <li class="nav-item ms-lg-3">
                        <a class="nav-link btn-signin px-4" href="{{route('sign_in')}}">Sign In</a>
                    </li>
                    @else
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="material-symbols-outlined fs-5">account_circle</span>
                            <span class="fw-semibold">{{ session()->get('username') }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2" aria-labelledby="userDropdown" style="border-radius: 12px; margin-top: 10px;">
                            <li>
                                <a class="dropdown-item rounded-2 d-flex align-items-center gap-2 text-danger" href="{{route('logout')}}">
                                    <span class="material-symbols-outlined fs-5">logout</span>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    <li class="nav-item ms-lg-3">
                        <a class="nav-link cart-icon-wrapper" href="{{ route('cartPage') }}">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            <!-- Mock count, real logic can be injected here -->
                            {{-- <span class="cart-count">2</span> --}}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Spacer for fixed navbar -->
    <div style="height: 80px;"></div>

    <!-- Bootstrap Script is handled by parent pages to avoid conflicts -->
</body>
</html>