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

  // encodes the url for the query string 
  function u($string="") {
    return urlencode($string);
  }

  // raw encodes the url for the query string
  function raw_u($string="") {
    return rawurlencode($string);
  }

  // quick function for htmlspecialchars()
  function h($string="") {
    return htmlspecialchars($string);
  }

?>