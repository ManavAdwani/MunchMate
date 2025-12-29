<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products - MunchMate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
@include('navbar.RestaurantNav');

<body class="mt-5">
    <div class="container mt-5">
        <div class="butn float-right">
            <a href="{{route('addMenu')}}" class="btn btn-warning">Add Product</a>
        </div>
        <br><br><br><br>
        @if(session()->get('success'))
        <div class="alert alert-success" role="alert">
            {{session()->get('success')}}
          </div>
        @elseif(session()->get('error'))
        <div class="alert alert-danger" role="alert">
            {{session()->get('error')}}
          </div>
        @endif
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($getDetails as $details)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{asset('dishes/'.$details['dish_pic'])}}" alt=""
                                style="width: 45px; height: 45px" class="rounded-circle" />
                            <div class="ms-3">
                                <p class="fw-bold mb-1">{{$details['dish_name']}}</p>
                            </div>
                        </div>
                    </td>
                    <td class="">
                        <p class="text-muted mt-2">{{$details['description']}}</p>
                    </td>
                    <td>
                        <span class="text">₹ {{$details['price']}}</span>
                    </td>
                    <td>
                        <a href="{{route('deleteMenu',$details['id'])}}" class="btn btn-danger btn-sm"><span class="material-symbols-outlined mt-1" style="font-size: 17px;">
                            delete
                            </span></a>
                    </td>
                </tr>
                   
                @endforeach
            </tbody>
        </table>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>