  <?php
/* start output buffering */
ob_start();

/* connect to database */
$handle = mysql_pconnect('localhost', 'cag', 'cag103');

/* check for connection */
if(!$handle) { return; }

/* select database */
mysql_select_db('creativeartsguide', $handle);

/* create query to check for e-mail already in database */
$query = sprintf("SELECT id FROM newsletter WHERE email='%s'",
  mysql_real_escape_string($_POST['email']));
$result = mysql_query($query);

/* check for result rows */
if(! mysql_num_rows($result) > 0) {

  /* create autocode */
  $authcode = md5($_POST['email'].time());

  /* create query to insert new user info */
  $query = sprintf("INSERT INTO newsletter (firstName, lastName, email, authcode, browser) VALUES ('%s', '%s', '%s', '%s', '%s')",
    mysql_real_escape_string($_POST['firstname']),
    mysql_real_escape_string($_POST['lastname']),
    mysql_real_escape_string($_POST['email']),
    mysql_real_escape_string($authcode),
    mysql_real_escape_string($_SERVER['HTTP_USER_AGENT']));
  $result = mysql_query($query);

  /* compose verification e-mail */
  $to      = $_POST['email'];
  $subject = 'Creative Arts Guide Newsletter';
  $message = 'This is a confirmation that you have signed up for the Creative Arts Guide Newsletter. If this is correct, please follow this link to verify your e-mail address: ';
  $message .= 'http://creativeartsguide.com/form/verify.php?authcode='.$authcode."\r\n\r\n".'If you feel you have received this request in error, please follow this link to remove you information from our database: ';
  $message .= 'http://creativeartsguide.com/form/remove.php?authcode='.$authcode;
  $headers = 'From: no-reply@creativeartsguide.com' . "\r\n" .
             'X-Mailer: PHP/' . phpversion();

  /* send verification e-mail */
  $return = mail($to, $subject, $message, $headers);

}

/* clean (flush) the output buffer */
ob_end_clean();

/* for IE, send to success page */
header('Location: /newsletter-submit.html');
?>