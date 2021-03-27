<?php
    $my_var1 = "Hallo, Papa!";
    echo $my_var1;

    class Robin extends Papa {

      function __construct () {
        echo "<p>Robin!</p>";
        parent::__construct();
      }

      function __toString () {
        return "Was sagt Ernie?";
      }
    }

    class Papa {
      function __construct () {
        echo "<p>Papa!</p>";
      }
    }

    $my_robin = new Robin();
    echo "<p>$my_robin</p>"
?>