<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      
      
       <?php if ($products) { ?>
      
      <div class="row" style="border-bottom:1px solid #eee; padding-bottom:10px;">
        <div class="col-md-4">
          <div class="btn-group hidden-xs">
           <h2 class="heading-na"><?php echo $heading_title; ?></h2>
          </div>
        </div>
        <div class="col-md-2 text-right">
          <label class="control-label" for="input-sort"><?php echo $text_sort; ?></label>
        </div>
        <div class="col-md-3 text-right">
          <select id="input-sort" class="form-control" onchange="location = this.value;">
            <?php foreach ($sorts as $sorts) { ?>
            <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
            <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-1 text-right">
          <label class="control-label" for="input-limit"><?php echo $text_limit; ?></label>
        </div>
        <div class="col-md-2 text-right">
          <select id="input-limit" class="form-control" onchange="location = this.value;">
            <?php foreach ($limits as $limits) { ?>
            <?php if ($limits['value'] == $limit) { ?>
            <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
      </div>

      
      <div class="main">
        <div class="row">
<?php 
foreach ($products as $product) { 
    $price1=substr($product['price'],0,1);                
    if($price1=='$')
    {
    $price=str_replace( '$', '', $product['price'] );
    $special=str_replace( '$', '', $product['special'] );
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
    }else{$ans='';} ?>
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
    
      <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" />
<figcaption><?php echo substr($product['name'],0,25).'...'  ; ?></figcaption>
        
        <figcaption>
        <?php if (!$product['special']) { ?>
        <?php echo $product['price']; ?>
        <?php } else { ?>
        <strike><?php echo $product['price']; ?></strike>&nbsp;<?php echo $product['special']; ?>
        <?php if($ans!='' && $ans!=100){ ?>&nbsp;<span class="web_pertage-off"><?php echo $ans."% Off";?></span><?php } ?>
        <?php } ?></figcaption>
      </a></div>
        
      
    
  </div>
  <?php } ?>
</div>
</div>
      <div class="row">
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
      </div>
      <?php } ?>
      <?php if (!$categories && !$products) { ?>
      <p><?php echo $text_empty; ?></p>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
