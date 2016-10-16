<section>
<div class="container">
<div class="row">
<div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
<div class="w_new-arrival-block">
<h3><span>New Arrival </span><!-- <a href="#" class="pull-right">View All</a> --></h3>

<div class="main">
  <?php 
   foreach ($products as $product) { 
    if($product['price']<$product['special'] and $product['price'] > 0){
$ans= ((($product['price']-$product['special'])/$product['price'])*100);
$ans=floor($ans);
}else{$ans='';}?>
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    
      <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" />
<figcaption><?php echo $product['name']; ?></figcaption>
<figcaption>
        <?php if (!$product['special']) { ?>
        <?php echo $product['price']; ?>
        <?php } else { ?>
        <strike><?php echo $product['price']; ?></strike>&nbsp;<?php echo $product['special']; ?>
        <?php if($ans!=''){ ?>&nbsp;<span class="web_pertage-off"><?php echo $ans."% Off";?></span><?php } ?>
        <?php } ?></figcaption>
      
      </a>

      </div>
        
        
        
    
  </div>
  <?php } ?>
</div>

</div><!--Web -->
<!--Mobile-->
<div class="complete-look">
  <h1>New Arrival <!-- <a href="#">View All</a> --></h1>
  <ul>
  <?php foreach ($products as $product) { 
if($product['price']<$product['special']){
$ans= ((($product['price']-$product['special'])/$product['price'])*100);
$ans=floor($ans);
}else{$ans='';}
    ?>
          <li><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" with="553" height="570" />
          <figcaption><?php echo $product['name']; ?></figcaption>
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
