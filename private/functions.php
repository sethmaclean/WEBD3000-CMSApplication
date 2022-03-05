<?php

// if the leading slash is missing, it adds it in for you.
// then, appends it to WWW_ROOT.
function url_for($script_path) {
    // add the leading '/' if not present
    if($script_path[0] != '/') {
      $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
  }

  // shorthand function for urlEncode()
  function u($string="") {
    return urlencode($string);
  }

  // shorthand function for htmlspecialchars()
  function h($string="") {
    return htmlspecialchars($string);
  }

  // function to return the current URL
  function redirect_to($location) {
    header("Location: " . $location);
    exit;
  }

  // shorthand function to identify post calls
  function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
  }

  // display errors in an unordered list
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
    
?>