<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Demo</title>
</head>
<body>
    <?php 
        $name = "Dark Matter";
        $read = true;
        if ($read) {
            $message = "You have read $name";
        }
        else {
            $message = "You havn't read $name.";
        }
    ?>
    <h1>
        <?php echo $message?>
    </h1>
</body>
</html>