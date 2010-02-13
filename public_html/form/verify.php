<?php
// cag:cag103@localhost
$handle = mysql_pconnect('localhost', 'cag', 'cag103');
if(!$handle) {
  return '';
}

mysql_select_db('creativeartsguide', $handle);
$query = sprintf("SELECT id FROM newsletter WHERE authcode='%s'",
  mysql_real_escape_string($_GET['authcode']));

$result = mysql_query($query);

if (!$result) { return; }

if(mysql_num_rows($result) == 1) { 
  
  $query = sprintf("UPDATE newsletter SET authcode='%s' WHERE authcode='%s' LIMIT 1",
    '',
    mysql_real_escape_string($_GET['authcode']));
  $result = mysql_query($query);
  
  header("Location: /newsletter-verify.html");
}

?>