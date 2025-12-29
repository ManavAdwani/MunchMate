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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
@include('navbar.navbar');

<body>
    <br><br><br><br><br>
    <div class="container mt-5 px-5">
        <a href="{{route('backToCart',[$orderId])}}" class="btn btn-danger">↤ &nbsp; Back</a>
        <br><br>
        <div class="addressSelection">
            @php
            $isAddressAvailable = App\Models\Address::where('user_id', session()->get('userId'))->select('id','address',
            'city', 'state', 'pincode')->get()->toArray();
            @endphp
            <div id="selectAddress">
                @if(!empty($isAddressAvailable))
                @foreach ($isAddressAvailable as $add)
                <div class="card mt-3">
                    <span class="material-symbols-outlined" style="font-size: 40px">
                        home_pin
                    </span>
                    <p class="cookieHeading">{{$add['state']}}</p>
                    <p class="cookieDescription">{{ $add['address']
                        }}&nbsp;{{$add['state']}}&nbsp;{{$add['city']}}&nbsp;{{$add['pincode']}}</p>

                    <div class="buttonContainer">
                        <a href="{{route('payment',[$orderId,$add['id']])}}" class="btn btn-warning">Use This address</a>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="mb-4 mt-5">

            <h2>Confirm order and pay</h2>
            <span>please make the payment, to enjoy tastiest food in your comfort zone !</span>

        </div>

        <form action="{{route('checkout')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
                <form class="row g-3">
                    <div class="col-12">
                        @php
                        $userDetails = App\Models\User::where('id',session()->get('userId'))->select('email')->first();
                        $userEmail = $userDetails->email;
                        @endphp
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" value="{{$userEmail}}" name="email" class="form-control" id="inputEmail4"
                            placeholder="Enter Email" readonly>
                    </div>
                    <div class="col-12 mt-3">
                        <label for="inputAddress" class="form-label">Address</label>
                        <div class="input-group">
                            <input type="text" name="address" class="form-control" id="inputAddress" placeholder="Enter address">
                            <button type="button" class="btn btn-outline-primary" id="getLocationBtn" onclick="getLocation()">
                                <span class="material-symbols-outlined" style="font-size: 18px; vertical-align: middle;">my_location</span> Locate Me
                            </button>
                        </div>
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
                        <input type="text" id="inputCity" name="city" class="form-control" placeholder="Enter City">
                    </div>
                    <div class="col-md-2 mt-3">
                        <label for="inputZip" class="form-label">Zip</label>
                        <input type="text" name="zip" class="form-control" id="inputZip" placeholder="Enter pincode">
                    </div>
                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-success">Pay
                            ₹&nbsp;{{session()->get('grandTotal')}}</button>
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

        // Geolocation Logic
        function getLocation() {
            const btn = document.getElementById('getLocationBtn');
            if (navigator.geolocation) {
                btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Locating...';
                btn.disabled = true;

                // Request high accuracy to avoid IP-based location issues
                const options = {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                };

                navigator.geolocation.getCurrentPosition(showPosition, showError, options);
            } else { 
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            console.log("Location fetched:", position.coords.latitude, position.coords.longitude);
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            
            // Call Nominatim API for reverse geocoding
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
                .then(response => response.json())
                .then(data => {
                    console.log("Nominatim Data:", data);
                    const address = data.address;
                    
                    if(!address) {
                        alert("Could not retrieve address from coordinates.");
                        resetButton();
                        return;
                    }

                    // Populate Address
                    let addrPart = [];
                    if(address.road) addrPart.push(address.road);
                    if(address.suburb) addrPart.push(address.suburb);
                    if(address.neighbourhood) addrPart.push(address.neighbourhood);
                    if(address.residential) addrPart.push(address.residential);
                    
                    const addressField = document.getElementById('inputAddress');
                    addressField.value = addrPart.join(', ');

                    // Populate Address 2 (Building/House)
                    let addr2Part = [];
                    if(address.house_number) addr2Part.push(address.house_number);
                    if(address.building) addr2Part.push(address.building);
                    if(address.apartment) addr2Part.push(address.apartment);
                    
                    document.getElementById('inputAddress2').value = addr2Part.join(', ');

                    // Populate City (Prioritize city, then town, then other levels)
                    const city = address.city || address.town || address.village || address.municipality || address.county;
                    if(city) document.getElementById('inputCity').value = city;

                    // Populate Zip
                    if(address.postcode) document.getElementById('inputZip').value = address.postcode;

                    // Populate State
                    if(address.state) {
                        const stateName = address.state;
                        // Find key matching the state name
                        const stateCode = Object.keys(indianStates).find(key => indianStates[key].toLowerCase() === stateName.toLowerCase());
                        if(stateCode) {
                            document.getElementById('inputState').value = stateCode;
                        }
                    }
                    
                    // Reset button
                    resetButton();
                })
                .catch(error => {
                    console.error('Error fetching address:', error);
                    alert('Unable to retrieve address details.');
                    resetButton();
                });
        }

        function showError(error) {
            console.error("Geolocation Error:", error);
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation. Please allow location access in your browser settings.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable. Try again.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
            resetButton();
        }

        function resetButton() {
            const btn = document.getElementById('getLocationBtn');
            btn.innerHTML = '<span class="material-symbols-outlined" style="font-size: 18px; vertical-align: middle;">my_location</span> Locate Me';
            btn.disabled = false;
        }
    </script>
</body>

</html>