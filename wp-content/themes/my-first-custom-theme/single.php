<?php
get_header('template');
the_post();
?>

<section class="why_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Current Posts
        </h2>
      </div>
      <div class="why_container">
        <?php       
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
            <p>Created By: <?php echo get_the_author(); ?></p>          
            <p>
              <?php the_content(); ?>
            </p>
            <p>
                <?php comments_template(); ?>
            </p>
          </div>
        </div>        
    </div>
    
  </section>
 
<?php
get_footer();
?>