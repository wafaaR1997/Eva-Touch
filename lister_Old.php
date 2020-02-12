<?php
require "includes/includes.php";
if (!$auth->is_auth()) {
    redirect('login.php', 1);
}
// get current page
$page = 0;
if (isset($_GET['page']) && intval($_GET['page']) > 0)
    $page = intval($_GET['page']) - 1;


if (intval($_GET['type']) == 1) {
    // product type
    $sub_cat_id = intval($_GET['id']);
    $sub_cat = $db->getRow("SELECT * FROM products_sub_categories WHERE id= {$sub_cat_id}");
    $products = $db->getRows(" SELECT * FROM products 
 WHERE product_sub_category_id = {$sub_cat_id} ");

} elseif (intval($_GET['type']) == 2) {
//service type
    $sub_cat_id = intval($_GET['id']);
    $sub_cat = $db->getRow("SELECT * FROM services_sub_categories WHERE id= {$sub_cat_id}");
    $products = $db->getRows(" SELECT * FROM services 
 WHERE product_sub_category_id = {$sub_cat_id} ");
} else {

    exit;

}
switch (intval($_GET['type'])) {
    case 1:
        $table_name = "products_rating";
        break;
    case 2:
        $table_name = "services_rating";
        break;
    default :
        exit;


}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jqfuncs.js"></script>
    <title>Eav touch - Products </title>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:500,100,300,700,400);

        div.stars {
            width: 270px;
            display: inline-block;
        }

        input.star {
            display: none;
        }

        label.star {
            float: right;
            padding: 10px;
            font-size: 36px;
            color: #444;
            transition: all .2s;
        }

        input.star:checked ~ label.star:before {
            content: '\f005';
            color: #FD4;
            transition: all .25s;
        }

        input.star-5:checked ~ label.star:before {
            color: #FE7;
            text-shadow: 0 0 20px #952;
        }

        input.star-1:checked ~ label.star:before {
            color: #F62;
        }

        label.star:hover {
            transform: rotate(-15deg) scale(1.3);
        }

        label.star:before {
            content: '\f006';
            font-family: FontAwesome;
        }

        .rev-box {
            overflow: hidden;
            height: 0;
            width: 100%;
            transition: all .25s;
        }

        textarea.review {
            background: #222;
            border: none;
            width: 100%;
            max-width: 100%;
            height: 100px;
            padding: 10px;
            box-sizing: border-box;
            color: #EEE;
        }

        label.review {
            display: block;
            transition: opacity .25s;
        }

        input.star:checked ~ .rev-box {
            height: 125px;
            overflow: visible;
        }
    </style>
</head>
<body>
<div id="wrap">
    <?php include "views/header.php"; ?>
    <div class="center_content">
        <div class="left_content">
            <div class="title"><span class="title_icon"><img src="images/bullet1.gif"
                                                             alt=""/></span> <?= ucwords(strtolower($sub_cat->name)); ?>
            </div>

            <?php if ($products) : ?>
                <?php foreach ($products as $product) : ?>
                    <?php
                    $rating = $db->getRow("SELECT AVG(rating) as rating FROM {$table_name} WHERE product_id = {$product->id}")->rating;
					
					//die ( $rating); 
                    $user_rating = $db->getRow("SELECT rating FROM {$table_name}
                    WHERE product_id = {$product->id} AND user_id = {$auth->getId()}")->rating;
                    ?>
                    <div class="feat_prod_box">
                        <div class="prod_img"><a href="#"><img src="<?= $product->product_image_path; ?>" alt=""
                                                               border="0" width="149" height="137"/></a></div>
                        <div class="prod_det_box"><span class="special_icon"></span>
                            <div class="box_top"></div>
                            <div class="box_center">
                                <div style="color:#000000; text-decoration:underline " class="prod_title">
                                    <b><?= ucwords(strtolower($product->product_name)); ?></b></div>
                                <p style=color:#990000 class="details"><b><?php if (intval($_GET['type']) == 2) {
                                            echo "Cost";
                                        } else {
                                            echo "Price";
                                        } ?> :<span style="color:#000000">

                        <?= $product->price . ' ' . "$"; ?>
                                        </span></b>

                                    <br>

                                    <b>Status :<span
                                                style="color: <?= $productStatus[$product->product_status][1] ?>;"> <?= $productStatus[$product->product_status][0]; ?></span></b>
                                    <br>
                                    <b> Phone : <span style="color:black"><?= $product->phone ?></span></b>
                                    <br>
                                    <b>Description : <span style="color:black"><?= $product->description ?></span></b>
                                    <br>
                                    <b>Rating : <span style="color:black"><?=    (round($rating, 2))  ?  round($rating, 2)  :  "Not Rated" ?></span></b>
                                    <br>
                                <div class="stars">

                                    <input class="star star-5" id="star-5<?= $product->id; ?>" type="radio"
                                           name="<?= $product->id; ?>" value="5"
                                           data-type="<?= intval($_GET['type']); ?>"
                                           data-productid="<?= $product->id; ?>" <?= $user_rating == 5 ? "checked": "" ?>/>
                                    <label class="star star-5" for="star-5<?= $product->id; ?>"></label>
                                    <input class="star star-4" id="star-4<?= $product->id; ?>" type="radio"
                                           name="<?= $product->id; ?>" value="4"
                                           data-type="<?= intval($_GET['type']); ?>"
                                           data-productid="<?= $product->id; ?>" <?= $product->id; ?>" <?= $user_rating == 4 ? "checked": "" ?>/>
                                    <label class="star star-4" for="star-4<?= $product->id; ?>"></label>
                                    <input class="star star-3" id="star-3<?= $product->id; ?>" type="radio"
                                           name="<?= $product->id; ?>" value="3"
                                           data-type="<?= intval($_GET['type']); ?>"
                                           data-productid="<?= $product->id; ?>" <?= $product->id; ?>" <?= $user_rating == 3 ? "checked": "" ?>/>
                                    <label class="star star-3" for="star-3<?= $product->id; ?>"></label>
                                    <input class="star star-2" id="star-2<?= $product->id; ?>" type="radio"
                                           name="<?= $product->id; ?>" value="2"
                                           data-type="<?= intval($_GET['type']); ?>"
                                           data-productid="<?= $product->id; ?>" <?= $product->id; ?>" <?= $user_rating == 2 ? "checked": "" ?>/>
                                    <label class="star star-2" for="star-2<?= $product->id; ?>"></label>
                                    <input class="star star-1" id="star-1<?= $product->id; ?>" type="radio"
                                           name="<?= $product->id; ?>" value="1"
                                           data-type="<?= intval($_GET['type']); ?>" <?= $product->id; ?>" <?= $user_rating == 1 ? "checked": "" ?>
                                           data-productid="<?= $product->id; ?>"/>
                                    <label class="star star-1" for="star-1<?= $product->id; ?>"></label>
                                </div>
                                <form method="post" action="">
                                    <label style=color:#990000;padding-left:15px><b>
                                            <small>Message:</small>
                                        </b>
                                        <input type="text" name="comment">
                                        <input style="background-color:#cc0000;  border: none; color:#ffffff;"
                                               type="submit" value="send"/>
                                </form>
								<br><br>
								<?php  echo"<div id=pro_buy>
                                <a href=# ><button>sell now</button></a>
                                 </div>"?>
								
								
								
                                </p>
                                <div class="clear"></div>
                            </div>
                            <div class="box_bottom"></div>
                        </div>
                        <div class="clear"></div>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <!-- todo: design no products error  -->
                <Br><br><br>
                <h3>
                    <center>NO Products Or Services In This Category</center>
                </h3>
            <?php endif; ?>


            <div class="pagination"><span class="disabled"><<</span><span class="current">1</span><a href="#">2</a><a
                        href="#">3</a><a href="#">...</a><a href="#">10</a><a href="#">11</a><a href="#">>></a></div>
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
</html>