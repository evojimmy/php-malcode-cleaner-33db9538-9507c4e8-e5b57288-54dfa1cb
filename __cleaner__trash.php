<?php

function iterate_directory ($dir) {
  foreach (glob($dir.'/*') as $abs_path) {
    //echo "DEBUG: ".$abs_path."<br />";
    if (is_dir($abs_path)) {
      iterate_directory($abs_path);
    }
    if (preg_match('/\.cleaner__backup$/', $abs_path)) {
      unlink($abs_path);
      echo "Deleted ".$abs_path."<br />";
    }
  }
}

iterate_directory('.');
?>
