<?php
require "includes/includes.php";
/*$post_names = ["user_name", "first_name", "last_name", "phone",
    "email", "password", "account_type", "location"];*/

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
    $account_type = intval($_POST['account_type']);
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
            "phone_number" => $phone

        ]
    )) {
 
        // todo: registered successfully do something ...
        if ($auth->login($user_name, $_POST['password']) === true) {
            // login success

            switch ($_SESSION['account_type']) {
                case 1 :
                    redirect("admin/", 1);
                    break;
                case 2 :
                    redirect("profile.php",1);
                    break;
                case 3 :
                    redirect("index.php",1);
                    break;
                default:
                    exit;
            }

        } else {

            $db->last_error();
            exit;

        }
    }
	else 
	{
  // nothings
  
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Eav touch - Register</title>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div id="wrap">
    <?php include "views/header.php"; ?>

    <div class="center_content">
        <div class="left_content">
            <div class="title"><span class="title_icon"><img src="images/register.png" alt=""/></span>Register</div>
            <div class="feat_prod_box_details">
                <p class="details"></p>
                <div class="contact_form">
                    <div class="form_subtitle">Create New Account</div>
                    <form name="register" method="post" action="<?=   $_SERVER["PHP_SELF"] ?>"
                          enctype="multipart/form-data">
                        <div class="form_row">
                            <label class="contact"><strong>User name:</strong></label>
                            <input type="text" name="user_name" class="contact_input" value="anasmix" required/>
                        </div>
                        <div class="form_row">
                            <label class="contact"><strong>First name:</strong></label>
                            <input type="text" name="first_name" class="contact_input" value="anas" required/>
                        </div>
                        <div class="form_row">
                            <label class="contact"><strong>Last name:</strong></label>
                            <input type="text" name="last_name" class="contact_input" value="alhafi" required/>
                        </div>

                        <div class="form_row">
                            <label class="contact"><strong>Phone:</strong></label>
                            <input type="text" class="contact_input" name="phone" value="0799181219" required/>
                        </div>
                        <div class="form_row">
                            <label class="contact"><strong>Email:</strong></label>
                            <input type="email" class="contact_input" name="email" value="ansans990@gmail.com" required>
                        </div>
                        <div class="form_row">
                            <label class="contact"><strong>Password:</strong></label>
                            <input type="Password" class="contact_input" name="password" value="123" required/>
                        </div>
                        <div class="form_row">
                            <label class="contact"><strong>Intention:</strong></label>
                            <select class="input_text" name="account_type" id="Type">
                                <option value="2">Service Provider</option>
                                <option value="3">Customer</option>

                            </select>
                        </div>
                        <div class="form_row">
                            <label class="contact"><strong>Location:</strong></label>
                            <select class="input_text" name="location" id="name">
                                <option value="Amman" selected>Amman</option>
                                <option value="Zarqa">Zarqa</option>
                                <option value="Irbid">Irbid</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>

                        <div class="form_row">
                            <label class="contact"><strong>Picture:</strong></label>
                            <input type="file" class="contact_input" name="profile_image_path" id="profile_image_path"/>
                        </div>
                        <div class="form_row">
                            <input type="submit" class="register" value="register"/>
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
