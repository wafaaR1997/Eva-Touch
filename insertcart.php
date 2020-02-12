<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="logocitymall.png" type="image/x-icon">

<style>
body
{
background-image:url('m.jpg');
background-repeat:no-repeat;
background-size:cover;

background-attachment:fixed;
}</style>
</head>
<body>
<?php
    session_start();
    
$con=mysql_connect("localhost","root","");
mysql_select_db("eva_touch_db",$con);

    
    $productid=  $_SESSION["productid"];
    echo $productid;
extract($_POST);
    $f1="select * from    products where id='$productid' ";
$f2=mysql_query($f1,$con);
$row=mysql_fetch_row($f2);
    $itempic=$row[5];
    echo $itempic;
    $productname=$row[1];
    echo $productname;
    $unitprice=$row[10];
    echo $unitprice;
     $qty=$_SESSION["qty"];
    echo $qty;
    $total=$unitprice * $qty;
    echo $total;
    $username=$_SESSION["username"];
      $id="select * from    users where user_name='$username' or email='$username'";
$user=mysql_query($id,$con);
$userforid=mysql_fetch_row($user);
    $userid=$userforid[0];
    echo $userid;
             
$insert1="INSERT INTO  cart (
`itempic`,
 `productname`
,
 `unitprice`
,
 `qty`
,
 `total`
,
 `user_id`


)
VALUES (
'$itempic','$productname','$unitprice','$qty','$total','$userid'
)

";
        mysql_query($insert1,$con) or die(mysql_error());

    mysql_close($con);

header('Location:cart.php');

?>

</body>
</html>