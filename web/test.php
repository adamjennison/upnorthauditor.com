<?php

  // Copyright 2004 Joe Stump <joe@joestump.net>
  // Public Domain
  // Usage: php -q bitmask.php 1 4 32
  //        (any numeric argument will be evaluated - change to whatever)
  echo "Valid bitmask values (up to 16): n";

  for ($i = 1 ; $i < 16 ; ++$i) {
      echo "2 ^ $i = ".pow(2,$i)."n";
  
  }
  echo "nn";

  $bitmask = 0;
  $values = array();
  for ($i = 1 ; $i < count($argv) ; ++$i) {
      if (is_numeric($argv[$i])) {
          $bitmask += $argv[$i];
          $values[] = $argv[$i];
      }
  }

  echo "Bitmask Contains: ".implode(', ',$values)."n";
  echo "Bitmask Total: ".$bitmask."n";

  echo "nResults:n";
  $arr = array(1,2,4,8,16,32);
  for ($i = 0 ; $i < count($arr) ; ++$i) {
      echo $arr[$i].': '.((($bitmask & $arr[$i]) == 0) ? 'FALSE' : 'TRUE')."n";
      
  }

?>
