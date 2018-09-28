<?php
error_reporting(-1);

if(isset($_POST['submit']))
{
$name = $_POST['name'];
$submit_links = $_POST['submit_links'];
$from_add = "byron@byronmardas.com";
$to_add = "byron@byronmardas.com";
$subject = "Your Subject Name";
$message = "Name:$name \n Sites: $submit_links";

$headers = 'From: byron@byronmardas.com' . "\r\n" .

'Reply-To: byron@byronmardas.com' . "\r\n";

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
