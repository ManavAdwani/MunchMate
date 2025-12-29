<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel - MunchMate</title>
    <link rel="stylesheet" href="{{asset('css/adminDashboard.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
@include('navbar.AdminNav');

<body class="mt-5">
    <div class="container mt-5">
        <h1 class="welcome-text">Good Morning, <span class="text-black fw-bold">{{session()->get('username')}}</span>
        </h1>
    </div>
<br><br>
   <div class="container">
    <h3>Edit User</h3>
    <form method="POST" action="{{ route('update_user',$user->id) }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{$user->username}}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" value="{{$user->email}}">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone number</label>
            <input type="number" name="phone" class="form-control" id="phone" value="{{$user->phone_number}}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    
   </div>
   

    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>