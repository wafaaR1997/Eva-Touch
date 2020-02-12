<?php
require "../includes/includes.php";
if (!$auth->is_auth()) {
    redirect('../login.php', 1);
}

$user_info = $db->getRow("SELECT * FROM users WHERE id= {$_SESSION['id']} ");
$products_sub_cats = $db->getRows("SELECT * FROM products_sub_categories");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_FILES['product_image_path']) && $_FILES['product_image_path']['size'] > 0) {
        $targetPath = "products_images/";
        $upload = upload_file($_FILES['product_image_path'], $targetPath);
        if (is_array($upload)) {
            if (isset($upload['success']) && $upload['success']) {
                $product_image_path = $upload['file_link'];

            }
        }
    } else {
        // no upload , set default product pic .

        $product_image_path = "products_images/default.png";
    }

    $product_name = $_POST['product_name'];
    $product_sub_category_id = $_POST['product_category'];
    $product_status = $_POST['product_status'];
    $description = $_POST['description'];
    $owner_id = $user_info->id;
    $phone = $_POST['phone'];
    $is_promoted = 1;
    $price = $_POST['price'];

    if ($db->insert("products",
        [
            "product_name" => $product_name,
            "product_sub_category_id" => $product_sub_category_id,
            "product_status" => $product_status,
            "description" => $description,
            "product_image_path" => $product_image_path,
            "owner_id" => $owner_id,
            "phone" => $phone,
            "price" => $price,
            "is_promoted" => $is_promoted,
        ]
    )) {

        // todo: product added successfully do something ...
        redirect("index.php");
    } else {
        echo $db->last_error();
        exit;
    }


}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Eva Admin - Add New Admin </title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet"/>
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet"/>
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet"/>
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
</head>
<body>
<div id="wrapper">
    <?php include "views/header.php"; ?>

    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Add New Promotion</h2>

                </div>
            </div>
            <!-- /. ROW  -->
            <hr/>
            <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Product Details </b>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <br>
                                    <form name="add_product" href="#" action="<?= $_SERVER["PHP_SELF"] ?>" method="post"
                                          enctype="multipart/form-data">
                                        <div class="form_row">
                                            <label class="contact"><strong>Name:</strong></label>
                                            <input type="text" class="form-control" name="product_name" id="" required/>
                                        </div>
                                        <div class="form_row">
                                            <label class="contact"><strong>Category:</strong></label>
                                            <select class="form-control" name="product_category" id="name" required>

                                                <option value="" disabled>-- Select --</option>
                                                <?php foreach ($products_sub_cats as $product_sub_cat) : ?>
                                                    <option value="<?= $product_sub_cat->id ?>"><?= ucwords(strtolower($product_sub_cat->name)); ?></option>
                                                <?php endforeach; ?>

                                            </select>
                                        </div>

                                        <div class="form_row">
                                            <label class="contact"><strong>Status:</strong></label>
                                            <select class="form-control" name="product_status" id="name" required>
                                                <option value="1" selected>Avaliable</option>
                                                <option value="2">Not Avaliable</option>
                                                <option value="3">Disabled</option>
                                            </select>
                                        </div>
                                        <div class="form_row">
                                            <label class="contact"><strong>Price:</strong></label>
                                            <input type="text" class="form-control" name="price" id="" required/>
                                        </div>
                                        <div class="form_row">
                                            <label class="contact"><strong>Phone:</strong></label>
                                            <input type="text" class="form-control" name="phone"
                                                   value="<?= $user_info->phone_number ?>" id="" required/>
                                        </div>
                                        <div class="form_row">
                                            <label class="contact"><strong>Description:</strong></label>
                                            <textarea rows="6" cols="33" name="description" class="form-control" required></textarea>
                                        </div>

                                        <div class="form_row">
                                            <label class="contact"><strong>Picture:</strong></label>
                                            <input type="file" class="form-control" name="product_image_path" id=""/>
                                        </div>

                                        <div class="form_row">
                                            <div class="terms">
                                                <input type="checkbox" name="terms" name="" id=""/>
                                                I agree to the <a href="#">terms &amp; conditions</a></div>
                                        </div>
                                        <div class="form_row">
                                            <button class="btn btn-danger btn-sm pull-right" type="submit"
                                                    value="">
                                               Submit Promotion
                                            </button>
                                        </div>
                                    </form>

                                    <br><br><br>


                                </div>

                            </div>
                            <!-- /. PAGE INNER  -->
                        </div>
                        <!-- /. PAGE WRAPPER  -->
                    </div>
                    <!-- /. WRAPPER  -->
                    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
                    <!-- JQUERY SCRIPTS -->
                    <script src="assets/js/jquery-1.10.2.js"></script>
                    <!-- BOOTSTRAP SCRIPTS -->
                    <script src="assets/js/bootstrap.min.js"></script>
                    <!-- METISMENU SCRIPTS -->
                    <script src="assets/js/jquery.metisMenu.js"></script>
                    <!-- CUSTOM SCRIPTS -->
                    <script src="assets/js/custom.js"></script>


</body>
</html>
