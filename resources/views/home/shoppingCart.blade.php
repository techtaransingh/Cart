<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fruit Mart</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="home/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="home/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="home/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->

    <!-- Humberger End -->

    <!-- Header Section Begin -->
    @include('home.header')
    <!-- Header Section End -->



    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="home/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="home/index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <?php if(isset($cartMessage)){ ?>
    <div class="text-center mt-5">
        <h4 class="text-danger"><?php echo $cartMessage;?></h4>

    </div>
    <?php } ?>
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">

                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <form action="{{URL('updateCart')}}" method="post">
                                    @csrf
                                    <?php

                                foreach ($cartData as $val) {
                                    // print_r($val);
                                    
                                        foreach($val->getProducts as $productValue){
                                            
                                        ?>
                                    <tr>

                                        <td class="shoping__cart__item">
                                            <img src="{{URL('images',$productValue->image)}}" width="80px" alt="">
                                            <h5>{{$productValue->name}}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            {{$productValue->price}}
                                        </td>

                                        <td class="shoping__cart__quantity">
                                            <select class="form-select" name="quantity[]"
                                                aria-label="Default select example">
                                                <!-- <option selected>Open this select menu</option> -->
                                                <option selected value="{{$val->quantity}}">{{$val->quantity}}
                                                </option>
                                                <option value="0">0 (Delete)</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            <input type="hidden" name="product_id[]" value="{{ $val->product_id }}">
                                            <!-- <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="$val->quantity">
                                            </div>
                                        </div> -->
                                        </td>
                                        <td class="shoping__cart__total">
                                            ₹{{$val->price}}
                                        </td>

                                    </tr>
                                    <?php
                                        }
                                 }?>



                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="/" class="primary-btn cart-btn">CONTINUE SHOPPING</a>

                        <button type="submit" class="primary-btn cart-btn cart-btn-right">Update Cart</button>
                    </div>
                </div>
                <form>
                    <div class="col-lg-6">
                        <div class="shoping__continue">
                            <div class="shoping__discount">
                                <h5>Discount Codes</h5>
                                <form action="#">
                                    <input type="text" placeholder="Enter your coupon code">
                                    <button type="submit" class="site-btn">APPLY COUPON</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="shoping__checkout">
                            <h5>Cart Total</h5>
                            <ul>
                                <!-- <li>Subtotal <span>$454.98</span></li> -->
                                <li>Total <span> ₹{{$total}}</span></li>
                            </ul>
                            @if(!empty($loggedIn))
                            <a href="{{URL('checkout')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
                            @else
                            <a href="{{URL('login')}}" class="primary-btn">PROCEED TO CHECKOUT</a>

                            @endif
                        </div>
                    </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
    <!-- Footer Section Begin -->
    @include('home.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    @include('home.script')

</body>

</html>