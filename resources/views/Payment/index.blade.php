<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment - MunchMate</title>
    <link rel="stylesheet" href="{{asset('css/paymentIndex.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
@include('navbar.navbar');

<body>
    <br><br><br><br><br>
    <div class="container mt-5 px-5">
        <a href="{{route('backToCart',[$orderId])}}" class="btn btn-danger">↤ &nbsp; Back</a>
        <br><br>
        <div class="mb-4">

            <h2>Confirm order and pay</h2>
            <span>please make the payment, to enjoy tastiest food in your comfort zone !</span>

        </div>
        <form action="{{route('checkout')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
                <form class="row g-3">
                    <div class="col-12">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" value="{{session()->get('userId')}}" name="email" class="form-control" id="inputEmail4"  placeholder="Enter Email">
                    </div>
                    <div class="col-12 mt-3">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" id="inputAddress" placeholder="Enter address">
                    </div>
                    <div class="col-12 mt-3">
                        <label for="inputAddress2" class="form-label">Address 2</label>
                        <input type="text" name="address2" class="form-control" id="inputAddress2"
                            placeholder="Apartment, studio, or floor">
                    </div>
                   
                    <div class="col-md-4 mt-3">
                        <label for="inputState" class="form-label">State</label>
                        <select id="inputState" name="state" class="form-select">
                            <option value="" selected disabled>Select State</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputCity" class="form-label">City</label>
                        <select id="inputCity" name="city" class="form-select">
                            <option value="" selected disabled>Select City</option>
                        </select>
                    </div>
                    <div class="col-md-2 mt-3">
                        <label for="inputZip" class="form-label">Zip</label>
                        <input type="text" name="zip" class="form-control" id="inputZip" placeholder="Enter pincode">
                    </div>
                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-success">Pay ₹&nbsp;{{session()->get('grandTotal')}}</button>
                    </div>
                </form>
            </div>
        </form>

        @php
        $indianStates = ['AR' => 'Arunachal Pradesh',
        'AR' => 'Arunachal Pradesh',
        'AS' => 'Assam',
        'BR' => 'Bihar',
        'CT' => 'Chhattisgarh',
        'GA' => 'Goa',
        'GJ' => 'Gujarat',
        'HR' => 'Haryana',
        'HP' => 'Himachal Pradesh',
        'JK' => 'Jammu and Kashmir',
        'JH' => 'Jharkhand',
        'KA' => 'Karnataka',
        'KL' => 'Kerala',
        'MP' => 'Madhya Pradesh',
        'MH' => 'Maharashtra',
        'MN' => 'Manipur',
        'ML' => 'Meghalaya',
        'MZ' => 'Mizoram',
        'NL' => 'Nagaland',
        'OR' => 'Odisha',
        'PB' => 'Punjab',
        'RJ' => 'Rajasthan',
        'SK' => 'Sikkim',
        'TN' => 'Tamil Nadu',
        'TG' => 'Telangana',
        'TR' => 'Tripura',
        'UP' => 'Uttar Pradesh',
        'UT' => 'Uttarakhand',
        'WB' => 'West Bengal',
        'AN' => 'Andaman and Nicobar Islands',
        'CH' => 'Chandigarh',
        'DN' => 'Dadra and Nagar Haveli',
        'DD' => 'Daman and Diu',
        'LD' => 'Lakshadweep',
        'DL' => 'National Capital Territory of Delhi',
        'PY' => 'Puducherry'];
        @endphp
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        // Predefined array of Indian states
        const indianStates = <?php echo json_encode($indianStates); ?>;
    
        // Populate the dropdown
        const inputState = document.getElementById('inputState');
        Object.entries(indianStates).forEach(([stateCode, stateName]) => {
            const option = document.createElement('option');
            option.value = stateCode;
            option.text = stateName;
            inputState.add(option);
        });
    </script>
</body>

</html>