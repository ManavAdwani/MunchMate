<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MunchMate - Restaurant Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('css/restaurantDasboard.css')}}">
</head>

<body>
    @include('navbar.RestaurantNav');
    <div class="container" style="margin-top: 100px">
        <h1 style="font-size: 32px;margin-bottom:2rem;">Welcome, {{$name}}</h1>
    </div>
    <div class="container mt-5"
        style="box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;border-radius:20px">
        <div class="box">
            <div class="header" style="padding-top: 20px">
                <h5>Recent Order Received</h5>
                <button class="btn btn-warning">View All</button>
            </div>
            <div class="container">
                <hr>
            </div>
            <div class="body">
                {{-- <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Position</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt=""
                                        style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1">John Doe</p>
                                        <p class="text-muted mb-0">john.doe@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">Software engineer</p>
                                <p class="text-muted mb-0">IT department</p>
                            </td>
                            <td>
                                <span class="badge badge-success rounded-pill d-inline">Active</span>
                            </td>
                            <td>Senior</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-rounded btn-sm fw-bold"
                                    data-mdb-ripple-color="dark">
                                    Edit
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://mdbootstrap.com/img/new/avatars/6.jpg" class="rounded-circle"
                                        alt="" style="width: 45px; height: 45px" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1">Alex Ray</p>
                                        <p class="text-muted mb-0">alex.ray@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">Consultant</p>
                                <p class="text-muted mb-0">Finance</p>
                            </td>
                            <td>
                                <span class="badge badge-primary rounded-pill d-inline">Onboarding</span>
                            </td>
                            <td>Junior</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-rounded btn-sm fw-bold"
                                    data-mdb-ripple-color="dark">
                                    Edit
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://mdbootstrap.com/img/new/avatars/7.jpg" class="rounded-circle"
                                        alt="" style="width: 45px; height: 45px" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1">Kate Hunington</p>
                                        <p class="text-muted mb-0">kate.hunington@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">Designer</p>
                                <p class="text-muted mb-0">UI/UX</p>
                            </td>
                            <td>
                                <span class="badge badge-warning rounded-pill d-inline">Awaiting</span>
                            </td>
                            <td>Senior</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-rounded btn-sm fw-bold"
                                    data-mdb-ripple-color="dark">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table> --}}
                <table class="table" id="ordersTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allOrderedProducts as $orderDetails)
                            @foreach($orderDetails['orderedProducts'] as $product)
                                <tr>
                                    <td>{{ $orderDetails['order']->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>NILL</td>
                                    {{-- <td>
                                        @php
                                            $quantity = App\Models\Cart::where('user_id', $orderDetails['order']->user_id)
                                                ->where('restaurant_id', $resId)
                                                ->where('product_id', $product->id)
                                                ->value('quantity');
                                        @endphp
                                        {{ $quantity }}
                                    </td> --}}
                                    <td>{{ $product->totalPrice }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" style="background: gray; color:black;font-weight:800">Total Order Price</td>
                                <td style="background: gray; color:black;font-weight:800">{{ $orderDetails['orderTotalPrice'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
        function pollForNewOrders() {
        setInterval(function() {
            $.ajax({
                url: '/Restaurant',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    updateTable(response.newOrders);
                },
                error: function(error) {
                    console.error('Error fetching new orders:', error);
                }
            });
        }, 5000); // Poll every 5 seconds (adjust as needed)
    }

    function updateTable(newOrders) {
        var tableBody = $('#ordersTables tbody');
        tableBody.empty();

        newOrders.forEach(function(order) {
            var newRow = '<tr>' +
                '<td>' + order.id + '</td>' +
                '<td>' + order.customer_name + '</td>' +
                // Add more columns as needed
                '</tr>';
            tableBody.append(newRow);
        });
    }

    // Start polling when the page loads
    $(document).ready(function() {
        pollForNewOrders();
    });
    </script>
</body>

</html>