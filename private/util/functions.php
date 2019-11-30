<?php
//**function that take a path and add it to the root element (public/) */

function url_for($script_path) {
  // add the leading '/' if not present
  if($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

//**urlencode: to encode the post request :the query string (part after '?') */
//*urlencode: space are encoded as "+" 

function u($string="") {
  return urlencode($string);
}

//**rawurlencode: to encode the post request :the path (part before the '?') */
//*rawurlencode: space are encoded as "%20" 

function raw_u($string="") {
  return rawurlencode($string);
}

//**htmlspecialchars: In order to encode the HTML code */
//*convert the reserved characters in HTML 

function h($string="") {
  return htmlspecialchars($string);
}

//**Handling the error_404 page not finded */

function error_404() {
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  exit();
}

//**500 Internal Server Error */

function error_500() {
  header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
  exit();
}

//**Redirect to the location: the specified path as location */

function redirect_to($location) {
  header("Location: " . $location);
  exit;
}

//**Return the request as POST */

function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

//**Return the request as GET */

function is_get_request() {
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}

//* |--------------------------------------------------------------------------
//! | display_errors
//* |--------------------------------------------------------------------------
// *|take an arrray of errors as argument and return a secure and 
// *|redeable expression
// *|htmlspecialshart was used because the return is 'div' bloc 
// *|so the inside shouldn't be HTML

function display_errors($errors=array()) {
  $output = '';
  if(!empty($errors)) {
    $output .= "<div class=\"errors\">";
    $output .= "Please fix the following errors:";
    $output .= "<ul>";
    foreach($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  }
  return $output;
}

//* |--------------------------------------------------------------------------
//! | get_and_clear_session_message
//* |--------------------------------------------------------------------------
// *|take a session message and unset it (détruit le variable)
// *|
function get_and_clear_session_message() {
  if(isset($_SESSION['message']) && $_SESSION['message'] != '') {
    $msg = $_SESSION['message'];
    unset($_SESSION['message']);
    return $msg;
  }
}

//* |--------------------------------------------------------------------------
//! | display_session_message
//* |--------------------------------------------------------------------------
// *|if the message is not empty return the session message inside html bloc  
// *|is_blank is function defined in validation_functions.php which is better than empty
// *|empty considers '0' to be empty
function display_session_message() {
  $msg = get_and_clear_session_message();
  if(!is_blank($msg)) {
    return '<div id="message">' . h($msg) . '</div>';
  }
}

?>
