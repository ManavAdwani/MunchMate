<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Restaurant - MunchMate</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<style>
    body {
        background-image: url('https://bolt.eu/static/e7696d02b93daf25cfc2667fd006c32e/ce83c/desktop.png');
    }
</style>

<body>
    <section>
        <div class="container">

            <div class="alert alert-warning text-center my-4">
                After Registration you can add your restaurant menu so please keep things handy for fast process
            </div>
            <form action="{{route('saveRestaurant')}}" method="POST">
                @csrf
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-8 col-xl-6">
                    <div class="row">
                        <div class="col text-center">
                            <h1>Register your restaurant</h1>
                            <p class="text-h3">Register your restaurant with us and get no commissions for first month !
                            </p>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col mt-4">
                            <input type="text" name="name" class="form-control" placeholder="Restaurant Name">
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <input type="email" name="email" class="form-control" placeholder="Restaurant Email">
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <div class="input-group">
                                <input type="text" name="location" id="inputLocation" class="form-control" placeholder="Restaurant Address (e.g. M.G. Road, Pune)">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" id="getLocationBtn" onclick="getLocation()">Locate Me</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <input type="number" name="phone" class="form-control" placeholder="Restaurant Phone Number">
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <input type="password" name="pass" class="form-control" placeholder="Password">
                        </div>
                        <div class="col">
                            <input type="password" name="cpass" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="row justify-content-start mt-4">
                        <div class="col">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">
                                    I Read and Accept <a href="https://www.froala.com">Terms and Conditions</a>
                                </label>
                            </div>

                            <button class="btn btn-primary mt-4">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script>
        function getLocation() {
            const btn = document.getElementById('getLocationBtn');
            if (navigator.geolocation) {
                btn.innerHTML = 'Locating...';
                btn.disabled = true;
                const options = { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 };
                navigator.geolocation.getCurrentPosition(showPosition, showError, options);
            } else { 
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
                .then(response => response.json())
                .then(data => {
                    const address = data.address;
                    if(!address) {
                        alert("Could not retrieve address.");
                        resetButton();
                        return;
                    }
                    
                    // Construct full address string
                    let parts = [];
                    if(address.road) parts.push(address.road);
                    if(address.suburb) parts.push(address.suburb);
                    if(address.neighbourhood) parts.push(address.neighbourhood);
                    if(address.city || address.town || address.village) parts.push(address.city || address.town || address.village);
                    if(address.state) parts.push(address.state);
                    if(address.postcode) parts.push(address.postcode);

                    document.getElementById('inputLocation').value = parts.join(', ');
                    resetButton();
                })
                .catch(error => {
                    console.error('Error:', error);
                    resetButton();
                });
        }

        function showError(error) {
            alert("Error getting location: " + error.message);
            resetButton();
        }

        function resetButton() {
            const btn = document.getElementById('getLocationBtn');
            btn.innerHTML = 'Locate Me';
            btn.disabled = false;
        }
    </script>
</body>
</html>