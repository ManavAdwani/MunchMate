<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <!-- Style -->
    <link rel="stylesheet" href="{{asset('css/yourOrders.css')}}">

    <title>Your Orders - MunchMate</title>
</head>

<body>
    @include('navbar.navbar');


    <div class="content">

        <div class="container">
            <h2 class="mb-5">Your Orders</h2>

            <div class="table-responsive">

                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th scope="col">
                                <label class="control control--checkbox">
                                    <input type="checkbox" class="js-check-all" />
                                    <div class="control__indicator"></div>
                                </label>
                            </th>
                            <th scope="col">Order</th>
                            <th scope="col">Restaurant</th>
                            <th scope="col">Dishes</th>
                            <th scope="col">Status</th>
                            <th scope="col">Total</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($getAllOrders as $orders)
                        @php
                        $orderIds = json_decode($orders->cart_id);
                        $dishNames = [];

                        foreach ($orderIds as $orderId) {
                        $getDishNames = App\Models\Cart::where('carts.id', '=', $orderId)
                        ->where('carts.restaurant_id', '=', $orders->restaurant_id)
                        ->join('restaurant_menus', 'restaurant_menus.id', '=', 'carts.product_id')
                        ->pluck('dish_name')
                        ->toArray();

                        $dishNames = array_merge($dishNames, $getDishNames);
                        }

                        $dishNamesString = implode(', ', $dishNames);
                        @endphp

                        <tr>
                            <th scope="row">
                                <label class="control control--checkbox">
                                    <input type="checkbox" />
                                    <div class="control__indicator"></div>
                                </label>
                            </th>
                            <td>{{ $orders->id }}</td>
                            <td>{{ $orders->name }}</td>
                            <td>{{ $dishNamesString }}</td>
                            @if($orders->status == "Order Recieved")
                            <td><span class="badge text-bg-success">Order Recieved</span></td>
                            @elseif ($orders->status == "Order Accepted")
                            <td><span class="badge text-bg-warning">Order Accepted</span></td>
                            @elseif ($orders->status == "Order Ready for pickup")
                            <td><span class="badge text-bg-primary">Order Ready for pickup</span></td>
                            @elseif ($orders->status == "Order Picked")
                            <td><span class="badge text-bg-primary">Order picked up</span></td>
                            {{-- Order Picked --}}
                            @endif
                            <td>₹ {{ $orders->grandTotal }}</td>
                            <td>
                                <button class="btn btn-warning">View Details</button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>


        </div>

    </div>



    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="js/main.js"></script>
    <script>
        $(function() {

$('.js-check-all').on('click', function() {

    if ( $(this).prop('checked') ) {
        $('th input[type="checkbox"]').each(function() {
            $(this).prop('checked', true);
      $(this).closest('tr').addClass('active');
        })
    } else {
        $('th input[type="checkbox"]').each(function() {
            $(this).prop('checked', false);
      $(this).closest('tr').removeClass('active');
        })
    }

});

$('th[scope="row"] input[type="checkbox"]').on('click', function() {
  if ( $(this).closest('tr').hasClass('active') ) {
    $(this).closest('tr').removeClass('active');
  } else {
    $(this).closest('tr').addClass('active');
  }
});

  

});
    </script>
</body>

</html>