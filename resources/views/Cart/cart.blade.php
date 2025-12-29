<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - MunchMate</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
            padding: 120px 0 30px;
        }

        .cart-container {
            padding-bottom: 50px;
        }

        .cart-item-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            border: 1px solid var(--border-color);
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .item-img {
            width: 90px;
            height: 90px;
            border-radius: 12px;
            object-fit: cover;
        }

        .item-info {
            flex-grow: 1;
        }

        .item-name {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 4px;
        }

        .item-desc {
            font-size: 0.85rem;
            color: var(--text-light);
            margin-bottom: 8px;
            max-width: 90%;
        }

        .item-price {
            font-weight: 600;
            color: var(--text-dark);
        }

        /* Quantity Control */
        .quantity-control {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
        }

        .qty-btn {
            border: none;
            background: #f8f9fa;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--primary-color);
            font-weight: bold;
            transition: background 0.2s;
        }

        .qty-btn:hover {
            background: #e9ecef;
        }

        .qty-input {
            width: 40px;
            text-align: center;
            border: none;
            font-weight: 500;
            font-size: 0.9rem;
            pointer-events: none; /* Prevent manual typing to simplify logic */
        }

        .delete-btn {
            color: #ff6b6b;
            background: rgba(255, 107, 107, 0.1);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .delete-btn:hover {
            background: #ff6b6b;
            color: white;
            box-shadow: 0 4px 10px rgba(255, 107, 107, 0.3);
        }

        /* Summary Card */
        .summary-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            padding: 25px;
            position: sticky;
            top: 100px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .summary-row.total {
            border-top: 1px dashed #ddd;
            padding-top: 15px;
            margin-top: 15px;
            color: var(--text-dark);
            font-weight: 700;
            font-size: 1.2rem;
        }

        .btn-order {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 15px;
            width: 100%;
            font-weight: 600;
            font-size: 1rem;
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
            transition: all 0.2s;
        }

        .btn-order:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
        }

    </style>
</head>

<body>
    @include('navbar.navbar')

    <div class="container page-header">
        <h2 class="fw-bold mb-4">Your Cart <span class="fs-5 text-muted fw-normal">({{ $totalCount }} items)</span></h2>

        @if (session()->get('success'))
        <div class="alert alert-success rounded-4 border-0 shadow-sm mb-4">
            {{ session()->get('success') }}
        </div>
        @elseif(session()->get('error'))
        <div class="alert alert-danger rounded-4 border-0 shadow-sm mb-4">
            {{ session()->get('error') }}
        </div>
        @endif

        <form action="{{route('orderCheckout',[session()->get('userId'),$restaurant_id])}}" method="POST">
            @csrf
            
            <div class="row g-4 cart-container">
                <!-- Cart Items -->
                <div class="col-lg-8">
                    @if(count($products) > 0)
                        @foreach ($products as $index => $product)
                            <!-- Hidden input for cart ID logic -->
                            <input type="hidden" value="{{ $product->cartId }}" id="cartId_{{ $index }}">
                            
                            <div class="cart-item-card">
                                <div class="d-flex align-items-center gap-3 flex-grow-1">
                                    <img src="{{ asset('dishes/' . $product->dish_pic) }}" alt="{{ $product->dish_name }}" class="item-img">
                                    <div class="item-info">
                                        <h5 class="item-name">{{ $product->dish_name }}</h5>
                                        <p class="item-desc text-truncate">{{ $product->dish_desc }}</p>
                                        <div class="quantity-control d-inline-flex">
                                            <button type="button" class="qty-btn minus">-</button>
                                            <input type="number" class="qty-input" value="{{ $product->qty }}" readonly 
                                                data-index="{{$index}}" data-cart-id="{{ $product->cartId }}">
                                            <button type="button" class="qty-btn plus">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end ps-3">
                                    <div class="item-price mb-3">₹{{ $product->price * $product->qty }}</div>
                                    <a href="{{ route('deleteItem', $product->cartId) }}" class="delete-btn ms-auto" title="Remove Item">
                                        <span class="material-symbols-outlined">delete</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Backend required hidden input array -->
                            <input type="hidden" value="{{ $product->cartId }}" name="cartIds[]">
                        @endforeach
                    @else
                        <div class="text-center py-5">
                            <h4 class="text-muted">Your cart is empty</h4>
                            <a href="/" class="btn btn-outline-primary mt-3 rounded-pill">Explore Restaurants</a>
                        </div>
                    @endif
                </div>

                <!-- Summary (Right Side) -->
                @if(count($products) > 0)
                <div class="col-lg-4">
                    <div class="summary-card">
                        <h5 class="fw-bold mb-4">Bill Details</h5>
                        <div class="summary-row">
                            <span>Item Total</span>
                            <span>₹{{ $totalPrice }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Delivery Fee</span>
                            <span>₹45</span>
                        </div>
                        <div class="summary-row">
                            <span>Taxes & Charges</span>
                            <span>₹0</span>
                        </div>
                        <div class="summary-row total">
                            <span>To Pay</span>
                            <span>₹{{ $grandTotal }}</span>
                        </div>

                        <button class="btn-order">Proceed to Checkout</button>
                        
                        <div class="mt-3 text-center">
                            <small class="text-muted d-flex align-items-center justify-content-center gap-1">
                                <span class="material-symbols-outlined fs-6">lock</span>
                                Secure Checkout
                            </small>
                        </div>
                    </div>
                </div>
                @endif
            </div>

        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        let token = document.head.querySelector('meta[name="csrf-token"]').content;

        $(document).ready(function() {
            // Plus Button
            $('.plus').click(function() {
                let input = $(this).siblings('.qty-input');
                let currentVal = parseInt(input.val());
                let cartId = input.data('cart-id');
                
                let newVal = currentVal + 1;
                // Update UI immediately for responsiveness (optional, but logic reloads page anyway)
                input.val(newVal); 
                
                updateQuantity(newVal, cartId);
            });

            // Minus Button
            $('.minus').click(function() {
                let input = $(this).siblings('.qty-input');
                let currentVal = parseInt(input.val());
                let cartId = input.data('cart-id');
                
                if(currentVal > 1) {
                    let newVal = currentVal - 1;
                    input.val(newVal);
                    updateQuantity(newVal, cartId);
                }
            });

            function updateQuantity(newQty, cartId) {
                if (cartId && newQty) {
                    $.ajax({
                        method: 'POST',
                        url: '/update-quantity',
                        headers: { 'X-CSRF-TOKEN': token },
                        data: {
                            'id': cartId,
                            'qty': newQty,
                        },
                        success: function(response) {
                            console.log('Updated');
                            location.reload(); // Reload to recalculate totals
                        },
                        error: function(xhr) {
                            console.error('Error updating quantity');
                        }
                    });
                }
            }
        });
    </script>
</body>
</html>