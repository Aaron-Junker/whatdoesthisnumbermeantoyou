<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What does this number mean to you?</title>
</head>
<body>
    <p>What does this number mean to you?</p>
    <?php
    $number = random_int(1, 100);
    setcookie('number', $number, time() - 3600);
    ?>
    <p><?php echo $number; ?></p>
</body>
</html>