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
