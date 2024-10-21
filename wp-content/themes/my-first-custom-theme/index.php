<?php
get_header('template');
wp_head();
?>

<!-- blog section -->

<section class="why_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Current Posts calling index page
        </h2>
      </div>
      <div class="why_container">
        <?php
            while(have_posts()) {
                the_post();
                
                $imgPath = wp_get_attachment_image_src(get_post_thumbnail_id());
        ?>
        <div class="box">
          <div class="img-box">
            <img src="<?php echo $imgPath[0]; ?>" alt="">
          </div>
          <div class="detail-box">
            <h5>
              <?php the_title(); ?>
            </h5>
            <p><?php echo get_the_date(); ?></p>
            <p>
              <?php the_excerpt(); ?>
            </p>
            <a href="<?php the_permalink(); ?>">Read more...</a>
          </div>
        </div>
        <?php
         }
        ?>
    </div>
    <div>
        <?php echo wp_pagenavi(); ?>
    </div>
  </section>

  <!-- end blog section -->

<?php
wp_footer();
get_footer();
?>