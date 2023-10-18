<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Restaurant - Zomato</title>
    <link rel="stylesheet" href="{{asset('css/addRestaurant.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    @include('navbar.RestaurantNav');
    <div class="container">
        <div class="addrestaurantPage">
            {{-- <img src="https://b.zmtcdn.com/mx-onboarding-hero87f77501659a5656cad54d98e72bf0d81627911821.webp"
                alt=""> --}}
            <h3 class="title">Partner with MunchMate
                at 0% commission for the 1st month!</h3>
            <p class="sub-titles">And get ads worth INR 1500. Valid for new restaurant partners in select cities.</p>
        </div>
        <div class="buttons">
            <a href="{{route('addRestaurant')}}"><button class="btn btn-primary">Register your restaurant</button></a>
           <a href="{{route('restaurant_login')}}"> <button class="btn2 btn btn-secondary">Login to view existing restaurants</button></a>
        </div>
        <div class="mainCard">
            <div class="card">
                <h3>Get Started with online ordering</h3>
                <p>Please keep the documents ready for a smooth signup</p>
                <div class="checkmarks">
                    <ul>
                        <li>
                            <div class="ticks"><span class="material-symbols-outlined">
                                    verified
                                </span>FSSAI license copy</div>
                        </li>
                        <li>
                            <div class="ticks"><span class="material-symbols-outlined">
                                    verified
                                </span>Pan card copy</div>
                        </li>
                        <li>
                            <div class="ticks"><span class="material-symbols-outlined">
                                    verified
                                </span>Bank account details</div>
                        </li>
                        <li>
                            <div class="ticks"><span class="material-symbols-outlined">
                                    verified
                                </span>Best images of food</div>
                        </li>
                        <li>
                            <div class="ticks"><span class="material-symbols-outlined">
                                    verified
                                </span>Restaurant Menu</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="mainwhy">
            <div class="titles">
                <h3>Why should you partner with MunchMate?</h3>
            </div>
            <center>
                <div class="subtitle">
                    <p>Zomato enables you to get 60% more revenue, 10x new customers and boost your brand visibility by
                        providing insights to improve your business.</p>
                </div>
            </center>
            <div class="sc-fjdhpX sc-fQejPQ dWsaW" style="text-align: center;">
                <div class="bke1zw-0 cMipmx">
                    <div class="bke1zw-1 gFANxn">
                        <section height="100px" width="280px" class="sc-VigVT kGzRuu">
                            <div class="bke1zw-0 cMipmx" style="height: 100%;">
                                <div class="bke1zw-1 bhVVPV" style="display: flex; align-items: center; height: 100%;">
                                    <img src="https://b.zmtcdn.com/merchant-onboarding/d2bcadb70abdd99811cceda4cc757f5a1600670711.png"
                                        height="30px" width="30px" alt="Busness Card">
                                </div>
                                <div class="bke1zw-1 cuQRfw"
                                    style="display: flex; justify-content: flex-start; padding-left: 12px;">
                                    <div style="text-align: left;">
                                        <div class="sc-iSDuPN aWfod">1000+ cities</div>
                                        <div class="sc-fZwumE dWTYpu">in India</div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="bke1zw-1 EUAVy">
                        <section height="100px" width="280px" class="sc-VigVT kGzRuu">
                            <div class="bke1zw-0 cMipmx" style="height: 100%;">
                                <div class="bke1zw-1 bhVVPV" style="display: flex; align-items: center; height: 100%;">
                                    <img src="https://b.zmtcdn.com/merchant-onboarding/77b29f40bd0fb6c74c78695b07cdee901600670728.png"
                                        height="30px" width="30px" alt="Busness Card">
                                </div>
                                <div class="bke1zw-1 cuQRfw"
                                    style="display: flex; justify-content: flex-start; padding-left: 12px;">
                                    <div style="text-align: left;">
                                        <div class="sc-iSDuPN aWfod">3 lakh+</div>
                                        <div class="sc-fZwumE dWTYpu">restaurant listings</div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="bke1zw-1 huXcFI">
                        <section height="100px" width="280px" class="sc-VigVT kGzRuu">
                            <div class="bke1zw-0 cMipmx" style="height: 100%;">
                                <div class="bke1zw-1 bhVVPV" style="display: flex; align-items: center; height: 100%;">
                                    <img src="https://b.zmtcdn.com/merchant-onboarding/e2b1283698fb6d3532c2df0c22a11fca1600670743.png"
                                        height="30px" width="30px" alt="Busness Card">
                                </div>
                                <div class="bke1zw-1 cuQRfw"
                                    style="display: flex; justify-content: flex-start; padding-left: 12px;">
                                    <div style="text-align: left;">
                                        <div class="sc-iSDuPN aWfod">5.0 crore+</div>
                                        <div class="sc-fZwumE dWTYpu">monthly orders</div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="faq" style="margin-top: 10%">
            <h2>Frequently Asked Questions</h2>
            <div class="question">
                <h5 class="qq">How are food items price calculated ?&nbsp;<span class="material-symbols-outlined">
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
    <!-- Site footer -->
    <footer class="site-footer" style="margin-top: 20%">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h6>About</h6>
                    <p class="text-justify">MunchMate.com <i>DELICIOUS FOOD, DELIVERED </i> is a platform dedicated to satisfying your cravings. We specialize in providing the most mouthwatering dishes with the utmost convenience. Our mission is to deliver deliciousness right to your doorstep. We offer a wide range of cuisines, from Italian to Mexican, and we ensure that your dining experience is nothing short of delightful.</p>

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