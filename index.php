<?php
    const CONFIG = "";
    include_once("conf.inc.php");
    if(isset($_COOKIE['number'])) {
        $number = $_COOKIE['number'];
    }else{
        $number = random_int(100, 1000000);
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
        <?php
            if(isset($_GET["WARNING"])){
                echo <<<STYLE
                #warning{
                    color: red;
                    font-weight: bold;
                }
                STYLE;
            }
        ?>
    </style>
</head>
<body>
    <h1>What does this number mean to you?</h1>
    <?php
    if(isset($_COOKIE['submitted'])){
        echo "<p>You already wrote a story this day. Come in 24 hours again!</p>";
    }else{
     ?>   
    <h2><?php echo $number; ?></h2>
    <p>Write a short story or whatever comes to your mind with this number.</p>
    <p id="warning">It must contain the number provided.</p>
    <form action="send.php" method="post"><textarea required type="text" name="story"><?php
            if(isset($_GET["WARNING"])){
                echo $_GET["WARNING"];
            }
        ?></textarea><br />
        <input type="submit"></input>
    </form>
    <?php
    }
    ?>
    <p>I'm aware that it's possible to abuse this project, but hacking/abusing is not cool, so please just <a href="https://github.com/Aaron-Junker/whatdoesthisnumbermeantoyou">help improving this project.</a></p>
    <p>Please keep it save for work</p>
    <?php
    // Database connection
    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($db->connect_errno){
        echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
    }
    // Get all stories
    $result = $db->query("SELECT * FROM number ORDER BY id DESC");
    if($result->num_rows > 0){
        echo "<h2>Stories</h2>";
        while($row = $result->fetch_assoc()){
            echo "<h3>".$row["Number"]."</h3>";
            echo "<div>".$row["Text"]."</div>";
        }
    }
    ?>
    <p style="position:absolute; bottom:0;right:0;"><a href="https://blog.aaron-junker.ch/impressum/">Impressum</a></p>
</body>
</html>