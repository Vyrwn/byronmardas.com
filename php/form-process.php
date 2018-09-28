<?php
error_reporting(-1);

if(isset($_POST['submit']))
{
$name = $_POST['name'];
$submit_links = $_POST['submit_links'];
$from_add = "submit@webdesignrepo.com";
$to_add = "ben@webdesignrepo.com";
$subject = "Your Subject Name";
$message = "Name:$name \n Sites: $submit_links";

$headers = 'From: submit@webdesignrepo.com' . "\r\n" .

'Reply-To: ben@webdesignrepo.com' . "\r\n";

if(mail($to_add,$subject,$message,$headers))
{
    $msg = "Mail sent";

 echo $msg;
}

print "<p>Thanks $name</p>" ;
}

// else conditional statement for if(isset($_POST['submit']))
else {
echo "Sorry, you cannot do that from here. Please fill in the form first.";
}

?>
