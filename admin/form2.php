<?php
require "../includes/includes.php";
if (!$auth->is_auth()) {
    redirect('../login.php', 1);
}
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['main_cat_name']) && !empty($_POST['main_cat_name'])) {

            // add new main category START .
            switch (intval($_POST['main_cat_type'])) {
                case 1 :
                    $table_name = "products_main_categories";
                    break;
                case 2 :
                    $table_name = "services_main_categories";
                    break;
                default :
                    exit;
            }
            if (isset($_FILES['main_cat_icon']) && $_FILES['main_cat_icon']['size'] > 0) {
                $targetPath = "images/";
                $upload = upload_file($_FILES['main_cat_icon'], $targetPath);
                if (is_array($upload)) {
                    if (isset($upload['success']) && $upload['success']) {
                        $icon_path = $upload['file_link'];

                    }
                }


            } else {
                // no upload , set default  icon as path .

                $icon_path = "images/left_menu_bullet.gif";
            }

            // insert the new cat .
            $name = $_POST['main_cat_name'];
            if ($db->insert($table_name,
                [
                        "name" => $name,
                    "icon_path" => $icon_path ,

                ]
                )){
                // todo: all cool category added , do something
$truex = true;

            }
            else {
                 echo $db->last_error(); exit;

            }



        }



        elseif (isset($_POST['sub_cat_name']) && !empty($_POST['sub_cat_name'])){

            // insert new sub cat .
            switch (intval($_POST['sub_cat_type'])) {
                case 1 :
                    $table_name = "products_sub_categories";
                    break;
                case 2 :
                    $table_name = "services_sub_categories";
                    break;
                default :
                    exit;
            }

            $name = $_POST['sub_cat_name'];
            if ($db->insert($table_name,
                [
                    "name" => $name,
                    "main_category_id" => intval($_POST['main_cat_id']),

                ]
            )){
                // todo: all cool category added , do something
                $truex = true;

            }
            else {
                echo $db->last_error(); exit;

            }
}

}

$products_main_categories = $db->getRows("SELECT * FROM products_main_categories WHERE 1");
$services_main_categories = $db->getRows("SELECT * FROM services_main_categories WHERE 1");


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
                    <h2>Categories Manager</h2>

                </div>
            </div>
            <!-- /. ROW  -->
            <hr/>
            <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>New Main Category Details </b>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <br>
                                    <form name="add_main_cat" method="post" action="<?= $_SERVER["PHP_SELF"] ?>"
                                          enctype="multipart/form-data">
                                        <div class="form_row">
                                            <label class="contact"><strong>Main Category Name:</strong></label>
                                            <input type="text" name="main_cat_name" class="form-control" required/>
                                        </div>

                                        <div class="form_row">
                                            <label class="contact"><strong>Main Category Type:</strong></label>
                                            <select class="form-control" name="main_cat_type" id="Type">
                                                <option value="1">Products Category</option>
                                                <option value="2">Services Category</option>
                                            </select>
                                        </div>
                                        <div class="form_row">
                                            <label class="contact"><strong>Picture:</strong></label>
                                            <input type="file" class="form-control" name="main_cat_icon"
                                                   id="main_cat_icon"/>
                                        </div>
                                        <br>
                                        <div class="form_row">
                                            <button class="btn btn-danger btn-sm pull-right" type="submit" value="submit">
                                                Add New Category
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


                    <div class="row">
                        <div class="col-md-12">
                            <!-- Form Elements -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <b>New Sub Category Details </b>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <br>
                                            <form name="register" method="post" action="<?= $_SERVER["PHP_SELF"] ?>"
                                                  enctype="multipart/form-data">
                                                <div class="form_row">
                                                    <label class="contact"><strong>Sub Category Name:</strong></label>
                                                    <input type="text" name="sub_cat_name" class="form-control"
                                                           required/>
                                                </div>
                                                <div class="form_row">
                                                    <label class="contact"><strong>Sub Category Type:</strong></label>
                                                    <select class="form-control" name="sub_cat_type" id="Type">
                                                        <option value="1">Products Category</option>
                                                        <option value="2">Services Category</option>
                                                    </select>
                                                </div>

                                                <div class="form_row">
                                                    <label class="contact"><strong>Main Category</strong></label>
                                                    <select class="form-control" name="main_cat_id" id="Type">

                                                        <?php
                                                        foreach ($products_main_categories as $products_main_category):
                                                        ?>
                                                        <option value="<?= $products_main_category->id ?>"><?= $products_main_category->name ?></option>
                                                        <?php endforeach;?>

                                                        <?php
                                                        foreach ($services_main_categories as $products_main_category):
                                                        ?>
                                                        <option value="<?= $products_main_category->id ?>"><?= $products_main_category->name ?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>


                                                <br>
                                                <div class="form_row">
                                                    <button class="btn btn-danger btn-sm pull-right" type="submit"
                                                            value="">
                                                        Add New Category
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


                            <hr/>

</body>
</html>
