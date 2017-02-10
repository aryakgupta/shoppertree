<footer>
  <div class="container">
    <div class="row">
      <?php if ($informations) { ?>
      <div class="col-sm-3">
        <h5><?php echo $text_information; ?></h5>
        <ul class="list-unstyled">
          <?php foreach ($informations as $information) { ?>
          <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
          <?php } ?>
        </ul>
      </div>
      <?php } ?>
      <div class="col-sm-3">
        <h5><?php echo $text_service; ?></h5>
        <ul class="list-unstyled">
          <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
          <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
          <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
        </ul>
      </div>
      
      <div class="col-sm-3">
        <h5><?php echo $text_account; ?></h5>
        <ul class="list-unstyled">
          <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
          <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
          <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
          <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
        </ul>
      </div>
    </div>
    
    <div>
<div class="container">
<div class="row w-paymetn-br">
<div class="col-md-6 col-xs-12 col-md-6 col-lg-6">
<div class="payment-option">
    <ul>
    <li>PAYMENT OPTION :</li>
    <li><img alt="payment" width="200" height="30" src="catalog/view/theme/tree/image/paypal_express_mobile.png"></li>
    </ul>
    </div>
</div>
<div class="col-xs-12 col-md-6 col-lg-6 col-sm-6">
<div class="msg-trendy pull-right">
    <ul>    
    <li><p><?php echo $powered; ?></p></li>
    </ul>
    </div></div>
</div>
</div><div class="clearfix"></div>
</div><div class="clearfix"></div>
    
  </div>
</footer>

<script type="text/javascript" src="<?php echo HTTP_SERVER ?>catalog/view/js/carousal.slide.js"></script>
    <script type="text/javascript">
      
      $( '#carousel' ).elastislide();
      $( '#carousel2' ).elastislide();
      $( '#carousel3' ).elastislide();
      
    </script>
</div>
</body>
</html>