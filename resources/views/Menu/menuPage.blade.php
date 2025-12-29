<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$resName}} - Menu | MunchMate</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #ff6b6b;
            --primary-hover: #ff5252;
            --bg-gradient: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            --glass-bg: rgba(255, 255, 255, 0.9);
            --glass-border: rgba(255, 255, 255, 0.5);
            --text-dark: #2d3436;
            --text-light: #636e72;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-gradient);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* Restaurant Header */
        .res-header {
            background: white;
            padding: 120px 0 30px;
            border-bottom: 1px solid var(--glass-border);
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            margin-bottom: 30px;
        }

        .res-title {
            font-weight: 700;
            font-size: 2.5rem;
            color: var(--text-dark);
        }

        .res-meta {
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .rating-box {
            background: #27ae60;
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(39, 174, 96, 0.3);
        }

        /* Deals Section */
        .deal-card {
            background: linear-gradient(135deg, #fff5f5 0%, #fff 100%);
            border: 1px solid #ffe3e3;
            border-radius: 12px;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: transform 0.2s;
            height: 100%;
        }

        .deal-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.15);
        }

        .deal-icon {
            background: rgba(255, 107, 107, 0.1);
            color: var(--primary-color);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Menu Items */
        .menu-item-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            padding: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
            border: 1px solid rgba(0,0,0,0.02);
            position: relative;
        }

        .menu-item-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        }

        .item-name {
            font-weight: 600;
            font-size: 1.15rem;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .item-price {
            color: var(--text-dark);
            font-weight: 500;
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .item-desc {
            color: #888;
            font-size: 0.9rem;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Image Container */
        .item-img-container {
            position: relative;
            width: 140px;
            height: 130px;
            flex-shrink: 0;
            margin-left: 20px;
        }

        .item-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .btn-add {
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            color: #1aac56; /* Zomato/Swiggy green */
            border: 1px solid #dcdcdc;
            font-weight: 700;
            padding: 6px 20px;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            transition: all 0.2s;
            text-transform: uppercase;
            font-size: 0.85rem;
            white-space: nowrap;
            width: 80%;
            text-align: center;
            z-index: 2;
        }

        .btn-add:hover {
            background: #f8f8f8;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            color: #158f46;
        }
        
        .section-title {
            font-weight: 800;
            font-size: 1.6rem;
            margin-bottom: 25px;
            color: var(--text-dark);
        }

    </style>
</head>

<body>
    @include('navbar.navbar')

    <!-- Restaurant Header -->
    <div class="res-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h1 class="res-title mb-2">{{$resName}}</h1>
                    <p class="res-meta mb-1">Pizzas, Fast Food, Beverages</p>
                    <p class="res-meta text-muted small"><span class="material-symbols-outlined fs-6 align-middle">location_on</span> Kudasan, Gandhinagar</p>
                    
                    <div class="d-flex gap-4 mt-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="material-symbols-outlined text-muted">schedule</span>
                            <span class="fw-500 small">30-40 min</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="material-symbols-outlined text-muted">currency_rupee</span>
                            <span class="fw-500 small">₹350 for two</span>
                        </div>
                    </div>
                </div>
                
                <div class="text-end">
                    <div class="rating-box mb-2">
                        <span class="material-symbols-outlined fs-6">star</span>
                        <span>4.2</span>
                    </div>
                    <p class="text-muted small mb-0">5k+ ratings</p>
                </div>
            </div>
            
            <hr class="my-4" style="opacity: 0.1;">
            
            <!-- Deals -->
            <div class="row g-3">
                <div class="col-md-4 col-lg-3">
                    <div class="deal-card">
                        <div class="deal-icon">
                            <span class="material-symbols-outlined">percent</span>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">50% OFF</h6>
                            <small class="text-muted">Up to ₹100</small>
                        </div>
                    </div>
                </div>
                <!-- ... other deals ... -->
            </div>
        </div>
    </div>

    <!-- Menu Section -->
    <div class="container pb-5">
        <h3 class="section-title">Recommended</h3>
        
        <div class="row g-4">
            @foreach($menu as $food)
                <div class="col-lg-6">
                    <div class="menu-item-card d-flex justify-content-between h-100">
                        <div class="pe-3 d-flex flex-column justify-content-between flex-grow-1">
                            <div>
                                <div class="mb-2">
                                     <!-- Veg/Non-veg icon -->
                                     <img src="https://img.icons8.com/color/48/000000/vegetarian-food-symbol.png" width="18" alt="veg">
                                </div>
                                <h4 class="item-name">{{$food->dish_name}}</h4>
                                <p class="item-price">₹{{$food->price}}</p>
                                <p class="item-desc text-truncate-2">{{$food->description}}</p>
                            </div>
                        </div>
                        
                        <div class="item-img-container">
                            <img src="{{asset('dishes/'.$food->dish_pic)}}" alt="{{$food->dish_name}}" class="item-img">
                            <a href="{{route('addProduct',$food->menu_id)}}" class="btn-add">ADD</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>