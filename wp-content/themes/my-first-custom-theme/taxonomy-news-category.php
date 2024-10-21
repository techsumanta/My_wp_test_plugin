<?php
    get_header('template');
    wp_head();
    $catDetail = get_queried_object();
    // echo "<pre>";
    // print_r($catDetail);
    // echo "</pre>";
?>

<section class="why_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          <?php echo $catDetail->name; ?>
        </h2>
      </div>
      <div class="why_container">
        <?php
        $wpnews = array(
            'post_type' => 'news',
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'news-category',
                    'field' => 'term_id',
                    'terms' => $catDetail->term_id
                )                
            )
          );

          $newsquery = new Wp_Query($wpnews);
          while($newsquery->have_posts()) {
            $newsquery->the_post();
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
              <p>
                <?php echo get_the_date(); ?>
              </p>
              <p>
                <?php the_excerpt(); ?>
              </p>
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

<?php
    get_footer();
?>