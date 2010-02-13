<?php

$pass = $_GET['authtoken'];

if($pass !== 'jsuuaSjde322XDxssslkdEXSAZXSj43neslx') return;

/* connect to database */
$handle = mysql_pconnect('localhost', 'cag', 'cag103');

/* check for connection */
if(!$handle) { return; }

/* select database */
mysql_select_db('creativeartsguide', $handle);

/* create query to check for e-mail already in database */
$query = "SELECT firstName, lastName, email, authcode, browser FROM newsletter";
$result = mysql_query($query);

/* check for result rows */
if(mysql_num_rows($result) > 0) {

  echo '<table width="100%"><thead style="font-weight:bold"><tr><td>First Name</td><td>Last Name</td><td>E-Mail</td><td>Verified</td><td>Browser</td></tr></thead>';

  /* loop through results */
  while($row = mysql_fetch_assoc($result)) {
    
    if($row['authcode'] == "") {
      $verified = 'Yes';
    } else {
      $verified = 'No';
    }
    
    if($row['browser'] == "") {
      $browser = 'Unknown';
    } else {
      $browser = $row['browser'];
    }
    
    echo '<tr><td>'.$row['firstName'].'</td><td>'.$row['lastName'].'</td><td>'.$row['email'].'</td><td>'.$verified.'</td><td>'.$browser.'</td></tr>';
  }

  echo '</table>';

}
?>