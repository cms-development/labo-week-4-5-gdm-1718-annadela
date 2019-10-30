<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <?php echo get_bloginfo('name') . ' ' . get_the_title() ?></title>
    <link rel="stylesheet" href="main.css">
    <?php wp_head() ?>
</head>

<body>

 <header class="header-wrapper">
        <a href="" class="logo"></a>
        <?php
          if ( function_exists( 'the_custom_logo' ) ) {
          the_custom_logo();
          }
          ?>
        </a>
    
      <!-- navigatie -->
      <div class="container header_container">
          <div class="row">
              <div class="col-12 col-md-6">
                <h1 class="logo"><?php the_title(); ?></h1>
                  <!-- <h1 class="logo">Wizards Unite Fanpage</h1> -->
              </div>
              
              <div class="col-12 col-md-6 nav">
                  <nav class="nav-main">
                      <ul class="navbar-right">
                      <li class="page_item"><?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) );?></li>
                          <!-- <li class="page_item"><a class="nav-item__link active" href="index.html" title="Fans">De Fanclub</a></li>
                          <li class="page_item"><a class="nav-item__link" href="creatures.html" title="Creatures">Magical Creatures</a></li>
                          <li class="page_item"><a class="nav-item__link" href="wordfan.html" title="Contact">Word fan!</a></li> -->
                      </ul>
                  </nav>
              </div>
          </div>
      </div>
  </header>