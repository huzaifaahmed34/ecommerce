<div id="load" style="position: relative;">
    <div class=row>
  
        @foreach($data as $q)
            <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                        <img src="data:image/png;base64,{{ chunk_split(base64_encode($q->logo)) }}" alt="" width="100%" height="200" />
                                            <?php                           
            if($q->discount_available==1 && $q->end_discount_date>date('Y-m-d H:i:s')){
                ?>
                                                <h4 style="margin-bottom: -0px;">Rs {{$q->price-($q->price*($q->discount_perc/100))}}</h4>
                                                <p style="margin-bottom: -0px"><del>Rs {{$q->price}}</del> <small id=discount>{{$q->discount_perc}}% Off</small></h4>
                                                <?php }
                                                else{
                                                    ?>
                                                <h4 style="margin-top: 20px;">Rs {{$q->price}}</h4>

                                    <?php 
                                }?>
                                            <p style="font-size: 17px;"><b><?php echo substr($q->product_name,0,30)?></b></p>
                                            
                                            <a href="{{url('/ProductDetail/')}}/{{$q->slug}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View</a>
                                        
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <?php                           
            if($q->discount_available==1 && $q->end_discount_date>date('Y-m-d H:i:s')){
                ?>
                                                <h4 style="margin-bottom: -0px;">Rs {{$q->price-($q->price*($q->discount_perc/100))}}</h4>
                                                <p style="margin-bottom: -0px"><del>Rs {{$q->price}}</del> <small id=discount>{{$q->discount_perc}}% Off</small></h4>
                                                <?php }
                                                else{
                                                    ?>
                                                <h4 style="margin-top: 20px;">Rs {{$q->price}}</h4>

                                    <?php 
                                }?>
                                                <p><?php echo substr($q->product_name,0,30)?></p>
                                                <a href="{{url('/ProductDetail/')}}/{{$q->slug}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View</a>
                                                
                                            </div>
                                        </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
        @endforeach
       
</div></div>

{!! $data->render() !!}