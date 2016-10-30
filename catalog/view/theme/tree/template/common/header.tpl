<!doctype html>
<html>
<head>
   <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
   <script src="<?php echo HTTP_SERVER ?>catalog/view/js/jquery.min.js" type="text/javascript"></script>
<link href="<?php echo HTTP_SERVER ?>catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="<?php echo HTTP_SERVER ?>catalog/view/js/bootstrap.min.js" type="text/javascript"></script>
   <link rel="stylesheet" href="<?php echo HTTP_SERVER ?>catalog/view/css/font-awesome.min.css" type="text/css" >

<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/tree/stylesheet/stylesheet.css" rel="stylesheet">
<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
   <link rel="stylesheet" href="<?php echo HTTP_SERVER ?>catalog/view/css/swiper.css" type="text/css">
   <link rel="stylesheet" type="text/css" href="<?php echo HTTP_SERVER ?>catalog/view/css/carousal-slide.css" />
   <link rel="stylesheet" href="<?php echo HTTP_SERVER ?>catalog/view/css/style.css" type="text/css">
   
   <script src="<?php echo HTTP_SERVER ?>catalog/view/js/swiper.js"></script>
   <script src="<?php echo HTTP_SERVER ?>catalog/view/js/carousal-plugin.js"></script>
   <script src="<?php echo HTTP_SERVER ?>catalog/view/js/custom.js"></script>
   <?php echo $google_analytics; ?>
   </head>
   
<body>
<div class="n_wrap">
<!---header Start-->
<header>
<section class="header-top">
<div class="container">
<div class="row">
<div class="col-md-3 col-xs-3 col-lg-3 col-sm-3">
<div class="logo">
<?php if ($logo) { ?>
          <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
          <?php } else { ?>
          <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
          <?php } ?>
</div>
</div>
<div class="col-md-3 col-xs-9 col-lg-3 col-sm-3 visible-xs text-right">
<div class="menu-bar">
<a href="javascript:void(0);">
<i></i>
<i></i>
<i></i></a>
<span>&times;</span>
</div>
</div>
<div class="col-md-5 col-xs-12 col-lg-5 col-sm-5">
<!-- <div class="search">  
<input type="text" name="search" value="" placeholder="Search a Product" class="input-txt"/>
<input type="button" value="Search" class="input-submit"/> -->
<?php echo $search; ?>
<!-- </div> -->
</div>
<div class="col-sm-4 col-lg-4 col-xs-12 col-md-4">
<div class="profile">
<ul>
  <li><?php echo $currency; ?>
    <?php echo $language; ?></li>
<?php if ($logged) { ?>
            <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
            <!-- <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li> -->
            <!-- <li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
            <li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li> -->
            <li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
            <?php } else { ?>
            <!-- <li><a href="<?php //echo $register; ?>"><?php //echo $text_register; ?></a></li> -->
            <li><a href="<?php echo $login; ?>"><?php echo $text_login; ?></a></li>
            <?php } ?>
<li><a href="<?php echo $wishlist; ?>" id="wishlist-total" title="<?php echo $text_wishlist; ?>"><i class="fa fa-heart"></i> <span class="hidden-xs hidden-sm hidden-md">Wish<?php //echo $text_wishlist; ?></span></a></li>
<li><?php echo $cart; ?></li>


</ul>


</div>
</div>
</div>
</div>
</section>
<!--mobile navigation start-->

<section class="mobile_nav">
<?php if ($categories) { ?>  
<div class="bg_black"></div>
<div class="navgation_1">
<ul>
 <?php foreach ($categories as $category) { ?> 
<?php if ($category['children']) { ?>
<li><a href="#"><?php echo $category['name']; ?><span></span> </a>
  <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $childrens) { ?>
<ul>
<?php 
foreach ($childrens as $child) { ?>
                <li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
                <?php } ?>

</ul>
<?php } ?>
</li>
<?php } else { ?>
        <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
        <?php } ?>


<?php } ?>
<!-- <li><a href="#">Category 1 <span></span> </a></li>
<li><a href="#">Category 1 <span></span> </a></li>
<li><a href="#">Category 1 <span></span> </a></li>
<li><a href="#">Category 1 <span></span> </a></li> -->
</ul>
</div>

<?php } ?>
</section>
<!--mobile navigation end-->

<section class="header-midd">
<div class="container">
<?php if ($categories) { ?>  
<div class="row">
<div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
<div class="navigation">
<ul>
<?php foreach ($categories as $category) { ?>
        <?php if ($category['children']) { ?>
<li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
<div class="submenu">
<div class="submenu_partq">
<!-- <div><a href="<?php //echo $category['href']; ?>"><?php //echo $text_all; ?> <?php //echo $category['name']; ?></a></div> -->
<?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
 <div class="col-lg-6 col-sm-6 col-md-6">
<ul type="disc">
<?php 

foreach ($children as $child) { ?>
                <li><a href="<?php echo $child['href']; ?>"> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <?php echo $child['name']; ?></a></li>
                <?php } ?>

</ul>
</div>
<?php } ?>
</div>
</div>
</li>
<?php } else { ?>
        <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
        <?php } ?>
        <?php } ?>

</ul>
</div>
</div>
</div>

<?php }  ?>

</div>
</section>

</header><div class="clearfix"></div>
<!---header End-->