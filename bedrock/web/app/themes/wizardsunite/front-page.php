<?php

get_header();

if (have_posts() ):
  while ( have_posts() ) : the_post();
  ?>
 
  <div class="main-wrapper">
      <!-- page content -->
      <div class="container">

          <!-- cards level 1-->
          <div class="row">
              <!-- card 1.1 -->
              <div class="col-12 col-md-9">
                  <h2>Content</h2> 
                  <p>
                      <?php echo get_the_content() ?>
                  </p>

              </div>
              <div class="col-12 col-md-3">
                  <h2>Sidebar</h2>
                  <p><a href="/word-fan">Word nu ook fan</a></p>
              </div>

          </div>
            <!-- end row-->

      </div>
      <!-- end container-->
  </div>
    <!-- end main-wrapper-->
  <?php

  endwhile;
endif;

get_footer()
?>
