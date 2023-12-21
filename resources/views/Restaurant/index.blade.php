<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MunchMate - Restaurant Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="{{asset('css/restaurantDasboard.css')}}">
</head>

<body>
    @include('navbar.RestaurantNav');
    <div class="container" style="margin-top: 100px">
        <h1 style="font-size: 32px;margin-bottom:2rem;">Welcome, {{$name}}</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 mt-3">
                <div class="text-white card bg-gradient-info" id="cards">
                    <div class="card-body earned">
                        <div style="float: left; height:50;">
                            <span class="material-symbols-outlined" style="font-size: 50px; margin-top:2px;">
                                paid
                            </span>
                            <!-- <i class="fa fa-user fa-5x" aria-hidden="true"></i> -->
                        </div>
                        <div class="text-value-lg" style="font-size: 20px;">
                            ₹ {{$earningThisMonth ?? 0}}
                        </div>
                        <h5>Earned this month</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mt-3">
                <div class="text-white card bg-gradient-info" id="cards">
                    <div class="card-body totalOrders">
                        <div style="float: left; height:50;">
                            <span class="material-symbols-outlined" style="font-size: 50px; margin-top:2px;">
                                list_alt
                            </span>
                            <!-- <i class="fa fa-user fa-5x" aria-hidden="true"></i> -->
                        </div>
                        <div class="text-value-lg" style="font-size: 20px;">
                            {{$totalOrders ?? 0}}
                        </div>
                        <h5>Total Orders</h5>
                    </div>
                </div>
            </div>
        </div>
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
                <table class="table" id="ordersTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>User Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allOrderedProducts as $orderDetails)
                        <tr class="order-row">
                            <td>{{ $orderDetails['order']->id }}</td>
                            <td>{{ $orderDetails['userName'] }}</td>
                            <td>{{ $orderDetails['orderedProducts'][0]->description ?? 'NULL' }}</td>
                            <td>&nbsp;&nbsp;₹ {{ $orderDetails['orderedProducts'][0]->price ?? 0 }}</td>
                            {{-- <td>{{ $orderDetails['orderedProducts'][0]->quantity }}</td> --}}
                            <td>&nbsp;&nbsp;&nbsp;₹ {{ $orderDetails['orderedProducts'][0]->totalPrice ?? 0 }}</td>
                            <td><span class="badge text-bg-success">{{ $orderDetails['order']->status }}</span></td>
                            <td >
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
                                $getStatus =
                                App\Models\Order::where('id',$orderDetails['order']->id)->select('status')->first();
                                $status = $getStatus->status ?? 0;
                                @endphp
                                @if($status == "Order Recieved")
                                <a class="btn btn-danger view-details"
                                    href="{{route('changeOrderStatus',[$orderDetails['order']->id,2])}}">
                                    Accept Order
                                </a>
                                @elseif($status == "Order Accepted")
                                <a class="btn btn-danger view-details"
                                    href="{{route('changeOrderStatus',[$orderDetails['order']->id,3])}}">
                                    Order Ready for Pickup
                                </a>
                                @elseif($status == "Order Ready for pickup")
                                <a class="btn btn-danger view-details"
                                    href="{{route('changeOrderStatus',[$orderDetails['order']->id,4])}}">
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
    <br><br>
    <h2 style="text-align:center">Financial Overview</h2>
    <br><br>
    <div class="container-fluid">
        <div class="row">
            <!-- Chart Container -->
            <div class="col-lg-4 col-md-12">
                <div class="chart-container">
                    <div class="card card-chart">
                        <div class="card-header card-header-warning">
                            <canvas id="myChart"></canvas>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Earning per month</h4>
                            <p class="card-category">Line chart that shows earning per month</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container mt-5">dfdfdf</div> --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            $('.view-details').on('click', function() {
                var orderId = $(this).data('order-id');
                $('#details-' + orderId).toggle();
            });
        });
    </script>
</body>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var totalEarningsData = {!! json_encode($totalEarnings) !!};
    var labels = totalEarningsData.map(entry => entry.month + '/' + entry.year);
    var data = totalEarningsData.map(entry => entry.total_earning);
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: '# of Earning per month',
          backgroundColor: "rgba(255,99,132,0.2)",
    borderColor: "rgba(255,99,132,1)",
    borderWidth: 2,
    hoverBackgroundColor: "rgba(255,99,132,0.4)",
          data: data,
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
</script>

</html>