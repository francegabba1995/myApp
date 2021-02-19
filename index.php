<?php
 session_start();
 require_once 'header.php';
 echo "<div class='center'>Welcome to myApp,";
 if ($loggedin) echo " $user, you are logged in";
 else echo ' please sign up or log in';
 echo
 
<<<_END
  </div><br>
  </div>
  <div data-role="footer">
  <h4> Made with <span id="heart"> ❤ </span> by <a href="https://francegabba1995.github.io/"> Francesco Gabbanini </a></h4>
  </div>
  </body>
  </html>
_END;
?>
