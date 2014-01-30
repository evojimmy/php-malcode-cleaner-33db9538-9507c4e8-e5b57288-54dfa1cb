<?php

$logs = "==========================================<br/>";

function echo_log ($str) {
  global $logs;

  echo $str;
  $logs = $logs . $str;
}

function remove_injected_header ($filename) {
  echo_log("analyzing ".$filename."...");
  //$fh = fopen($filename, 'r');
  $fh_str = file_get_contents($filename);
  if (preg_match('/^<\?php \$[a-z]{10} = \'/', $fh_str)) {
    echo_log("INJECTED");
    if (preg_match('/^<\?php \$[a-z]{10} = \'(?:.*?)-1; \?>/', $fh_str)) {
      // We can determine the malcode-block and preserve good codes.
      $clean_str = preg_replace('/^<\?php \$[a-z]{10} = \'(?:.*?)-1; \?>/', '', $fh_str, 1); // limit once
      echo_log("&nbsp;&nbsp;&nbsp;&nbsp;we can clean it...");
    } else {
      // We cannot determine because of file corruption. Just empty the file.
      $clean_str = '<!-- File emptied by php_malcode_cleaner because of corruption. -->';
      echo_log("&nbsp;&nbsp;&nbsp;&nbsp;file corrupted, empty the file...");
    }
    rename($filename, $filename.".cleaner__backup"); // make a backup
    if (file_put_contents($filename, $clean_str)) {
      echo_log("done");
    } else {
      echo_log("failed");
    }
  } else {
    echo_log("all is well");
  }
  //fclose($fh);
  echo_log("<br />");
}

function iterate_directory ($dir) {
  foreach (glob($dir.'/*') as $abs_path) {
    //echo "DEBUG: ".$abs_path."<br />";
    if (is_dir($abs_path)) {
      iterate_directory($abs_path);
    }
    if (preg_match('/\.php$/', $abs_path)) {
      remove_injected_header($abs_path);
    }
  }
}

echo "Please see ./__cleaner__logs.html for saved_logs.<br />";
iterate_directory('.');
file_put_contents('./__cleaner__logs.html', $logs, 2); // 2: FILE_APPEND
?>
