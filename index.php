<?php
    const CONFIG = "";
    include_once("conf.inc.php");
    if(isset($_COOKIE['number'])) {
        $number = $_COOKIE['number'];
    }else{
        $number = random_int(1, 100);
        setcookie('number', $number, time()+86400);
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What does this number mean to you?</title>
    <style>
        /*Center body content*/
        body {
            margin: 0 auto;
            width: 50%;
            text-align: center;
            font-family: sans-serif;    
        }
    </style>
</head>
<body>
    <h1>What does this number mean to you?</h1>
    <h2><?php echo $number; ?></h2>
    <p>Write a short story or whatever comes to your mind with this number.</p>
    <p>It has to contain this number</p>
    <form action="send.php">
        <textarea required type="text" name="story"></textarea><br />
        <input type="submit"></input>
    </form>
</body>
</html>