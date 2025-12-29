<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Order - MunchMate Delivery</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        :root {
            --primary-color: #ff6b6b;
            --primary-hover: #ff5252;
            --success-color: #2ecc71;
            --active-bg: rgba(255, 107, 107, 0.1);
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(255, 255, 255, 0.5);
            --text-dark: #2d3436;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            min-height: 100vh;
            color: var(--text-dark);
            padding-bottom: 50px;
            overflow-x: hidden;
            margin: 0;
        }

        /* Abstract Background */
        .bg-shape {
            position: absolute;
            background: #ff9a9e;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.4;
            z-index: -1;
            pointer-events: none;
        }
        
        .shape-1 {
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            animation: float 10s ease-in-out infinite;
        }
        
        .shape-2 {
            bottom: -50px;
            left: -50px;
            width: 300px;
            height: 300px;
            background: #a18cd1;
            animation: float 15s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(20px, 20px); }
        }

        /* Navbar */
        .navbar {
            background: white !important;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            padding: 15px 0;
        }

        .navbar-brand {
            color: var(--text-dark) !important;
            font-weight: 700;
        }

        .fee-badge {
            background: var(--active-bg);
            color: var(--primary-color);
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
            white-space: nowrap;
        }

        /* Progress Stepper */
        .stepper {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            position: relative;
        }

        .stepper::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 4px;
            background: #e9ecef;
            z-index: 1;
            transform: translateY(-50%);
        }

        .step-item {
            position: relative;
            z-index: 2;
            background: white;
            border: 4px solid #e9ecef;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .step-item.active {
            border-color: var(--primary-color);
            background: var(--primary-color);
            color: white;
            box-shadow: 0 0 0 5px rgba(255, 107, 107, 0.2);
        }

        .step-item.completed {
            border-color: var(--success-color);
            background: var(--success-color);
            color: white;
        }

        /* Content Cards */
        .task-card {
            border: none;
            border-radius: 24px;
            background: var(--glass-bg);
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
            overflow: hidden;
            border: 1px solid var(--glass-border);
            margin-bottom: 30px;
            transition: transform 0.3s;
        }
        
        .task-card.active-task {
            border-color: var(--primary-color);
            box-shadow: 0 20px 40px rgba(255, 107, 107, 0.1);
        }

        .task-card.locked {
            opacity: 0.6;
            filter: grayscale(1);
            pointer-events: none;
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #f1f1f1;
            padding: 20px 25px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .active-task .card-header {
            color: var(--primary-color);
            background: var(--active-bg);
        }
        
        .completed-task .card-header {
            color: var(--success-color);
            background: rgba(46, 204, 113, 0.1);
        }

        .card-body {
            padding: 30px;
        }

        .action-btn {
            padding: 15px;
            border-radius: 15px;
            font-weight: 600;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s;
            border: none;
            width: 100%;
        }

        .btn-pickup {
            background: linear-gradient(135deg, #ff9a9e 0%, #ff6b6b 100%);
            color: white;
            box-shadow: 0 10px 20px rgba(255, 107, 107, 0.3);
        }

        .btn-pickup:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(255, 107, 107, 0.4);
            color: white;
        }

        .btn-deliver {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
            box-shadow: 0 10px 20px rgba(46, 204, 113, 0.3);
        }
        
        .btn-deliver:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(46, 204, 113, 0.4);
            color: white;
        }

        .map-preview {
            height: 150px; 
            background: #eee; 
            border-radius: 15px; 
            margin-bottom: 20px;
            display: flex; 
            align-items: center; 
            justify-content: center;
            color: #aaa;
            background-image: url('https://upload.wikimedia.org/wikipedia/commons/e/ec/OpenStreetMap_Logo_2011.svg'); 
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }
        
        .quick-actions a {
            flex: 1;
            padding: 12px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.2s;
            white-space: nowrap;
        }

        .btn-call { background: #e3f2fd; color: #1976d2; }
        .btn-map { background: #e8f5e9; color: #2e7d32; }

        @media (max-width: 576px) {
            .stepper { padding: 0 10px; margin-bottom: 30px; }
            .card-header { padding: 15px; font-size: 0.95rem; }
            .card-body { padding: 20px; }
            .navbar-brand { font-size: 1.1rem; }
            .fee-badge { font-size: 0.85rem; padding: 6px 12px; }
            .quick-actions { flex-direction: column; }
            .quick-actions a { width: 100%; }
        }
    </style>
</head>
<body>
    
    <!-- Background Shapes -->
    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>

    <nav class="navbar sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('delivery_dashboard') }}">
                <span class="material-symbols-outlined">arrow_back</span>
                Active Delivery
            </a>
            <span class="fee-badge">
                ₹ {{ number_format($activeOrder->delivery_fee, 2) }}
            </span>
        </div>
    </nav>

    <div class="container mt-4">
        
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-3 d-flex align-items-center mb-4">
                <span class="material-symbols-outlined me-2">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <!-- Progress Stepper -->
        <div class="stepper px-2 px-md-5">
            <div class="step-item {{ $activeOrder->status == 'Driver Assigned' || $activeOrder->status == 'Out for Delivery' ? 'completed' : '' }}">
                <span class="material-symbols-outlined">storefront</span>
            </div>
            <div class="step-item {{ $activeOrder->status == 'Out for Delivery' ? 'active' : '' }}">
                <span class="material-symbols-outlined">local_shipping</span>
            </div>
            <div class="step-item">
                <span class="material-symbols-outlined">home_pin</span>
            </div>
        </div>

        <div class="text-center mb-5">
            <h2 class="fw-bold fs-3">Order #{{ $activeOrder->id }}</h2>
            <span class="badge {{ $activeOrder->status == 'Driver Assigned' ? 'bg-primary' : 'bg-warning text-dark' }} rounded-pill px-3 py-2">
                {{ $activeOrder->status }}
            </span>
        </div>

        <!-- Picker Phase -->
        <div class="task-card {{ $activeOrder->status == 'Driver Assigned' ? 'active-task' : 'completed-task' }}">
            <div class="card-header">
                <span class="material-symbols-outlined">storefront</span>
                Step 1: Pickup
                @if($activeOrder->status == 'Out for Delivery')
                    <span class="ms-auto material-symbols-outlined">check_circle</span>
                @endif
            </div>
            <div class="card-body">
                <h4 class="fw-bold fs-5">{{ $activeOrder->restaurant_name }}</h4>
                <p class="text-muted mb-4 small">{{ $activeOrder->restaurant_location }}</p>

                <div class="quick-actions d-flex gap-3 mb-4">
                    <a href="tel:{{ $activeOrder->restaurant_phone }}" class="btn-call">
                        <span class="material-symbols-outlined">call</span> Call
                    </a>
                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($activeOrder->restaurant_location) }}" target="_blank" class="btn-map">
                        <span class="material-symbols-outlined">map</span> Navigate
                    </a>
                </div>

                @if($activeOrder->status == 'Driver Assigned')
                    <a href="{{ route('delivery_picked_up', $activeOrder->id) }}" class="action-btn btn-pickup">
                        <span class="material-symbols-outlined">package_2</span>
                        Confirm Pickup
                    </a>
                @endif
            </div>
        </div>

        <!-- Delivery Phase -->
        <div class="task-card {{ $activeOrder->status == 'Out for Delivery' ? 'active-task' : 'locked' }}">
            <div class="card-header">
                <span class="material-symbols-outlined">home_pin</span>
                Step 2: Delivery
            </div>
            <div class="card-body">
                @if($activeOrder->status == 'Out for Delivery')
                    <h4 class="fw-bold fs-5">{{ $activeOrder->customer_name }}</h4>
                    <p class="text-muted mb-4 small">
                        {{ $activeOrder->customer_address ? $activeOrder->customer_address . ', ' . $activeOrder->customer_city : 'Address details loading...' }}
                    </p>

                    <div class="quick-actions d-flex gap-3 mb-4">
                        <a href="tel:{{ $activeOrder->customer_phone }}" class="btn-call">
                            <span class="material-symbols-outlined">call</span> Call
                        </a>
                        @php
                            $custAddress = $activeOrder->customer_address . ', ' . $activeOrder->customer_city . ', ' . $activeOrder->customer_state . ', ' . $activeOrder->customer_pincode;
                        @endphp
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($custAddress) }}" target="_blank" class="btn-map">
                            <span class="material-symbols-outlined">map</span> Navigate
                        </a>
                    </div>

                    <a href="{{ route('delivery_delivered', $activeOrder->id) }}" class="action-btn btn-deliver">
                        <span class="material-symbols-outlined">verified</span>
                        Confirm Delivery
                    </a>
                @else
                    <div class="text-center py-4 text-muted">
                        <span class="material-symbols-outlined fs-1 mb-2">lock</span>
                        <p class="small">Complete pickup to unlock details</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
</body>
</html>
