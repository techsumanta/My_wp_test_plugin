<?php
// Template Name: Why Us

get_header('template');
?>

<!-- why section -->

<section class="why_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Why Choose <span>Us</span>
        </h2>
      </div>
      <div class="why_container">
        <?php
          // To get news category

          $newsCat = get_terms(
            array(
              'taxonomy' => 'news-category',
              'hide_empty' => false,
              'orderby' => 'name',
              'order' => 'asc',
              'number' => 5,
              'parent' => 0
              )
          );

          // echo "<pre>";
          // print_r($newsCat);
          // echo "</pre>";

          foreach($newsCat as $ncat) {
            ?>
              <p>
                <a href="<?php echo get_category_link($ncat->term_id); ?>"><?php echo $ncat->name; ?></a>
                <img src="<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url($ncat->term_id); ?>" alt="">
              </p>
            <?php            
            // Display posts by Category

            $wpnews = array(
              'post_type' => 'news',
              'post_status' => 'publish',
              'tax_query' => array(
                  array(
                      'taxonomy' => 'news-category',
                      'field' => 'term_id',
                      'terms' => $ncat->term_id
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
                    <?php the_field('news_date', get_the_id()); ?>
                  </p>
                  <p>
                    <?php the_excerpt(); ?>
                  </p>
                </div>
              </div>
        <?php
            }

            //End Display posts by Category
          
          }
        

        // To get all news post

          $wpnews = array(
            'post_type' => 'news',
            'post_status' => 'publish'
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
      <div class="btn-box">
        <a href="">
          Read More
        </a>
      </div>
    </div>
  </section>

  <!-- end why section -->

  <!-- info section -->

  <section class="info_section layout_padding2">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-3 info_col">
          <div class="info_contact">
            <h4>
              Address
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Location
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call +01 1234567890
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  demo@gmail.com
                </span>
              </a>
            </div>
          </div>
          <div class="info_social">
            <a href="">
              <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-linkedin" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 info_col">
          <div class="info_detail">
            <h4>
              Info
            </h4>
            <p>
              necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-2 mx-auto info_col">
          <div class="info_link_box">
            <h4>
              Links
            </h4>
            <div class="info_links">
              <a class="active" href="index.html">
                Home
              </a>
              <a class="" href="about.html">
                About
              </a>
              <a class="" href="service.html">
                Services
              </a>
              <a class="" href="why.html">
                Why Us
              </a>
              <a class="" href="team.html">
                Team
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 info_col ">
          <h4>
            Subscribe
          </h4>
          <form action="#">
            <input type="text" placeholder="Enter email" />
            <button type="submit">
              Subscribe
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- end info section -->

<?php
get_footer();
?>