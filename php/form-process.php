<?php

$errorMSG = "";

// NAME
if (empty($_POST["name"])) {
    $errorMSG = "Name is required ";
} else {
    $name = $_POST["name"];
}

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


$EmailTo = "byron@byronmardas.com","byrwn_mar@hotmail.com";
// $Subject = "Website Email";

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

$headers = "From: webmaster@example.com " . "\r\n";



// send email
mail($EmailTo, $msg_subject, $Body, $headers);
if($errorMSG == ""){
  mail($EmailTo, $msg_subject, $Body, $headers);
  echo "Thank you" + $name;
}else{
  echo $errorMSG;
}


// redirect to success page
if (mail($EmailTo, $msg_subject, $Body, $headers)){
   echo "Thank you" + $name;
}else{
    if($errorMSG == ""){
        echo "Something went wrong :(";
    } else {
        echo $errorMSG;
    }
}

?>
