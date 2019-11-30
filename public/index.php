<!-- 
//? #####################################
//? ###   Define the Home page layouts ##
//? #####################################
-->
<?php require_once('../private/initialize.php'); ?>

<?php

$preview = false;
if(isset($_GET['preview'])) {
  // previewing should require admin to be logged in
  $preview = $_GET['preview'] == 'true' && is_logged_in() ? true : false;
}
$visible = !$preview;

if(isset($_GET['id'])) {
  $page_id = $_GET['id'];
  $page = find_page_by_id($page_id, ['visible' => $visible]);
  if(!$page) {
    redirect_to(url_for('/index.php'));
  }
  $subject_id = $page['subject_id'];
  $subject = find_subject_by_id($subject_id, ['visible' => $visible]);
  if(!$subject) {
    redirect_to(url_for('/index.php'));
  }

} elseif(isset($_GET['subject_id'])) {
  $subject_id = $_GET['subject_id'];
  $subject = find_subject_by_id($subject_id, ['visible' => $visible]);
  if(!$subject) {
    redirect_to(url_for('/index.php'));
  }
  $page_set = find_pages_by_subject_id($subject_id, ['visible' => $visible]);
  $page = mysqli_fetch_assoc($page_set); // first page
  mysqli_free_result($page_set);
  if(!$page) {
    redirect_to(url_for('/index.php'));
  }
  $page_id = $page['id'];
} else {
  // nothing selected; show the homepage
}

?> 

<?php include(SHARED_PATH . '/public_header.php'); ?>

<!-- 
//? ##############################
//? ###   Dynamic content    #####
//? ############################## 
-->
    <?php
      if(isset($page)) {
        
        // show the page from the database
        $allowed_tags = '<div><img><h1><h2><h3><h4><h5><h6><p><svg><use><button><section><figure><br><strong><em><ul><li>';
        echo strip_tags($page['content'], $allowed_tags);
        
      } else {
        // Show the homepage
        // The homepage content could:
        // * be static content (here or in a shared file)
        // * show the first page from the nav
        // * be in the database but add code to hide in the nav
        include(SHARED_PATH . '/pages/static_homepage.php');
      }
    ?>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
