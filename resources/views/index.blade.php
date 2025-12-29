<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MunchMate - Delicious Food Delivered</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

        a { text-decoration: none; }

        /* Hero Section */
        .hero-section {
            padding: 120px 0 80px;
            position: relative;
            overflow: hidden;
        }

        .hero-title {
            font-weight: 800;
            font-size: 3.5rem;
            line-height: 1.2;
            background: linear-gradient(45deg, #ff6b6b, #ff9f43);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: var(--text-light);
            margin-bottom: 30px;
        }

        .hero-image-container {
            position: relative;
            z-index: 2;
        }

        .bg-shape {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255,107,107,0.1) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            z-index: -1;
            filter: blur(50px);
        }

        /* Category Pills */
        .category-scroll {
            display: flex;
            gap: 15px;
            overflow-x: auto;
            padding: 10px 5px;
            scrollbar-width: none;
        }
        
        .category-scroll::-webkit-scrollbar { display: none; }

        .category-pill {
            background: white;
            padding: 10px 25px;
            border-radius: 50px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid transparent;
        }

        .category-pill:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255,107,107,0.2);
            border-color: var(--primary-color);
        }

        .category-pill img {
            width: 25px;
            height: 25px;
            object-fit: cover;
        }

        /* Restaurant Cards */
        .restaurant-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            position: relative;
        }

        .restaurant-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 20px;
        }

        .rating-badge {
            background: #2ecc71;
            color: white;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 4px;
            position: absolute;
            top: 15px;
            right: 15px;
            font-weight: 600;
        }

        /* Features Section */
        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            height: 100%;
            transition: transform 0.3s;
            box-shadow: 0 5px 20px rgba(0,0,0,0.03);
        }

        .feature-card:hover { transform: translateY(-5px); }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
            object-fit: cover;
            border-radius: 50%;
        }

        /* Footer */
        .site-footer {
            background: linear-gradient(135deg, #2d3436 0%, #000000 100%);
            color: white;
            padding: 60px 0 20px;
            margin-top: 80px;
            border-top-left-radius: 50px;
            border-top-right-radius: 50px;
        }

        .footer-links a { color: #b2bec3; transition: color 0.2s; }
        .footer-links a:hover { color: var(--primary-color); }
        
        .social-icons a {
            color: white;
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            transition: all 0.3s;
        }
        
        .social-icons a:hover {
            background: var(--primary-color);
            transform: scale(1.1);
        }

        /* FAQ */
        .accordion-button:not(.collapsed) {
            color: var(--primary-color);
            background-color: rgba(255, 107, 107, 0.1);
            box-shadow: none;
        }
        .accordion-button:focus { box-shadow: none; border-color: rgba(255,107,107,0.5); }

        @media (max-width: 991px) {
            .reverse-column-mobile { flex-direction: column-reverse; }
            .hero-title { font-size: 2rem !important; }
        }
    </style>
</head>

<body>
    @include('navbar.navbar')

    <!-- Hero Section -->
    <section class="hero-section pt-5 pb-5 mt-5">
        <div class="bg-shape" style="top: -100px; right: -100px;"></div>
        <div class="container">
            <div class="row align-items-center reverse-column-mobile">
                <div class="col-lg-7 mt-5 pt-lg-5">
                    <h1 class="hero-title mb-2" style="font-size: 2.5rem;">Hungry? Search. Order. Eat.</h1>
                    <p class="hero-subtitle mb-4 fs-6">Order from the best restaurants in town and get it delivered to your doorstep in minutes.</p>
                    
                    <div class="card border-0 shadow-lg" style="border-radius: 15px; overflow: hidden; background: rgba(255,255,255,0.95);">
                        <div class="card-body p-2">
                            <form action="#" class="d-flex align-items-center gap-2">
                                <span class="material-symbols-outlined text-muted ms-2">search</span>
                                <input type="text" class="form-control border-0 shadow-none" placeholder="Search for restaurant, cuisine or a dish..." style="background: transparent;">
                                <button class="btn btn-primary rounded-pill px-4 fw-600" style="background: var(--primary-color); border:none;">Search</button>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-lg-5 text-center mb-4 mb-lg-0">
                    <div class="hero-img-wrapper position-relative" style="z-index: 1;">
                        <img src="{{ asset('hero_burger.png') }}" alt="Food Delivery" class="img-fluid floating-anim" style="max-height: 450px; filter: drop-shadow(0 20px 40px rgba(0,0,0,0.15));">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <div class="container mb-5">
        <h4 class="fw-bold mb-4">What's on your mind?</h4>
        <div class="category-scroll pb-3">
            @php
                $categories = [
                    ['name' => 'Pizza', 'img' => 'logo/Pizza.webp'],
                    ['name' => 'Burger', 'img' => 'logo/Burger.webp'],
                    ['name' => 'Chinese', 'img' => 'logo/Chinese.webp'],
                    ['name' => 'South Indian', 'img' => 'logo/South_Indian_4.webp'],
                    ['name' => 'Desserts', 'img' => 'logo/Ice_Creams.webp'],
                    ['name' => 'Biryani', 'img' => 'logo/briyani.webp'],
                    ['name' => 'Momos', 'img' => 'logo/Momos.webp'],
                    ['name' => 'Cakes', 'img' => 'logo/Cakes.webp'],
                ];
            @endphp
            
            @foreach($categories as $cat)
                <div class="category-pill">
                    <img src="{{asset($cat['img'])}}" alt="{{$cat['name']}}" class="rounded-circle">
                    <span class="fw-500">{{$cat['name']}}</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Top Restaurants -->
    <div class="container mb-5" id="restaurants">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h3 class="fw-bold mb-1">Top Chains in Ahmedabad</h3>
                <p class="text-muted mb-0">Explore curated lists of top restaurants</p>
            </div>
            <a href="#" class="btn btn-outline-danger rounded-pill px-4 btn-sm d-flex align-items-center gap-2 fw-500">
                View All <span class="material-symbols-outlined fs-6">arrow_forward</span>
            </a>
        </div>

        <div class="row g-4">
            @foreach($restaurants as $restaurant)
                <div class="col-md-6 col-lg-3">
                    <div class="restaurant-card">
                        <div class="position-relative">
                            <img src="{{asset('storage/pfp/'.$restaurant->restaurant_pfp)}}" class="card-img-top" alt="{{$restaurant->name}}">
                            <div class="rating-badge">
                                @php $rating = number_format(mt_rand(35, 50) / 10, 1); @endphp
                                {{$rating}} <span class="material-symbols-outlined fs-6">star</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold mb-1 text-truncate">{{$restaurant->name}}</h5>
                            <p class="text-muted small mb-2 text-truncate">Pizza, Fast Food, Beverages</p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-dark fw-500 fs-sm">₹400 for two</span>
                                <span class="text-muted small">25 min</span>
                            </div>
                            <a href="{{route('showMenu',$restaurant->id)}}" class="btn btn-outline-danger w-100 rounded-pill">View Menu</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Best Restaurants Near You -->
    <div class="container mb-5">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h3 class="fw-bold mb-1">Best Restaurants Near You</h3>
                <p class="text-muted mb-0">Discover top-rated spots around your location</p>
            </div>
            <a href="#" class="text-primary fw-600">View All</a>
        </div>

        <div class="row g-4">
            @foreach($allRes as $res)
                <div class="col-md-6 col-lg-3">
                    <div class="restaurant-card">
                        <div class="position-relative">
                            <img src="{{asset('storage/pfp/'.$res->restaurant_pfp)}}" class="card-img-top" alt="{{$res->name}}">
                            <div class="rating-badge">
                                @php $rating = number_format(mt_rand(35, 50) / 10, 1); @endphp
                                {{$rating}} <span class="material-symbols-outlined fs-6">star</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold mb-1 text-truncate">{{$res->name}}</h5>
                            <p class="text-muted small mb-2 text-truncate">Pizza, Fast Food, Beverages</p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-dark fw-500 fs-sm">₹350 for two</span>
                                <span class="text-muted small">30 min</span>
                            </div>
                            <a href="{{route('showMenu',$res->id)}}" class="btn btn-outline-danger w-100 rounded-pill">View Menu</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Features -->
    <div class="container mb-5" id="features">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon mb-3 d-flex align-items-center justify-content-center mx-auto" style="background: rgba(255, 107, 107, 0.1); width: 80px; height: 80px; border-radius: 50%; color: var(--primary-color);">
                        <span class="material-symbols-outlined fs-1">moped</span>
                    </div>
                    <h5>Super Fast Delivery</h5>
                    <p class="text-muted small">Lightning fast delivery to satisfy your cravings in no time.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon mb-3 d-flex align-items-center justify-content-center mx-auto" style="background: rgba(79, 172, 254, 0.1); width: 80px; height: 80px; border-radius: 50%; color: #4facfe;">
                        <span class="material-symbols-outlined fs-1">location_on</span>
                    </div>
                    <h5>Live Order Tracking</h5>
                    <p class="text-muted small">Know exactly where your food is at every step of the way.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon mb-3 d-flex align-items-center justify-content-center mx-auto" style="background: rgba(46, 204, 113, 0.1); width: 80px; height: 80px; border-radius: 50%; color: #2ecc71;">
                        <span class="material-symbols-outlined fs-1">verified_user</span>
                    </div>
                    <h5>Hygienic & Safe</h5>
                    <p class="text-muted small">Our partners follow strict safety protocols for your health.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="container mb-5">
        <h3 class="fw-bold mb-4 text-center">Frequently Asked Questions</h3>
        <div class="accordion accordion-flush" id="faqAccordion">
            <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-600" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                        How is food item price calculated?
                    </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted">
                        Food prices are set directly by the restaurants. We may add a small delivery fee and taxes as applicable by law.
                    </div>
                </div>
            </div>
            
            <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-600" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                        How much time will it take to deliver?
                    </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted">
                        Delivery time depends on your distance from the restaurant and current traffic conditions. Standard time is 30-45 minutes.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-5">
                    <h4 class="fw-bold mb-3"><span class="text-warning">Munch</span>Mate.</h4>
                    <p class="text-white-50 small pe-lg-5">
                        The ultimate destination for food lovers. We bring the best cuisines from top-rated restaurants directly to your doorstep with speed and care.
                    </p>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold mb-3 text-white">Quick Links</h6>
                    <ul class="list-unstyled footer-links d-flex flex-column gap-2">
                        <li><a href="{{route('homePage')}}">Home</a></li>
                        <li><a href="#">Offers</a></li>
                        <li><a href="#">Partner with us</a></li>
                        <li><a href="#">Ride with us</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold mb-3 text-white">Connect with us</h6>
                    <div class="social-icons d-flex gap-2">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                    </div>
                    <p class="mt-4 small text-white-50">© 2025 MunchMate. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple animation for elements entering viewport
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('show');
                    }
                });
            });
            // Add fade-in class to elements if needed
        });
    </script>
</body>
</html>