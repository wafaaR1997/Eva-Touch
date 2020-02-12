<?php

require "includes/includes.php";
if (!$auth->is_auth()) {
    redirect('login.php', 1);
}
$user_info = $db->getRow("SELECT * FROM users WHERE id= {$_SESSION['id']} ");
$products_sub_cats = $db->getRows("SELECT * FROM services_sub_categories");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_FILES['product_image_path']) && $_FILES['product_image_path']['size'] > 0) {
        $targetPath = "/services_images/";
        $upload = upload_file($_FILES['product_image_path'], $targetPath);
        if (is_array($upload)) {
            if (isset($upload['success']) && $upload['success']) {
                $product_image_path = $upload['file_link'];

            }
        }
    } else {
        // no upload , set default product pic .

        $product_image_path = "services_images/default.png";
    }

    $product_name = $_POST['product_name'];
    $product_sub_category_id = $_POST['product_category'];
    $product_status = $_POST['product_status'];
    $description = $_POST['description'];
    $owner_id = $user_info->id;
    $phone = $_POST['phone'];
    $is_promoted = 0;
    $price = $_POST['price'];

    if ($db->insert("services",
        [
            "product_name" => $product_name,
            "product_sub_category_id" => $product_sub_category_id,
            "product_status" => $product_status,
            "description" => $description,
            "product_image_path" => $product_image_path,
            "owner_id" => $owner_id,
            "phone" => $phone,
            "price" => $price,
        ]
    )) {

        // todo: service added successfully do something ...
        redirect("profile.php",1);
    } else {
        $db->last_error();
        exit;
    }


}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Eav touch - Offer New Service</title>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div id="wrap">
    <?php include "views/header.php"; ?>

    <div class="center_content">
        <div class="left_content">
            <div class="title"><span class="title_icon"><img src="images/upload.png" alt=""/></span>Offer New Service
            </div>
            <div class="feat_prod_box_details">
                <p class="details"></p>
                <div class="contact_form">
                    <div class="form_subtitle">Service Details</div>
                    <form name="add_product" href="#" action="<?= $_SERVER["PHP_SELF"] ?>" method="post"
                          enctype="multipart/form-data">
                        <div class="form_row">
                            <label class="contact"><strong>Title:</strong></label>
                            <input type="text" class="contact_input" name="product_name" id="" required/>
                        </div>
                        <div class="form_row">
                            <label class="contact"><strong>Category:</strong></label>
                            <select class="input_text" name="product_category" id="name" required>

                                <option value="" disabled>-- Select --</option>
                                <?php foreach ($products_sub_cats as $product_sub_cat) : ?>
                                    <option value="<?= $product_sub_cat->id ?>"><?= ucwords(strtolower($product_sub_cat->name)); ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>

                        <div class="form_row">
                            <label class="contact"><strong>Status:</strong></label>
                            <select class="input_text" name="product_status" id="name" required>
                                <option value="1" selected>Avaliable</option>
                                <option value="2">Not Avaliable</option>
                                <option value="3">Disabled</option>
                            </select>
                        </div>
                        <div class="form_row">
                            <label class="contact"><strong>Cost:</strong></label>
                            <input type="text" class="contact_input" name="price" id="" required/>
                        </div>
                        <div class="form_row">
                            <label class="contact"><strong>Phone:</strong></label>
                            <input type="text" class="contact_input" name="phone"
                                   value="<?= $user_info->phone_number ?>" id="" required/>
                        </div>
                        <div class="form_row">
                            <label class="contact"><strong>Description:</strong></label>
                            <textarea rows="6" cols="33" name="description" required></textarea>
                        </div>

                        <div class="form_row">
                            <label class="contact"><strong>Image:</strong></label>
                            <input type="file" class="contact_input" name="product_image_path" id=""/>
                        </div>

                        <div class="form_row">
                            <div class="terms">
                                <input type="checkbox" name="terms" name="" id=""/>
                                I agree to the <a href="#">terms &amp; conditions</a></div>
                        </div>
                        <div class="form_row">
                            <input type="submit" class="register" value="Post" name="" id=""/>
                        </div>
                    </form>
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
</html>
