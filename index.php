<?php
    $my_var1 = "Hallo, Papa!";
    echo $my_var1;

    class Robin {
      function __toString () {
        return "Was sagt Ernie?";
      }
    }

    $my_robin = new Robin;
    echo "<p>$my_robin</p>"
?>