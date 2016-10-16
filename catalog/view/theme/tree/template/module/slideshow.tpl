<section class="slider_swipper">
<div class="swiper-container">
        <div class="swiper-wrapper">
          <?php foreach ($banners as $banner) { ?>
            <div class="swiper-slide">              
              <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" /></a>              
            </div>
         <?php } ?>
            
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        paginationClickable: true,
        centeredSlides: true,
        autoplay: 3000,
        autoplayDisableOnInteraction:false,
    loop: true
    });
  
    </script>
    </div>
</section>