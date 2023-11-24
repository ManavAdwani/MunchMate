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
    <div class="container">
        @if(session()->get('status'))
        <div class="alert alert-success" role="alert">
            {{session()->get('status')}}
        </div>
        @endif
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
                            <th>User Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            {{-- <th>Quantity</th> --}}
                            <th>Total Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allOrderedProducts as $orderDetails)
                        <tr class="order-row">
                            <td>{{ $orderDetails['order']->id }}</td>
                            <td>{{ $orderDetails['userName'] }}</td>
                            <td>{{ $orderDetails['orderedProducts'][0]->description }}</td>
                            <td>{{ $orderDetails['orderedProducts'][0]->price }}</td>
                            {{-- <td>{{ $orderDetails['orderedProducts'][0]->quantity }}</td> --}}
                            <td>{{ $orderDetails['orderedProducts'][0]->totalPrice }}</td>
                            
                            <td>
                                <button class="btn btn-info view-details"
                                    data-order-id="{{ $orderDetails['order']->id }}">
                                    View Details
                                </button>
                                {{-- 1 - Order Received
                                    2 - Order Accepted
                                    3 - Order Ready for deliver
                                    4 - Order picked up
                                    5 - Order delivered
                                    0 - Order Rejected--}}
                                    @php
                                        $getStatus = App\Models\Order::where('id',$orderDetails['order']->id)->select('status')->first();
                                        $status = $getStatus->status ?? 0;
                                    @endphp
                                    @if($status == "Order Recieved")
                                <a class="btn btn-danger view-details" href="{{route('changeOrderStatus',[$orderDetails['order']->id,2])}}">
                                Accept Order
                                </a>
                                @elseif($status == "Order Accepted")
                                <a class="btn btn-danger view-details" href="{{route('changeOrderStatus',[$orderDetails['order']->id,3])}}">
                                    Order Ready for Pickup
                                    </a>
                                @elseif($status == "Order Ready for pickup")
                                <a class="btn btn-danger view-details" href="{{route('changeOrderStatus',[$orderDetails['order']->id,4])}}">
                                    Order picked up
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr class="order-details" id="details-{{ $orderDetails['order']->id }}" style="display: none;">
                            <td colspan="7">
                                <!-- Details of the order -->
                                <!-- You can customize this part based on your needs -->
                                <div class="alert alert-primary" role="alert">
                                    Order Details for Order ID {{ $orderDetails['order']->id }}
                                  </div>
                                <table class="table  table-bordered">
                                    <tr>
                                        <th>Dish Name</th>
                                        <th>Quantity</th>
                                    </tr>
                                    @foreach($orderDetails['orderedProducts'] as $product)
                                    <tbody>
                                        <tr>
                                            <td>{{ $product->dish_name }}</td>
                                            <td>{{ $orderDetails['quantities'][$product->id] }} items</td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </td>
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
        $(document).ready(function() {
            $('.view-details').on('click', function() {
                var orderId = $(this).data('order-id');
                $('#details-' + orderId).toggle();
            });
        });
    </script>
</body>

</html>