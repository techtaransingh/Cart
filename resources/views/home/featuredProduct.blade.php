<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Featured Products</h2>
                </div>
                <!-- <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        <li data-filter=".oranges">Oranges</li>
                        <li data-filter=".fresh-meat">Fresh Meat</li>
                        <li data-filter=".vegetables">Vegetables</li>
                        <li data-filter=".fastfood">Fastfood</li>
                    </ul>
                </div> -->
            </div>
        </div>
        <div class="row featured__filter">
            <?php foreach($products as $val){?>
            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{URL('images',$val->image)}}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <?php

   if (in_array($val->id,$cart_product_id)) {
    
       ?>

                            <!-- <li> -->

                            <li><a href="{{URL('viewCart')}}"><i class="fa fa-shopping-bag"></i>
                                    <span>{{$cartCount}}</span></a></li>

                            <!-- <button disabled>
                                    <i class="fa fa-shopping-cart"></i>
                                </button>
                            </li> -->
                            <?php
   } else {
       
       ?>
                            <li><a href="{{URL('shoppingCart', $val->id)}}"><i class="fa fa-shopping-cart"></i></a></li>
                            <?php
   }

?>


                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">{{$val->name}}</a></h6>
                        <h5>₹{{$val->price}}</h5>
                    </div>
                </div>
            </div>
            <?php }?>


        </div>
        <div class="pagination"
            style="margin-top:45px;padding-top:20px;text-align:center;display:flex;justify-content:center;align-items:center">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
</section>