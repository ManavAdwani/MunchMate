<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MunchMate - Homepage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    @include('navbar.navbar')
    <div class="mt-5"></div>
    <div class="container">
        <h4>Best offers for you</h4>
        <div class="mainOffers">
            <div class="offer1">
                <img src="{{asset('logo/offer.png')}}" alt="">
            </div>
            <div class="offer2">
                <img src="{{asset('logo/offer2.png')}}" alt="">
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="inyourmind">
            <h4>What's in your mind ?</h4>
            <p><a href="">View All !</a></p>
        </div>
        <div class="mainMind">
            <img src="{{asset('logo/Pizza.webp')}}" alt="">
            <img src="{{asset('logo/Burger.webp')}}" alt="">
            <img src="{{asset('logo/North_Indian_4.webp')}}" alt="">
            <img src="{{asset('logo/Chinese.webp')}}" alt="">
            <img src="{{asset('logo/Pav_Bhaji.webp')}}" alt="">
            <img src="{{asset('logo/South_Indian_4.webp')}}" alt="">
            <img src="{{asset('logo/Ice_Creams.webp')}}" alt="">
            <img src="{{asset('logo/Cakes.webp')}}" alt="">
            <img src="{{asset('logo/Momos.webp')}}" alt="">
            <img src="{{asset('logo/briyani.webp')}}" alt="">
            <img src="{{asset('logo/noodles.webp')}}" alt="noodles">
        </div>
    </div>
    <div class="hr mt-5">
        <hr style="width: 80%;">
    </div>
    <div class="container mt-5">
        <div class="topchains-title">
            <h4>Top restaurant chains in Ahmedabad </h4>
            <p><a href="">View All </a></p>
        </div>
        <div class="chains mt-4 mb-5">
            @foreach($restaurants as $restaurant)
            <div class="first">
                <div class="image">
                    <img src="{{asset('storage/pfp/1700034758_Subway.png')}}" alt="">
                </div>
                <div class="title mt-2">
                    <h5 class="title">{{$restaurant->name}}</h5>
                    <div class="stars">4.3&nbsp;<span class="material-symbols-outlined">star</span></div>
                </div>
                <div class="parent-container">
                    <div class="description">
                        Pizza, Pasta, Italian, Fastfood
                    </div>
                    <div class="priceforone">
                        ₹400 for one
                    </div>
                </div>
                <div class="time">
                    20 min
                </div>
                <div class="ordernow mt-5" style="width: 100%">
                    <a href="{{route('showMenu',$restaurant->id)}}" style="width:100%"> <button class="btn btn-warning">Order Now</button></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="container mt-4">
        <div class="bestrestaurant">
            <div class="bestrestaurant-title">
                <h4>Best restaurant near you </h4>
                <p><a href="">View All </a></p>
            </div>
            <div class="mainbestrestaurant">
                @foreach ($allRes as $res)
                <div class="first">
                    <div class="image">
                        <img src="{{asset('storage/pfp/1700034758_Subway.png')}}" alt="">
                    </div>
                    <div class="title mt-2">
                        <h5 class="title">{{$res->name}}</h5>
                        <div class="stars">4.3&nbsp;<span class="material-symbols-outlined">star</span></div>
                    </div>
                    <div class="parent-container">
                        <div class="description">
                            Pizza, Pasta, Italian, Fastfood
                        </div>
                        <div class="priceforone">
                            ₹400 for one
                        </div>
                    </div>
                    <div class="time">
                        <div class="location">Ahmedabad</div>
                        20 min
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="hr mt-5">
        <hr style="width: 80%;">
    </div>
    <div class="container">
        <div class="mt-5"></div>
    </div>
    <div class="containesr">
        <div class="triomain" style="margin-top: 50px">
            <div class="trio-title">
                <center>
                    <h3>Food delivery you can count on</h3>
                </center>
            </div>
            <br>
            <div class="container">
                <div class="containers">
                    <div class="cards">
                        <div class="card-item">
                            <div class="card-image">
                                <img src="https://www.bloggingherway.com/wp-content/uploads/2022/02/haute-stock-photography-mompreneur-final-10-scaled-e1618025674267-1024x683.jpeg.webp"
                                    alt="">
                            </div>
                            <div class="card-info">
                                <h2 class="card-title">Choose what you want</h2>
                                <p class="card-intro">You have the convenience to choose food items from your preferred
                                    store at any location and time that suits you.</p>
                            </div>
                        </div>
                    </div>
                    <div class="cards">
                        <div class="card-item">
                            <div class="card-image">
                                <img src="https://hips.hearstapps.com/hmg-prod/images/how-to-check-screen-time-1669837476.jpg"
                                    alt="">
                            </div>
                            <div class="card-info">
                                <h2 class="card-title">See real time updates</h2>
                                <p class="card-intro">Our personal shoppers meticulously select items, prioritizing
                                    quality and your preferences. You can communicate with them in real-time.</p>
                            </div>
                        </div>
                    </div>
                    <div class="cards">
                        <div class="card-item">
                            <div class="card-image">
                                <img src="https://img.freepik.com/premium-vector/online-food-delivery-service-your-home-courier-received-order-delivery-food-online-payment-was-successful-phone-pay-terminal-check-scooter-mapaddressvector-illustration_608021-1327.jpg?w=2000"
                                    alt="">
                            </div>
                            <div class="card-info">
                                <h2 class="card-title">Get your food delivered</h2>
                                <p class="card-intro">With a commitment to excellence, we strive to provide you with a
                                    seamless and convenient experience</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="mt-5"></div>
            <div class="container">
                <div class="faq" style="margin-top: 20%">
                    <h2>Frequently Asked Questions</h2>
                    <div class="mt-5"></div>
                    <div class="question">
                        <h5 class="qq">How are food items price calculated ?&nbsp;<span
                                class="material-symbols-outlined">
                                add
                            </span></h5>
                        <div class="answer">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque culpa quidem
                            vel
                            minima! Non, unde doloremque quod ipsa consectetur rem ullam debitis aliquid blanditiis
                            facere
                            pariatur eveniet repellendus a enim?</div>
                    </div>
                    <div class="question">
                        <h5 class="qq">What will be the quality of food? &nbsp;<span class="material-symbols-outlined">
                                add
                            </span></h5>
                        <div class="answer">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque culpa quidem
                            vel
                            minima! Non, unde doloremque quod ipsa consectetur rem ullam debitis aliquid blanditiis
                            facere
                            pariatur eveniet repellendus a enim?</div>
                    </div>
                    <div class="question">
                        <h5 class="qq">How much time it will take to deliver food ?&nbsp;<span
                                class="material-symbols-outlined">
                                add
                            </span></h5>
                        <div class="answer">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque culpa quidem
                            vel
                            minima! Non, unde doloremque quod ipsa consectetur rem ullam debitis aliquid blanditiis
                            facere
                            pariatur eveniet repellendus a enim?</div>
                    </div>
                    <div class="question">
                        <h5 class="qq">Food item will be fresh ?&nbsp;<span class="material-symbols-outlined">
                                add
                            </span></h5>
                        <div class="answer">Loresm ipsum dolor sit amet consectetur, adipisicing elit. Atque culpa
                            quidem
                            vel
                            minima! Non, unde doloremque quod ipsa consectetur rem ullam debitis aliquid blanditiis
                            facere
                            pariatur eveniet repellendus a enim?</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br>
    <!-- Site footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h6>About</h6>
                    <p class="text-justify">MunchMate.com <i>DELICIOUS FOOD, DELIVERED </i> is a platform dedicated to
                        satisfying your cravings. We specialize in providing the most mouthwatering dishes with the
                        utmost convenience. Our mission is to deliver deliciousness right to your doorstep. We offer a
                        wide range of cuisines, from Italian to Mexican, and we ensure that your dining experience is
                        nothing short of delightful.</p>

                </div>

                <div class="col-xs-6 col-md-3">
                    <h6>FOR RESTAURANTS</h6>
                    <ul class="footer-links">
                        <li><a href="#">Partner with us</a></li>
                        <li><a href="">App for you</a></li>
                    </ul>
                </div>

                <div class="col-xs-6 col-md-3">
                    <h6>Quick Links</h6>
                    <ul class="footer-links">
                        <li><a href="http://scanfcode.com/about/">Home</a></li>
                        <li><a href="http://scanfcode.com/contact/">Offers</a></li>
                        <li><a href="http://scanfcode.com/contribute-at-scanfcode/">Help</a></li>
                        <li><a href="http://scanfcode.com/privacy-policy/">Sign in</a></li>
                        <li><a href="http://scanfcode.com/sitemap/">Contact us</a></li>
                    </ul>
                </div>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <p class="copyright-text">Copyright &copy; 2023 All Rights Reserved by
                        <a href="#">MunchMate</a>.
                    </p>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <ul class="social-icons">
                        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script>
        const questions = document.querySelectorAll('.qq');
    
        questions.forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                answer.classList.toggle('show');
            });
        });
    </script>
</body>

</html>