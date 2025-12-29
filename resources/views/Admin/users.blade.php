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

    <div class="container">

        <br><br>
        
        <table class="table table-striped">
            <div class="res_user-header" style="display: flex; justify-content: space-between; align-items: center;">
                <h3>Users</h3>
                <a href="{{route('add_res_user')}}" class="btn btn-sm btn-warning">Add user</a>
            </div>
            <br><br>
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
              <tr>
                <th scope="row">1</th>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone_number}}</td>
                <td><a href="{{route('edit_user',$user->id)}}" class="btn btn-sm btn-success">Edit</a>&nbsp;<a href="{{route('delete_user',$user->id)}}" class="btn btn-sm btn-danger">Delete</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>
   

    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>