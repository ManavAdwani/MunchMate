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
        
        <!-- Update Location Form -->
        <div class="card mb-4 p-3 shadow-sm">
            <h5 class="mb-3">Update Restaurant Location</h5>
            <form action="{{ route('updateResLocation') }}" method="POST" class="row g-3 align-items-center">
                @csrf
                <div class="col-auto" style="flex-grow: 1;">
                    <div class="input-group">
                        <input type="text" name="location" id="updateLocationInput" class="form-control" placeholder="Enter Full Address (e.g. Pune, MH)" value="{{ $location }}" required>
                        <button type="button" class="btn btn-outline-secondary" id="getLocationUpdateBtn" onclick="getLocationForUpdate()">Locate Me</button>
                    </div>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Update Location</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function getLocationForUpdate() {
            const btn = document.getElementById('getLocationUpdateBtn');
            if (navigator.geolocation) {
                btn.innerHTML = 'Locating...';
                btn.disabled = true;
                const options = { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 };
                navigator.geolocation.getCurrentPosition(
                    (pos) => showPositionForUpdate(pos), 
                    (err) => { alert("Error: " + err.message); btn.innerHTML = 'Locate Me'; btn.disabled = false; }, 
                    options
                );
            } else { 
                alert("Geolocation not supported");
            }
        }

        function showPositionForUpdate(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
                .then(res => res.json())
                .then(data => {
                    const address = data.address;
                    if(address) {
                        let parts = [];
                        if(address.road) parts.push(address.road);
                        if(address.suburb) parts.push(address.suburb);
                        if(address.neighbourhood) parts.push(address.neighbourhood);
                        if(address.city || address.town) parts.push(address.city || address.town);
                        if(address.state) parts.push(address.state);
                        
                        document.getElementById('updateLocationInput').value = parts.join(', ');
                    }
                    document.getElementById('getLocationUpdateBtn').innerHTML = 'Locate Me';
                    document.getElementById('getLocationUpdateBtn').disabled = false;
                });
        }
    </script>
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
        @if(session()->get('error'))
        <div class="alert alert-danger" role="alert">
            {{session()->get('error')}}
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
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>User</th>
                            <th>Items</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($initialOrders as $orderDetails)
                            <tr class="order-row">
                                <td>{{ $orderDetails->id }}</td>
                                <td>{{ $orderDetails->userName }}</td>
                                <td>
                                    @php
                                        $dishes = explode(',', $orderDetails->dish_names);
                                        echo implode('<br>', $dishes);
                                    @endphp
                                </td>
                                <td>
                                    @php
                                        $prices = explode(',', $orderDetails->prices);
                                        echo implode('<br>', array_map(fn($price) => '₹ '.$price, $prices));
                                    @endphp
                                </td>
                                <td>₹ {{ $orderDetails->grandTotal }}</td>
                                <td><span class="badge text-bg-success">{{ $orderDetails->status }}</span></td>
                                <td>
                                    <button class="btn btn-info view-details" data-order-id="{{ $orderDetails->id }}">
                                        View Details
                                    </button>
                                    @php
                                    $status = $orderDetails->status ?? 0;
                                @endphp
                    
                                @if($status == "Order Received")
                                    <a class="btn btn-danger view-details" href="{{route('changeOrderStatus',[$orderDetails->id,2])}}">
                                        Accept Order
                                    </a>
                                @elseif($status == "Order Accepted")
                                    <a class="btn btn-danger view-details" href="{{route('changeOrderStatus',[$orderDetails->id,3])}}">
                                        Order Ready for Pickup
                                    </a>
                                @elseif($status == "Order Ready for Pickup")
                                    <a class="btn btn-danger view-details" href="{{route('changeOrderStatus',[$orderDetails->id,4])}}">
                                        Order Picked Up
                                    </a>
                                @endif
                                </td>
                                
                            </tr>
                
                            <!-- Hidden Order Details Row -->
                            <tr id="details-{{ $orderDetails->id }}" style="display: none;">
                                <td colspan="7">
                                    <div class="order-details-content">
                                        <strong>Order ID:</strong> {{ $orderDetails->id }} <br>
                                        <strong>User:</strong> {{ $orderDetails->userName }} <br>
                                        <strong>Status:</strong> {{ $orderDetails->status }} <br>
                                        <hr>
                                        <strong>Ordered Items:</strong>
                                        <ul>
                                            @php
                                                $dishes = explode(',', $orderDetails->dish_names);
                                                $quantities = explode(',', $orderDetails->quantities);
                                                $prices = explode(',', $orderDetails->prices);
                                            @endphp
                                            @foreach($dishes as $index => $dish)
                                                <li>
                                                    <strong>{{ $dish }}</strong> (x{{ $quantities[$index] ?? 1 }}) - ₹{{ $prices[$index] ?? 0 }}
                                                </li>
                                            @endforeach
                                        </ul>
                                        <hr>
                                        <strong>Total Price:</strong> ₹ {{ $orderDetails->grandTotal }}
                                    </div>
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
                // alert('helo');
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