<section>
<div class="container">
<div class="row">
<div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
<div class="w_new-arrival-block">
<h3><span>Featured Products </span><!-- <a href="#" class="pull-right">View All</a> --></h3>
<div class="main">
    <div class="row">    
        <!-- slide Carousel -->
        <ul id="carousel" class="elastislide-list">
          <?php foreach ($products as $product) { 
                $price1=substr($product['price'],0,1);                
                if($price1=='$')
                {
                  $priceq=str_replace( '$', '', $product['price'] );
                  $price=str_replace( ',', '', $priceq );
                  $specialq=str_replace( '$', '', $product['special'] );
                  $special=str_replace( ',', '', $specialq );
                }
                else{
			$priceq=str_replace( 'Rs', '', $product['price'] );
    			$price=str_replace( ',', '', $priceq ); 
  			$specialq=str_replace( 'Rs', '', $product['special'] );
   		 	$special=str_replace( ',', '', $specialq );                 

                }    
if($price>$special){
$ans= ((($price-$special)/$price)*100);
$ans=floor($ans);
}else{$ans='';}
            ?>
          <li><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" />
          <figcaption><?php echo substr($product['name'], 0,25); ?></figcaption>
        <figcaption>
        <?php if (!$product['special']) { ?>
        <?php echo $product['price']; ?>
        <?php } else { ?>
        <strike><?php echo $product['price']; ?></strike>&nbsp;<?php echo $product['special']; ?>
        <?php if($ans!=''){ ?>&nbsp;<span class="web_pertage-off"><?php echo $ans."% Off";?></span><?php } ?>
        <?php } ?></figcaption>
        </a></li>
        <?php } ?>
          
        </ul>
        <!-- End slide Carousel -->
      </div>
</div></div><!--Web -->
<!----------------------for Mobile-->
<div class="complete-look">
  <h1>Featured Products <!-- <a href="#">View All</a> --></h1>
  <ul>
  <?php foreach ($products as $product) { 
    $price1=substr($product['price'],0,1);                
                if($price1=='$')
                {
                  $priceq=str_replace( '$', '', $product['price'] );
                  $price=str_replace( ',', '', $priceq );
                  $specialq=str_replace( '$', '', $product['special'] );
                  $special=str_replace( ',', '', $specialq );
                }
                else{
                 $priceq=str_replace( '$', '', $product['price'] );
                  $price=str_replace( ',', '', $priceq );
                  $specialq=str_replace( '$', '', $product['special'] );
                  $special=str_replace( ',', '', $specialq );
                }    
if($price>$special){
$ans= ((($price-$special)/$price)*100);
$ans=floor($ans);
}else{$ans='';} ?>
          <li><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" with="553" height="570" />
          <figcaption><?php echo substr($product['name'], 0,15); ?></figcaption>
        <figcaption>
        <?php if (!$product['special']) { ?>
        <?php echo $product['price']; ?>
        <?php } else { ?>
        <strike><?php echo $product['price']; ?></strike><br><?php echo $product['special']; ?>&nbsp;
        <?php if($ans!=''){ ?>&nbsp;<span class="web_pertage-off"><?php echo $ans."% Off";?></span><?php } ?>
        <?php } ?></figcaption>
        </a></li>
        <?php } ?>
  </ul>
  </div>
<!--Mobile-->
</div>
</div>
</div>
</section>
<!--carousla Deal of the Day---->



</div>
</div>
</div>

</section>
