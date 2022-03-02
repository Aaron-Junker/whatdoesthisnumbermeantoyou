<?php
    const CONFIG = "";
    include_once("conf.inc.php");
    // Database connection
    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($db->connect_errno){
        echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
        die();
    }
    if(isset($_COOKIE['number'])){
        $number = $_COOKIE['number'];
    }else{
        header('Location: index.php');
        die();
    }
    if(isset($_COOKIE['number']) && isset($_COOKIE['submitted'])){
        echo "<p>You already wrote a story this day. Come in 24 hours again!</p>";
        die();
    }
    if(!str_contains($_POST["story"], $number)){
        header("Location: index.php?WARNING=" . urlencode($_POST["story"]));
        die();
    }
    // Save new story
    if(isset($_POST["story"])){
        $story = $_POST["story"];
        $result = $db->query("SELECT * FROM number WHERE number = '$number'");
        if(isset($_COOKIE['number']) && !isset($_COOKIE['submitted'])){
            unset($_COOKIE['submitted']); 
            setcookie('submitted', null, -1, '/'); 
        }

            $result = $db->query("INSERT INTO number (Number, Text) VALUES ('".$db->real_escape_string($number)."', '".$db->real_escape_string(htmlspecialchars($story))."')");
            if($result){
                setcookie('submitted', 'true', time()+86400, '/');
                echo "<p>Your story has been saved.</p>";
                
                echo "<a href='index.php'>Go back</a>";
            }else{
                echo "<p>Something went wrong.</p>";
            }
        
    }
