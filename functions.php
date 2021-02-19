<?php
//connection to db
 $dbhost = 'localhost'; 
 $dbname = 'myapp'; 
 $dbuser = 'root'; 
 $dbpass = ''; 
 $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
 if ($connection->connect_error) die("Fatal Error");


function createTable($name, $query)  // Checks whether a table already exists and, if not, creates it
{
  queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
  echo "Table '$name' created or already exists.<br>";
}


function queryMysql($query)  //Issues a query to MySQL, outputting an error message if it fails
{
  global $connection;
  $result = $connection->query($query);
  if (!$result) die("Fatal Error");
  return $result;
}


function destroySession() //Destroys a PHP session and clears its data to log users out
{
  $_SESSION=array();
  if (session_id() != "" || isset($_COOKIE[session_name()]))
  setcookie(session_name(), '', time()-2592000, '/');
  session_destroy();
}


function sanitizeString($var)  //Removes potentially malicious code or tags from user input
{
  global $connection;
  $var = strip_tags($var);
  $var = htmlentities($var);
  $var = stripslashes($var);
  return $connection->real_escape_string($var);
}


function showProfile($user) //Displays the user’s image and “about me” message if they have one
{
  if (file_exists("$user.jpg"))
    echo "<img src='$user.jpg' style='float:left;'>";

  $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");
  if ($result->num_rows)
  {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo stripslashes($row['text']) . "<br style='clear:left;'><br>";
  }
  else echo "<p>Nothing to see here, yet</p><br>";
  }


