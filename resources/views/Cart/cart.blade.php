<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart - MunchMate</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="{{asset('css/cart.css')}}">
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
<style>
    @import url("https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Chango&family=Roboto&display=swap");
</style>

@include('navbar.navbar');

<body>
    <div class="container" style="margin-top:100px">
        <center>
            <h4 style="font-family: Roboto, sans-serif;">Your Cart ({{$totalCount}} items)</h4>
        </center>
    </div>
    <div class="mt-5"></div>
    <div class="container">
        <div class="cart">
            @foreach ($products as $index => $product)
            <div class="items">
                <input type="hidden" value="{{$product->cartId}}" id="cartId_{{$index}}">
                <div class="left">
                    <img src="{{asset('dishes/'.$product->dish_pic)}}" alt="">
                    <div class="name" style="display: inline-block;">
                        <p style="font-family: 'Comic Sans MS', cursive; font-size:20px">{{$product->dish_name}}</p>
                        <p style="font-family: 'Comic Sans MS', cursive; font-size:15px">{{$product->dish_desc}}</p>
                    </div>
                </div>
                <div class="quantity buttons_added">
                    <input type="button" value="-" class="minus">
                    <input type="number" step="1" min="1" max="" name="quantity" value="{{$product->qty}}"
                        onchange="updating(this.value, document.getElementById('cartId_{{$index}}').value)" title="Qty"
                        class="input-text qty text" size="4" pattern="" inputmode="" id="qtyInput">
                    <input type="button" value="+" class="plus">
                </div>
                <div class="right">
                    <p style="font-family: 'Comic Sans MS', cursive; font-size:17px">Price :
                        ₹&nbsp;{{($product->price)*($product->qty)}}
                    </p>
                    <span class="material-symbols-outlined" style="color: red; cursor: pointer;">
                        delete
                    </span>
                </div>
            </div>
            <br>
            @endforeach

        </div>
    </div>
    {{-- <div class="mt-5"></div> --}}
    <div class="container">
        <div class="cartout">
            <div class="subtotal">Items Total: <b>₹{{$totalPrice}}</b></div>
            <div class="tax">Delivery charges: <b>₹45</b></div>
            <div class="grand-total" id="grand-total">Grand total: &nbsp;₹{{$grandTotal}}</div>
            <button class="btn btn-warning" style="width: 100%">Order Now </button>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function wcqib_refresh_quantity_increments() {
    jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
        var c = jQuery(b);
        c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
    })
}
    String.prototype.getDecimals || (String.prototype.getDecimals = function() {
        var a = this,
            b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
        return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
    }), jQuery(document).ready(function() {
        wcqib_refresh_quantity_increments()
    }), jQuery(document).on("updated_wc_div", function() {
        wcqib_refresh_quantity_increments()
    }), jQuery(document).on("click", ".plus, .minus", function() {
        var a = jQuery(this).closest(".quantity").find(".qty"),
            b = parseFloat(a.val()),
            c = parseFloat(a.attr("max")),
            d = parseFloat(a.attr("min")),
            e = a.attr("step");
        b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
    });
</script>

<script>
    let token = document.head.querySelector('meta[name="csrf-token"]').content;
     function updating(qty, cartId) {
    updateQuantity(qty, cartId);
}

// Attach the click event listeners separately
$('.minus').click(function () {
    let qtyInput = $(this).closest('.quantity').find('.qty');
    let new_value = parseInt(qtyInput.val()) - 1;
    updating(qtyInput[0], $('#cartId_{{$index}}').val());
});

$('.plus').click(function () {
    let qtyInput = $(this).closest('.quantity').find('.qty');
    let new_value = parseInt(qtyInput.val()) + 1;
    updating(qtyInput[0], $('#cartId_{{$index}}').val());
});

function updateQuantity(newQty, cId) {
    let productId = cId;
    
    // Check if productId and newQty are defined and not null
    if (productId !== undefined && productId !== null && newQty !== undefined && newQty !== null) {
        $.ajax({
            method: 'POST',
            url: '/update-quantity',
            headers: {
                'X-CSRF-TOKEN': token
            },
            data: {
                'id': productId,
                'qty': newQty,
            },
            success: function (response) {
                console.log(response);
                location.reload();
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText); // Log the full error response for debugging
            }
        });
    } else {
        console.error('productId or newQty is undefined or null');
    }
}

</script>


</html>