<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart - MunchMate</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/emptycart.css') }}">
</head>

<body>
        <div class="container-fluid  mt-100">
            <div class="card-body cart">
                <div class="col-sm-12 empty-cart-cls text-center">
                    <iframe src="https://giphy.com/embed/ISOckXUybVfQ4" width="480" height="324" frameBorder="0" class="giphy-embed" allowFullScreen style="border-radius: 20px;"></iframe>
                    <h3><strong>Your Cart is Empty</strong></h3>
                    <h4>Add something to make <b>us</b> and <b>yourself</b> happy :)</h4>
                    <a href="{{route('homePage')}}" class="btn btn-primary cart-btn-transform m-3" data-abc="true">continue
                        shopping</a>


                </div>
            </div>
        </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>
