<?php

get_header();

  ?>
<div class="main-wrapper">
        <!-- page content -->
        <div class="container">

            <!-- cards level 1-->
            <div class="row cards">

                <div class="col-12">
                    <h2>Magical Creatures</h2>
                    <p>The following Foundables can be found in the Care of Magical Creatures category of the Registry in Harry Potter: Wizards Unite.</p>
                </div>
                <?php
                if (have_posts() ):
                while ( have_posts() ) : the_post();
                ?>
                <!-- card 1.1 -->
                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card_image_container">
                        <?php if( get_field('image') ): ?>
                            <img src="<?php the_field('image'); ?>" alt="<?php the_title() ?>" />
                        <?php endif; ?>
                        </div>
                        <div class="card_txt_container">
                            <h2><a href="/index.php/creatures/<?php the_title() ?>"><?php the_title() ?></a></h2>
                            <p>
                                   <?php the_content() ?>
                            </p>
                            <ul>
                                <li><strong>XP</strong> <?php echo get_field('xp') ?></li>
                                <li><strong>Spell</strong> <?php echo get_field('spell') ?></li>
                                <li><strong>Confoundable</strong> <?php echo get_field('confoundable') ?></li>
                            </ul>
                      
                        </div>
                    </div>
                     <!-- end card-->
                    

                </div>
                 <!-- end col-->
                 <?php
                       endwhile;
                    endif;
                    ?>
            </div>
             <!-- end row-->
             
        </div>
        <!-- end container-->
    </div>
     <!-- end main-wrapper-->
     <?php


get_footer()
?>




    