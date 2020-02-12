<?php

require "includes/includes.php";
 
 
if (!$auth->is_auth()) {
    redirect('login.php', 1);
}

// get the user information . no objects :( .
$user_info = $db->getRow("SELECT * FROM users WHERE id= {$_SESSION['id']} ");

//get user products
$user_products = $db->getRows("SELECT * FROM products WHERE owner_id = {$_SESSION['id']}");

// get user services
$user_services = $db->getRows("SELECT * FROM services WHERE owner_id = {$_SESSION['id']}");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Eav touch - Profile</title>


    <style>
        .container {
            border: 2px solid #dedede;
            background-color: #800000;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
        }

        .darker {
            border-color: #cd7171;
            background-color: #ddd;
        }

        .container::after {
            content: "";
            clear: both;
            display: table;
        }

        .container img {
            float: left;
            max-width: 60px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
        }

        .container img.right {
            float: right;
            margin-left: 20px;
            margin-right: 0;
        }

        .time-right {
            float: right;
            color: #000000;
        }

        .time-left {
            float: left;
            color: #000000;
        }


    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link rel="stylesheet" href="lightbox.css" type="text/css" media="screen"/>
    <script src="js/prototype.js" type="text/javascript"></script>
    <script src="js/scriptaculous.js?load=effects" type="text/javascript"></script>
    <script src="js/lightbox.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/java.js"></script>
</head>
<body>
<div id="wrap">
    <?php include "views/header.php"; ?>
    <div class="center_content">
        <div class="left_content">

            <div class="title"><span class="title_icon"><img src="images/girl.png" alt=""/></span>Your profile:</div>
            <div class="feat_prod_box_details">
                <div class="prod_img"><a href="#"><img src="./<?= $user_info->profile_image_path ?>"
                                                       style="border-radius: 50%;" height="103" width="103"/></a>

                </div>
                <div class="prod_det_box">
                    <div class="box_top"></div>
                    <div class="box_center">
                        <div><p class="prod_title">
                            <h2 style="color:#a81f22; margin-left: 10px;">Profile information :</h2></p>

                            <p class="details">
                            <ol>
                                <li>
                                    <h4 style="margin-left:15px">
                                        Name: <?= htmlspecialchars(ucfirst($user_info->first_name)) . ' ' . htmlspecialchars(ucfirst($user_info->last_name)) ?>  </h4>
                                </li>
                                <li>
                                    <h4 style="margin-left:15px">Store name: <?= $user_info->store_name ?>  </h4></li>
                                <li>
                                    <h4 style="margin-left:15px">Phone: <?= $user_info->phone_number ?>   </h4></li>
                                <li>
                                    <h4 style="margin-left:15px">Email: <?= $user_info->email ?>   </h4></li>
                                <li>
                                    <h4 style="margin-left:15px">Location: <?= $user_info->location ?>   </h4></li>
                            </ol>
                            <br> </p></div>
                        <div>

                            <div>
                                <p style=color:#000000 class="prod_title">
                                    <a href="upload_product.php">
                                        <button style="background-color:#800000;  border: none; color:#ffffff;"
                                                type="button"><b>Add New Product</b></button></p>
                            </div>
                            </a>

                            <br>


                            <div>
                                <p style=color:#000000 class="prod_title">
                                    <a href="upload_service.php">
                                        <button style="background-color:#800000;  border: none; color:#ffffff;"
                                                type="button"><b>Offer New Service</b></button></p>
                            </div>
                            <br>
                            </a>
                        </div>

                        <div class="clear"></div>
                    </div>
                    <div class="box_bottom"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div id="demo" class="demolayout">
                <ul id="demo-nav" class="demolayout">
                    <li><a class="active" href="#tab1">Messages</a></li>
                    <li><a class="" href="#tab2">Your Products </a></li>
                    <li><a class="" href="#tab3">Your Services </a></li>
                </ul>
                <div class="tabs-container">
                    <div style="display: block;" class="tab" id="tab1">

                        <ul class="list">
                            <div class="container">

                                <p><b style="color:#ffffff">Hello. How are you today?</b></p>
                                <span class="time-right" style="color:#ffffff">11:00</span>
                            </div>

                            <div class="container darker">
                                <p><b>Hey! I'm fine. Thanks for asking!</b></p>
                                <span class="time-right">11:01</span>
                            </div>

                            <div class="container">
                                <p><b style="color:#ffffff">Sweet! So, what do you wanna do today?</b></p>
                                <span class="time-right" style="color:#ffffff">11:02</span>
                            </div>

                            <div class="container darker">
                                <p><b>Nah, I dunno. Play soccer.. or learn more coding perhaps?</b></p>
                                <span class="time-right">11:05</span>
                            </div>


                    </div>
                    <div style="display: none;" class="tab" id="tab2">
                        <?php if ($user_products) : ?>
                            <?php foreach ($user_products as $user_product): ?>

                                <div class="new_prod_box"><a href="#"><?= $user_product->product_name; ?></a>
                                    <div class="new_prod_bg"><a href="#"><img
                                                    src="<?= $user_product->product_image_path; ?>"  style="border-radius: 10%;" height="110" width="120"
                                                    class="thumb"/></a></div>
                                    <!-- todo: fix images style -->
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <h3>
                                <center>no products , add some .</center>
                            </h3>
                        <?php endif; ?>
                        <div class="clear"></div>
                    </div>
                    <div style="display: none;" class="tab" id="tab3">
                        <?php if ($user_services) : ?>

                        <?php foreach ($user_services as $user_service): ?>
                            <div class="new_prod_box"><a href="#"> <?= 	$user_service->product_name; ?> </a>
                                <div class="new_prod_bg"><a href="#"><img
                                                src="<?= $user_service->product_image_path; ?>" alt=""
                                                class="thumb" style="border-radius: 10%;" height="110" width="120" /></a></div>
                                <!-- todo: fix images style -->

                            </div>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <h3>
                                <center>no services , add some .</center>
                            </h3>
                        <?php endif; ?>

                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <!--end of left content-->

        <?php include "views/right_sidebar.php"; ?>

        <!--end of right content-->

        <div class="clear"></div>
    </div>


    <!--end of center content-->
    <div class="footer">
        <div class="right_footer"><a href="#">home</a> <a href="#">about us</a> <a href="#">my account</a> <a href="#">register</a>
            <a href="#">contact us</a></div>
    </div>
</div>
</body>
<script type="text/javascript">

    var tabber1 = new Yetii({
        id: 'demo'
    });

</script>
</html>
