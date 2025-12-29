<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Delivery Dashboard - MunchMate</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        :root {
            --primary-color: #ff6b6b;
            --primary-hover: #ff5252;
            --glass-bg: rgba(255, 255, 255, 0.9);
            --glass-border: rgba(255, 255, 255, 0.5);
            --text-dark: #2d3436;
            --text-light: #636e72;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            min-height: 100vh;
            position: relative;
            color: var(--text-dark);
            padding-bottom: 50px;
            overflow-x: hidden; /* Fix horizontal scroll */
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
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(15px);
            border-bottom: 1px solid var(--glass-border);
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            padding: 15px 0;
        }

        .navbar-brand {
            color: var(--primary-color) !important;
            font-weight: 700;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-pill {
            background: rgba(255, 107, 107, 0.1);
            color: var(--primary-color);
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        /* Cards */
        .stat-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .bg-gradient-success {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .bg-gradient-info {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stat-card .card-body {
            padding: 25px;
            color: white;
        }

        .stat-card h3 {
            font-weight: 700;
            margin-bottom: 0;
            font-size: 2rem;
        }

        .stat-card .card-header {
            background: rgba(0,0,0,0.1);
            border: none;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            color: rgba(255,255,255,0.9);
        }

        /* Order Cards */
        .order-card {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .order-card .card {
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.05);
            height: 100%;
        }

        .order-card:hover .card {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            border-color: rgba(255, 107, 107, 0.3);
        }

        .restaurant-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .card-text {
            font-size: 0.95rem;
        }

        .distance-badge {
            font-weight: 500;
            border-radius: 30px;
            padding: 8px 15px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .dist-calc {
            background: #e9ecef;
            color: #6c757d;
        }
        
        .dist-success {
            background: #d4edda;
            color: #155724;
        }
        
        .dist-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .btn-accept {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.2s;
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
            white-space: nowrap;
        }

        .btn-accept:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 107, 0.4);
            color: white;
        }

        /* Location Button */
        #updateLocBtn {
            border-radius: 30px;
            padding: 8px 20px;
            font-weight: 500;
            border-width: 2px;
            white-space: nowrap;
            width: 100%; /* Mobile default */
        }

        /* Empty State */
        .empty-state {
            background: rgba(255,255,255,0.8);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        @media (min-width: 768px) {
            #updateLocBtn {
                width: auto; /* Desktop override */
            }
        }

        @media (max-width: 768px) {
            .navbar-brand { font-size: 1.1rem; }
            .user-pill { font-size: 0.8rem; padding: 4px 10px; }
            .stat-card .card-body { padding: 20px; }
            .stat-card h3 { font-size: 1.5rem; }
            .order-card .card-body { padding: 1.25rem !important; }
        }
    </style>
</head>
<body>
    
    <!-- Background Shapes -->
    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <span class="material-symbols-outlined fs-2">moped</span>
                MunchMate Delivery
            </a>
            <div class="user-pill d-flex align-items-center gap-2">
                <span class="material-symbols-outlined" style="font-size: 18px;">account_circle</span>
                <span class="d-none d-sm-inline">Hello,</span> {{ session('username') }}
            </div>
        </div>
    </nav>

    <div class="container mt-4 mt-md-5">
        
        <!-- Header Section -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4 mb-md-5">
            <div>
                <h2 class="fw-bold mb-0">Delivery Dashboard</h2>
                <p class="text-muted mb-0">Manage your orders and earnings</p>
            </div>
            
            <button onclick="getLocation()" class="btn btn-outline-primary" id="updateLocBtn">
                <span class="material-symbols-outlined align-middle me-1">my_location</span> 
                Update Location
            </button>
        </div>

        <!-- Earnings Stats -->
        <div class="row mb-4 mb-md-5 g-3 g-md-4">
            <div class="col-6">
                <div class="stat-card bg-gradient-success h-100">
                    <div class="card-header d-flex align-items-center">
                        <span class="material-symbols-outlined me-2">payments</span>
                        <span class="d-none d-md-inline">Today's Earnings</span>
                        <span class="d-md-none">Today</span>
                    </div>
                    <div class="card-body">
                        <h3>₹ {{ number_format($todayEarnings, 2) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="stat-card bg-gradient-info h-100">
                    <div class="card-header d-flex align-items-center">
                        <span class="material-symbols-outlined me-2">savings</span>
                        <span class="d-none d-md-inline">Total Earnings</span>
                        <span class="d-md-none">Total</span>
                    </div>
                    <div class="card-body">
                        <h3>₹ {{ number_format($totalEarnings, 2) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Location Status Alert -->
        <div class="alert alert-info border-0 shadow-sm rounded-3 d-flex align-items-center" id="location-status" style="display:none">
            <span class="material-symbols-outlined me-2">info</span>
            <span>Orders filtered (within 20km).</span>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-3 d-flex align-items-center">
                <span class="material-symbols-outlined me-2">check_circle</span>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm rounded-3 d-flex align-items-center">
                <span class="material-symbols-outlined me-2">error</span>
                {{ session('error') }}
            </div>
        @endif

        <h4 class="fw-bold mb-4 d-flex align-items-center">
            <span class="material-symbols-outlined me-2 text-primary">list_alt</span>
            Available Orders
        </h4>

        <div class="row g-3 g-md-4" id="orders-list">
            @forelse($availableOrders as $order)
            <div class="col-md-6 order-card" id="order-{{ $order->id }}" data-location="{{ $order->restaurant_location }}">
                <div class="card h-100">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="restaurant-name mb-0 text-truncate" style="max-width: 70%;">{{ $order->restaurant_name }}</h5>
                            <span class="badge bg-primary rounded-pill px-3 py-2">{{ $order->status }}</span>
                        </div>
                        
                        <p class="card-text text-muted mb-3 d-flex align-items-center">
                            <span class="material-symbols-outlined align-middle me-1 text-danger">location_on</span> 
                            <span class="text-truncate d-inline-block" style="max-width: 90%;">{{ $order->restaurant_location ?? 'Location not available' }}</span>
                        </p>
                        
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-end mb-3 p-3 bg-light rounded-3">
                                <div>
                                    <small class="text-muted d-block">Est. Earning</small>
                                    <h5 class="text-success fw-bold mb-0">₹{{ number_format($order->grandTotal * 0.20, 2) }}</h5>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted d-block">Order Value</small>
                                    <span class="fw-bold">₹{{ $order->grandTotal }}</span>
                                </div>
                            </div>
                            
                            <hr class="text-muted opacity-25">
                            
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3">
                                <span class="distance-badge dist-calc w-100 w-sm-auto justify-content-center">
                                    <span class="material-symbols-outlined" style="font-size: 16px;">near_me</span>
                                    <span class="dist-text">Calc Distance...</span>
                                </span>
                                <a href="{{ route('delivery_accept', $order->id) }}" class="btn btn-accept w-100 w-sm-auto">
                                    Accept Order
                                </a>
                            </div>
                            
                            <div class="mt-2 text-end">
                                <small class="text-muted" style="font-size: 11px;">
                                    Posted {{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state shadow-sm">
                    <img src="{{ asset('assets/images/delivery_3d_illustration.png') }}" alt="Empty" class="img-fluid" style="width: 150px; opacity: 0.8; margin-bottom: 20px;">
                    <h4>No Orders Available 😴</h4>
                    <p class="text-muted">Relax for a bit! New orders will appear here soon.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let userLat = null;
        let userLong = null;

        document.addEventListener("DOMContentLoaded", function() {
            updateLocation();
        });

        function updateLocation() {
            const status = document.getElementById('location-status');
            const btn = document.getElementById('updateLocBtn');
            const originalBtnText = btn.innerHTML;
            
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Locating...';

            if (navigator.geolocation) {
                status.style.display = 'flex';
                status.querySelector('span:last-child').textContent = "Updating location...";
                
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        userLat = position.coords.latitude;
                        userLong = position.coords.longitude;
                        
                        status.className = 'alert alert-success border-0 shadow-sm rounded-3 d-flex align-items-center';
                        status.querySelector('span:first-child').textContent = 'check_circle';
                        status.querySelector('span:last-child').textContent = "Location updated. Filtering orders...";
                        
                        btn.disabled = false;
                        btn.innerHTML = originalBtnText;

                        // Send to backend
                        sendLocationToBackend(userLat, userLong);

                        // Filter orders
                        processOrders();
                    },
                    (error) => {
                        status.className = 'alert alert-danger border-0 shadow-sm rounded-3 d-flex align-items-center';
                        status.querySelector('span:first-child').textContent = 'error';
                        status.querySelector('span:last-child').textContent = "Error getting location: " + error.message;
                        
                        btn.disabled = false;
                        btn.innerHTML = originalBtnText;
                    },
                    { enableHighAccuracy: true }
                );
            } else {
                status.textContent = "Geolocation is not supported by this browser.";
                btn.disabled = false;
                btn.innerHTML = originalBtnText;
            }
        }

        function sendLocationToBackend(lat, long) {
            fetch("{{ route('delivery_update_location') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ lat: lat, long: long })
            }).then(res => res.json()).then(data => console.log("Location synced", data));
        }

        async function processOrders() {
            const cards = document.querySelectorAll('.order-card');
            
            // Show filtered message after processing
            setTimeout(() => {
                 const status = document.getElementById('location-status');
                 status.querySelector('span:last-child').textContent = "Orders filtered (within 20km).";
            }, 2000);

            for (const card of cards) {
                const resLocation = card.dataset.location;
                if (!resLocation) continue;

                try {
                    const coords = await getCoordinates(resLocation);
                    const badge = card.querySelector('.distance-badge');
                    
                    if (coords) {
                        const dist = calculateDistance(userLat, userLong, coords.lat, coords.lon);
                        const distKm = dist.toFixed(1);
                        
                        badge.querySelector('.dist-text').textContent = distKm + " km away";
                        
                        if (dist > 20) {
                             badge.className = 'distance-badge dist-danger';
                             badge.querySelector('.dist-text').textContent += " (Too Far)";
                        } else {
                             badge.className = 'distance-badge dist-success';
                             badge.querySelector('.dist-text').textContent += " (Within Range)";
                        }
                    } else {
                        badge.querySelector('.dist-text').textContent = "Loc: " + resLocation;
                    }
                } catch (e) {
                    console.error(e);
                }
                
                // Rate limit
                await new Promise(r => setTimeout(r, 600)); 
            }
        }

        const coordCache = {};

        async function getCoordinates(address) {
            if (coordCache[address]) return coordCache[address];

            try {
                const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`);
                const data = await response.json();
                if (data && data.length > 0) {
                    const res = { lat: parseFloat(data[0].lat), lon: parseFloat(data[0].lon) };
                    coordCache[address] = res;
                    return res;
                }
            } catch (error) {
                console.error("Geocoding error", error);
            }
            return null;
        }

        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371; 
            const dLat = deg2rad(lat2 - lat1);
            const dLon = deg2rad(lon2 - lon1);
            const a = 
                Math.sin(dLat/2) * Math.sin(dLat/2) +
                Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
                Math.sin(dLon/2) * Math.sin(dLon/2); 
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
            const d = R * c; 
            return d;
        }

        function deg2rad(deg) {
            return deg * (Math.PI/180)
        }
    </script>
</body>
</html>
