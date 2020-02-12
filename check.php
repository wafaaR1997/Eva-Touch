<html>
<head>
    <link rel="icon" href="logocitymall.png" type="image/x-icon">

<style>
body
{

}
</style>

</head>
<body>
<div id="php">
<?php
extract($_POST);
 session_start();
if( empty($_SESSION['username'])&& empty($_SESSION['id'])){
header('Location:login.php');}
    else {
        $_SESSION["productid"]=$_POST['product'];
$_SESSION["qty"]=$_POST['qty'];
header('Location:insertcart.php');}

?>
</div>

</body>
</html>