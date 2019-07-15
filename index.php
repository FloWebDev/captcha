<?php

session_start();

if(!empty($_POST['captcha'])) {

    if(intval($_POST['captcha']) === $_SESSION['captcha']) {
        echo 'Captcha valide !';
    } else {
        echo 'Captcha invalide...';
    }
}

?>

<form action="" method="POST">
    <img src="captcha.php" alt="">
    <input type="text" name="captcha">
    <input type="submit" >
</form>