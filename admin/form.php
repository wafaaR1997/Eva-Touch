<?php
require "../includes/includes.php";
if (!$auth->is_auth()) {
    redirect('../login.php', 1);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['profile_image_path']) && $_FILES['profile_image_path']['size'] > 0) {
        $targetPath = "profile_images/";
        $upload = upload_file($_FILES['profile_image_path'], $targetPath);
        if (is_array($upload)) {
            if (isset($upload['success']) && $upload['success']) {
                $profile_image_path = $upload['file_link'];

            }
        }


    } else {
        // no upload , set default user icon as path .

        $profile_image_path = "profile_images/default.png";
    }

    $user_name = strtolower($_POST['user_name']);
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $account_type = intval(1);
    $location = $_POST['location'];

    if ($db->insert("users",
        [
            "user_name" => $user_name,
            "password" => $password,
            "email" => $email,
            "account_type" => $account_type,
            "store_name" => $user_name,
            "profile_image_path" => $profile_image_path,
            "location" => $location,
            "first_name" => $first_name,
            "last_name" => $last_name,
            "phone_number" => $phone,

        ]
    )) {

        // todo: registered successfully do something ...
        $truex= true;
    }
    else {

        $db->last_error();exit;

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
                    <h2>Add New Admin</h2>

                </div>
            </div>
            <!-- /. ROW  -->
            <hr/>
            <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Admin Details </b>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <br>
                                    <form name="register" method="post" action="<?= $_SERVER["PHP_SELF"] ?>"
                                          enctype="multipart/form-data">
                                        <div class="form_row">
                                            <label class="contact"><strong>User name:</strong></label>
                                            <input type="text" name="user_name" class="form-control" required/>
                                        </div>
                                        <div class="form_row">
                                            <label class="contact"><strong>First name:</strong></label>
                                            <input type="text" name="first_name" class="form-control" required/>
                                        </div>
                                        <div class="form_row">
                                            <label class="contact"><strong>Last name:</strong></label>
                                            <input type="text" name="last_name" class="form-control" required/>
                                        </div>

                                        <div class="form_row">
                                            <label class="contact"><strong>Phone:</strong></label>
                                            <input type="text" class="form-control" name="phone" required/>
                                        </div>
                                        <div class="form_row">
                                            <label class="contact"><strong>Email:</strong></label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                        <div class="form_row">
                                            <label class="contact"><strong>Password:</strong></label>
                                            <input type="Password" class="form-control" name="password" required/>
                                        </div>
                                        <br>
                                        <div class="form_row">
                                            <label class="contact"><strong>Location:</strong></label>
                                            <select class="input_text" name="location" id="name">
                                                <option value="Amman" selected>Amman</option>
                                                <option value="Zarqa">Zarqa</option>
                                                <option value="Irbid">Irbid</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="form_row">
                                            <label class="contact"><strong>Picture:</strong></label>
                                            <input type="file" class="form-control" name="profile_image_path"
                                                   id="profile_image_path"/>
                                        </div>
                                        <br>
                                        <div class="form_row">
                                            <button class="btn btn-danger btn-sm pull-right" type="submit" value="">
                                                Add New Admin
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
