<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Your Orders - MunchMate</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #ff6b6b;
            --primary-hover: #ff5252;
            --bg-gradient: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            --glass-bg: rgba(255, 255, 255, 0.95);
            --border-color: rgba(0,0,0,0.05);
            --text-dark: #2d3436;
            --text-light: #636e72;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-gradient);
            color: var(--text-dark);
            min-height: 100vh;
        }

        .page-header {
            padding: 120px 0 40px;
        }

        .order-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            border: 1px solid var(--border-color);
            margin-bottom: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
            overflow: hidden;
        }

        .order-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        }

        .order-header {
            padding: 20px 25px;
            background: rgba(0,0,0,0.01);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .order-body {
            padding: 25px;
        }

        .res-name {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .order-meta {
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending { background: #fff3cd; color: #856404; }
        .status-active { background: #cce5ff; color: #004085; }
        .status-success { background: #d4edda; color: #155724; }
        .status-info { background: #d1ecf1; color: #0c5460; }

        .dish-list {
            list-style: none;
            padding: 0;
            margin: 0;
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .dish-item {
            margin-bottom: 5px;
            display: flex;
            align-items: start;
            gap: 8px;
        }
        
        .dish-item::before {
            content: '•';
            color: var(--primary-color);
            font-weight: bold;
        }

        .price-tag {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--text-dark);
        }

        .btn-view {
            background: transparent;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .btn-view:hover, .btn-view[aria-expanded="true"] {
            background: var(--primary-color);
            color: white;
            box-shadow: 0 4px 10px rgba(255, 107, 107, 0.3);
        }

        .order-details-pane {
            background: #f8f9fa;
            border-top: 1px solid var(--border-color);
            padding: 20px 25px;
            display: none;
        }

    </style>
</head>

<body>
    @include('navbar.navbar')

    <div class="container page-header">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="fw-bold mb-4">Your Orders</h2>

                @foreach ($getAllOrders as $order)
                <div class="order-card">
                    <!-- Header -->
                    <div class="order-header">
                        <div>
                            <div class="res-name">
                                <span class="material-symbols-outlined text-muted">restaurant</span>
                                {{ $order->restaurant_name }}
                            </div>
                            <div class="order-meta mt-1">Order #{{ $order->id }} • {{ now()->subHours(rand(1, 24))->format('M d, Y, h:i A') }}</div> <!-- Mock date for visual -->
                        </div>
                        <div>
                            @if(in_array($order->status, ['Order Received', 'Order Accepted', 'Driver Assigned', 'Out for Delivery', 'Order Ready for pickup', 'Order Picked UP']))
                                <span class="status-badge status-active">{{ $order->status }}</span>
                            @elseif($order->status == 'Order delivered')
                                <span class="status-badge status-success">Delivered</span>
                            @else
                                <span class="status-badge status-pending">{{ $order->status }}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="order-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted small fw-bold mb-2">Items</h6>
                                <ul class="dish-list">
                                    @foreach(explode(',', $order->dish_names) as $dish)
                                        <li class="dish-item">{{ trim($dish) }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="text-end">
                                <div class="text-muted small mb-1">Total Amount</div>
                                <div class="price-tag">₹{{ $order->grandTotal }}</div>
                                <button class="btn btn-view mt-3 view-details-btn" type="button" data-order-id="{{ $order->id }}">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Details Pane (Hidden by default) -->
                    <div class="order-details-pane" id="details-{{ $order->id }}">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fw-bold mb-3">Order Summary</h6>
                                <ul class="list-unstyled text-muted small">
                                    <li class="mb-2 d-flex justify-content-between">
                                        <span>Item Total</span>
                                        <span>₹{{ $order->grandTotal }}</span>
                                    </li>
                                    <!-- Add Taxes/Fees logic here if available -->
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold mb-3">Delivery Status</h6>
                                
                                @if($order->status == 'Out for Delivery' && $order->driver_lat && $order->driver_long)
                                    <div class="card border-0 bg-white p-3 shadow-sm">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="rounded-circle bg-light p-2 d-flex">
                                                <span class="material-symbols-outlined text-primary">two_wheeler</span>
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $order->driver_name }}</div>
                                                <div class="small text-muted">Delivery Partner</div>
                                            </div>
                                        </div>
                                        <a href="https://www.google.com/maps/search/?api=1&query={{ $order->driver_lat }},{{ $order->driver_long }}" 
                                           target="_blank" 
                                           class="btn btn-primary btn-sm w-100 mt-3 rounded-pill">
                                           Track Live Location
                                        </a>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center gap-3 text-muted">
                                        <span class="material-symbols-outlined fs-2">local_shipping</span>
                                        <div>
                                            <div>Status: <span class="fw-600 text-dark">{{ $order->status }}</span></div>
                                            <small>Live tracking is available when out for delivery.</small>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.view-details-btn').on('click', function() {
                var orderId = $(this).data('order-id');
                var detailsPane = $('#details-' + orderId);
                var btn = $(this);
                
                // Toggle display with slide effect
                detailsPane.slideToggle(200);
                
                // Toggle active state styling if needed
                if(btn.text().trim() === 'View Details') {
                    btn.text('Hide Details');
                    btn.attr('aria-expanded', 'true');
                } else {
                    btn.text('View Details');
                    btn.attr('aria-expanded', 'false');
                }
            });
        });
    </script>
</body>
</html>