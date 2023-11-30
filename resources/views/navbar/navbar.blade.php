<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<style>
    .cart-item-count {
    position: relative;
    top: -8px;
    left: 8px;
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 12px;
}

</style>

<body>
    <div class="navigation-wrap bg-light start-header start-style">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-md navbar-light">

                        <a class="navbar-brand" href="{{asset('logo/download.png')}}" target="_blank"><img
                                src="{{asset('logo/download.png')}}" alt=""></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation" id="menubtn">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto py-4 py-md-0">
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link" href="{{route('homePage')}}" role="button" aria-haspopup="true"
                                        aria-expanded="false">Home</a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link" href="#">Offers</a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link" href="#">Help</a>
                                </li>
                                @if(!session()->get('username'))
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link" href="{{route('sign_in')}}">Sign in </a>
                                </li>
                                @endif
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link" href="#">Contact us</a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link" href="{{ route('cartPage') }}">
                                        <span class="material-symbols-outlined">
                                            shopping_cart
                                        </span>
                                        <span id="cartItemCount" class="cart-item-count"></span>
                                    </a>
                                </li>
                                
                            </ul>
                        </div>

                    </nav>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script src="{{asset('js/index.js')}}"></script>
<script>
</script>
<!-- Include this script at the end of your HTML body or in your script section -->
<script>
    // Assume you have a function to get the current cart item count
    function getCartItemCount() {
        var route = {{route('countItems')}};
        // Replace this with your actual logic to fetch the count from your backend or local storage
        $.ajax({
            method: 'POST',
            url: route,
            headers: {
                'X-CSRF-TOKEN': token
            },
            data: {
                'id': {{session()->get('userId')}},
            },
            success: function (response) {
                console.log(response);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText); // Log the full error response for debugging
            }
        }); // Replace 5 with the actual count
    }
    
    // Update the cart item count on page load
    document.addEventListener('DOMContentLoaded', function () {
        updateCartItemCount();
    });
    
    // Function to update the cart item count
    // var itemCount = 2;
    function updateCartItemCount() {
        var cartItemCountElement = document.getElementById('cartItemCount');
        if (cartItemCountElement) {
            var itemCount = getCartItemCount();
            cartItemCountElement.textContent = itemCount > 9 ? '9+' : itemCount;
            cartItemCountElement.style.display = itemCount > 0 ? 'inline-block' : 'none';
        }
    }

    // You can call updateCartItemCount() whenever the cart is updated
</script>


</html>