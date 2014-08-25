<?php
 header('Content-type: text/css');
 $interval = 2595000;
$now = time();
$pretty_lmtime = gmdate('D, d M Y H:i:s', $now) . ' GMT';
$pretty_extime = gmdate('D, d M Y H:i:s', $now + $interval) . ' GMT';
// Backwards Compatibility for HTTP/1.0 clients
header("Last Modified: $pretty_lmtime");
header("Expires: $pretty_extime");
// HTTP/1.1 support
header("Cache-Control: public,max-age=$interval"); 
  ob_start("compress");
  function compress($buffer) {
    /* remove comments */
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    /* remove tabs, spaces, newlines, etc. */
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    return $buffer;
  }
  /* your css files */
include('css/reset.css');
include('style.css');
ob_end_flush();
?>
