<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Restaurant - Zomato</title>
    <link rel="stylesheet" href="{{asset('css/addRestaurant.css')}}">
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
            <button class="btn btn-primary">Register your restaurant</button>
            <button class="btn2 btn btn-secondary">Login to view existing restaurants</button>
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
            <div class="titles"><h3>Why should you partner with MunchMate?</h3></div>
            <center>
            <div class="subtitle">
                <p>Zomato enables you to get 60% more revenue, 10x new customers and boost your brand visibility by providing insights to improve your business.</p>
            </div>
        </center>
        <div class="cardss">
        <div class="c1">
            <span class="material-symbols-outlined">
                public
            </span>
        </div>
        <div class="c1"></div>
        <div class="c1"></div>
    </div>
        </div>
    </div>
</body>

</html>