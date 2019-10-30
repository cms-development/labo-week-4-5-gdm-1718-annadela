<?php
/* Template Name: SidebarFanclub */

get_header();
?>



<div class="main-wrapper">
        <!-- page content -->
        <div class="container">

            <!-- cards level 1-->
            <div class="row">
                <!-- card 1.1 -->
                <div class="col-12 col-md-3">
                        <h2>Sidebar</h2>
                        <?php dynamic_sidebar('Primary Sidebar'); ?>
                    </div>
                <div class="col-12 col-md-9">
                   <h2>Content</h2> 
                   <?php
                      if (have_posts() ):
                        while ( have_posts() ) : the_post();
                        ?>
                          <p><?php the_content()?></p>
                        <?php
                        endwhile;
                      endif;
                    ?>

                </div>
                

            </div>
             <!-- end row-->

        </div>
        <!-- end container-->
    </div>
<?php
get_footer();