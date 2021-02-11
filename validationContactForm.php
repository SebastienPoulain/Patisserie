<?php

$email = $nom = $sujet = $mess = "";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (!empty($_POST["em1"]) && !empty($_POST["nm1"]) && !empty($_POST["sub1"]) && !empty($_POST["com1"]) && filter_var($_POST["em1"], FILTER_VALIDATE_EMAIL)) {
    $email = test_input($_POST["em1"]);
    $nom = test_input($_POST["nm1"]);
    $sujet = test_input($_POST["sub1"]);
    $mess = test_input($_POST["com1"]);

    $to = "delicesetmerveilles@cweb12.expertiseweb.ca";
    $headers = "MIME-Version: 1.0" . "\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\n";
    $headers .= 'From: ' . $email;
    $message = '<table width="100%" border="1" cellspacing="1" cellpadding="2">
<tr><td style="text-align:center;" colspan="2"> ' . $nom . " vous a contacté sur votre site" . '</td></tr>
<tr><td style="text-align:center;" width="20%">Sujet</td><td  width="80%">' . $sujet . '</td></tr>
<tr><td style="text-align:center;" width="20%">Message</td><td  width="20%">' . $mess . '</td></tr>
</table>';
    if (@mail($to, $sujet, $message, $headers));
    echo 'Email envoyé avec succès';
} else
    echo 'Envoie impossible, veuillez réessayer';
