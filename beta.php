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

   /* $pass = password_hash("admin",PASSWORD_DEFAULT,['cost'=>12]);
    echo $pass; #hello los comentarios se aumentan
    echo "<br>";
    $pass1 = password_verify("admin",$pass);
    var_dump($pass1);*/

    for ($i=12; $i < 298; $i++) { 
        //$pass = password_hash("admin",PASSWORD_DEFAULT,['cost'=>12]);
        //echo $pass;
        //echo "<br>";
        //$cod = substr($pass,15,4);
        //echo $cod;
        //echo "<br>";
        $x = rand(15,40);
        $y = rand(1,90);
        $w = rand(1,2);
        $z = rand(23,45);
        $r = $w+$z;
        $qw = $i+503;
        //if($i%10 == 0){
            echo "insert into detalleVenta values($qw,$y,$w,$r,0);";
        echo "<br>";
        //}else{
            //echo "insert into venta values($w,$y,'FACTURA','FTVI-$i','N°00000$i',16-06-20,0.18,$z,'COMPLETADO');";
        //echo "<br>";
        //}
    }

?>
    
</body>
</html>