<?php

<<<<<<< HEAD
$errorMSG = "";

// NAME
if (empty($_POST["name"])) {
    $errorMSG = "Name is required ";
} else {
    $name = $_POST["name"];
}
=======
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
>>>>>>> a0eb69d2fb3f734b18d473f967f09ec2647dcb11

// EMAIL
if (empty($_POST["email"])) {
    $errorMSG .= "Email is required ";
} else {
    $email = $_POST["email"];
}

// MSG SUBJECT
if (empty($_POST["msg_subject"])) {
    $errorMSG .= "Subject is required ";
} else {
    $msg_subject = $_POST["msg_subject"];
}


// MESSAGE
if (empty($_POST["message"])) {
    $errorMSG .= "Message is required ";
} else {
    $message = $_POST["message"];
}


$EmailTo = "byron@byronmardas.com";
$Subject = "Website Email";

// prepare email body text
$Body = "";
$Body .= "Name: ";
$Body .= $name;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $email;
$Body .= "\n";
$Body .= "Subject: ";
$Body .= $msg_subject;
$Body .= "\n";
$Body .= "Message: ";
$Body .= $message;
$Body .= "\n";

// send email
$success = mail($EmailTo, $Subject, $Body, "From:".$email);

// redirect to success page
if ($success && $errorMSG == ""){
   echo "success";
}else{
    if($errorMSG == ""){
        echo "Something went wrong :(";
    } else {
        echo $errorMSG;
    }
}

?>
