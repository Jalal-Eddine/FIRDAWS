<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,400i|Nunito:300,300i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Bebas+Neue|Nanum+Gothic&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="<?php echo url_for('/css/style.css'); ?>">
        <link rel="shortcut icon" type="image/png" href="<?php echo url_for('/img/favicon.pngs'); ?>">
        <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
        
        <title>nexter &mdash; your home, your freedom<?php if(isset($page_title)) { echo '- ' . h($page_title); } ?><?php if(isset($preview) && $preview) { echo ' [PREVIEW]'; } ?></title>
    </head>
<!-- 
//?##############################
//?########### Navigation #######
//?##############################
 -->

<?php
  // Default values to prevent errors
  $page_id = $page_id ?? '';
  $subject_id = $subject_id ?? '';
  $visible = $visible ?? true;
?>
<!-- 
         //?######################
        //?###### SIDEBAR  ######
        //?###################### 
      -->


        <body class="<?php if (isset($page)){ echo 'blog-grid';}else{echo 'container';} ?>">
        <div class="<?php if (isset($page)){ echo 'sidebar';}else{echo 'sidebar';} ?>">
            <!-- <button class="nav-btn"></button> -->
            <?php $nav_subjects = find_all_subjects(['visible' => $visible]); ?>
          <ul class="navigation">
            <?php while($nav_subject = mysqli_fetch_assoc($nav_subjects)) { ?>
              <?php // if(!$nav_subject['visible']) { continue; } ?>
              <li class="<?php if($nav_subject['id'] == $subject_id) { echo 'selected'; } ?>">
                <a class="navigation__link" href="<?php echo url_for('index.php?subject_id=' . h(u($nav_subject['id']))); ?>">
                  <?php echo h($nav_subject['menu_name']); ?>
                </a>

                <?php if($nav_subject['id'] == $subject_id) { ?>
                  <?php $nav_pages = find_pages_by_subject_id($nav_subject['id'], ['visible' => $visible]); ?>
                  <ul class="pages">
                    <?php while($nav_page = mysqli_fetch_assoc($nav_pages)) { ?>
                      <?php // if(!$nav_page['visible']) { continue; } ?>
                      <li class="<?php if($nav_page['id'] == $page_id) { echo 'selected'; } ?>">
                        <a class="navigation__link" href="<?php echo url_for('index.php?id=' . h(u($nav_page['id']))); ?>">
                          <?php echo h($nav_page['menu_name']); ?>
                        </a>
                      </li>
                    <?php } // while $nav_pages ?>
                  </ul>
                  <?php mysqli_free_result($nav_pages); ?>
                <?php } // if($nav_subject['id'] == $subject_id) ?>

              </li>
            <?php } // while $nav_subjects ?>
          </ul>
          <?php mysqli_free_result($nav_subjects); ?>
          
        </div>
        <header class="header">
            <img src="<?php echo url_for('/img/firdaws-2.png'); ?>" alt="Firdaws logo" class="header__logo">
            <h3 class="heading-3">Firdaws:</h3>
            <h1 class="heading-1">Sharing is Caring</h1>
            <button class="btn header__btn">View Our Courses</button>
            <div class="header__seenon-text">Seen on</div>
            <div class="header__seenon-logos">
                <img src="<?php echo url_for('/img/icon-2.png'); ?>" alt="Seen on logo 1">
                <img src="<?php echo url_for('img/icon.png'); ?>" alt="Seen on logo 2">
                <img src="<?php echo url_for('img/icon-3.png'); ?>" alt="Seen on logo 3">
                <img src="<?php echo url_for('img/icon-2.png'); ?>" alt="Seen on logo 4">
            </div>
        </header>
        <div class="about">
            <h3 class="heading-3">About the website</h3>
            <div class="about__text">
                <p>Hello, Firdaws is a website where I share what I learned. Mainly about web development, graphic design, and maybe, if God's willing, electronics</p>
            </div>
            <div class="about__list">
                <img src="img/me-large.jpg" alt="Realtor 1" class="about__img">
                <div class="about__details">
                    <h4 class="heading-4 heading-4--light">Jalal-Eddine</h4>
                    <div class="about__list--contact">
                            <a href="https://twitter.com/HabbaziJalal" target="_blank">
                                <ion-icon name="logo-twitter"></ion-icon>
                            </a>
                            <a href="https://www.linkedin.com/in/jalal-eddine-el-habbazi-74b816192/" target="_blank">
                                <ion-icon name="logo-linkedin"></ion-icon>
                            </a>
                            <a href="https://codepen.io/jalal-eddine" target="_blank">
                                <ion-icon name="logo-codepen"></ion-icon>
                            </a>
                            <a href="https://github.com/Jalal-Eddine" target="_blank">
                                <ion-icon name="logo-github"></ion-icon>
                            </a>
                        </div>
                    <p class="about__sold">Web Engineering, Student</p>
                </div>
            </div>
        </div>

