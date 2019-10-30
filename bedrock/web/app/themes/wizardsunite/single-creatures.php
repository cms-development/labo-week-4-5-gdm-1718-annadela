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
                  <h2>Beschrijving</h2>
                  <p><?php echo get_the_content() ?></p> 
                  <h2>Details</h2>
                  <p><b>Xp: </b><?php echo get_field("xp"); ?></p>
                  <p><b>Spell: </b><?php echo get_field("spell"); ?></p>
                  <p><b>Confoundable : </b><?php echo get_field("confoundable"); ?></p>
                  <?php if( get_field('image') ): ?>
                            <img src="<?php the_field('image'); ?>" alt="<?php the_title() ?>" />
                        <?php endif; ?>
                  

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
