<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    
    <title>Document</title>
</head>
<body>

<?php

    $pass = password_hash("admin",PASSWORD_DEFAULT,['cost'=>12]);
    echo $pass; #hello los comentarios se aumentan
    echo "<br>";
    $pass1 = password_verify("admin",$pass);
    var_dump($pass1);

?>
    
</body>
</html>