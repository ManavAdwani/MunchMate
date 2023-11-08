<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu - {{$resName}}</title>
    <link rel="stylesheet" href="{{asset('css/menu.css')}}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }
    </style>
</head>

<body>
    @include('navbar.navbar');
    <div class="container">
        <div class="mainbox">
            <div class="left">
                <p class="RestaurantNameAddress_name__2IaTv">{{$resName}}</p>
                <p class="RestaurantNameAddress_cuisines__mBHr2">Pizzas, Pastas</p>
                <p class="RestaurantNameAddress_area__2P9ib" aria-hidden="true">Kudasan</p>
            </div>
            <div class="right">
                <div class="starss btn btn-transparent">
                    <p style="margin-bottom: 0px !important; align-items:center; color:green">&nbsp;&nbsp;<span
                            class="material-symbols-outlined">
                            stars
                        </span>&nbsp;&nbsp;3.9</p>
                    <hr>
                    <p style="margin-bottom: 0px">5k+ ratings</p>
                </div>
            </div>
        </div>
        <hr>
        <h5>Deal of the day</h5>
        <br>

    </div>
    <div class="container">
        <div class="maindeal" style="display: flex; flex-wrap:wrap;;gap:20px">
          <div class="subdeals" style="border: 1px solid rgb(201, 200, 200); width: 200px; border-radius: 10px;  flex-wrap:nowrap; ">
            <p style="color: brown; display: flex; align-items: center; margin-bottom: 0px; margin-top: 5px; margin-left: 10px;">
              <span class="material-symbols-outlined">payments</span>&nbsp;60% OFF UPTO ₹120
            </p>
            <p class="m-0;" style="font-size: 12px; color: grey; margin-left: 10px; margin-top: 1px; font-weight: 700;">
              USE STEALDEAL | ABOVE ₹180
            </p>
          </div>
          <div class="subdeals" style="border: 1px solid rgb(201, 200, 200); width: 200px; border-radius: 10px;">
            <p style="color: brown; display: flex; align-items: center; margin-bottom: 0px; margin-top: 5px; margin-left: 10px;">
              <span class="material-symbols-outlined">payments</span>&nbsp;60% OFF UPTO ₹120
            </p>
            <p class="m-0;" style="font-size: 12px; color: grey; margin-left: 10px; margin-top: 1px; font-weight: 700;">
              USE STEALDEAL | ABOVE ₹180
            </p>
          </div>
          <div class="subdeals" style="border: 1px solid rgb(201, 200, 200); width: 200px; border-radius: 10px;">
            <p style="color: brown; display: flex; align-items: center; margin-bottom: 0px; margin-top: 5px; margin-left: 10px;">
              <span class="material-symbols-outlined">payments</span>&nbsp;60% OFF UPTO ₹120
            </p>
            <p class="m-0;" style="font-size: 12px; color: grey; margin-left: 10px; margin-top: 1px; font-weight: 700;">
              USE STEALDEAL | ABOVE ₹180
            </p>
          </div>
        </div>
      
        <br>
        <hr>
      </div>
    <div class="container">
        <h5>Recommended (20)</h5>
        <br>
        <div class="mainMenu">
            @foreach($menu as $food)
            <div class="subMenu" style="display: flex;justify-content:space-between;">
                <div class="leftMenu">
                    <p class="foodname mb-0">{{$food->dish_name}}</p>
                    <p class="food_desc mb-0" style="color:grey">{{$food->description}}</p>
                    <p class="foodprice">₹{{$food->price}}</p>
                   <a href="{{$food->menu_id}}"> <button class="btn btn-warning" style="width: 100px;">Add</button></a>
                </div>
                <div class="rightMenu">
                    <img src="{{asset('dishes/'.$food->dish_pic)}}" alt="" style="width:100px;height:100px;border-radius:20px">
                </div>
            </div>
            <br>
            <hr>
            <br>
            @endforeach
        </div>
    </div>


</body>

</html>