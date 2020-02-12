<?php
require "includes/includes.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	   
    if ($auth->login($_POST['user_name'], $_POST['password']) === true) {
       // login success
  
        switch ($_SESSION['account_type']) {
            case 1 :
                redirect("admin/",1);
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
		  // todo: failed login do something
        $e = true; // empty body statement not allowed // delete this if code .
 
    }

	
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Eav touch - Login</title>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div id="wrap">
    <?php include "views/header.php"; ?>
    <div class="center_content">
        <div class="left_content">
            <div class="title"><span class="title_icon"><img src="images/girl.png" alt=""/></span>My account</div>
            <div class="feat_prod_box_details">
                <p class="details"><br><br><br><br></p>
                <div class="contact_form">
                    <div class="form_subtitle">login into your account</div>
                    <form name="register" method="post" action="<?= $_SERVER["PHP_SELF"] ?>">
                        <div class="form_row">
                            <label class="contact"><strong>Username:</strong></label>
                            <input type="text"  class="contact_input" name="user_name" required/>
                        </div>
                        <div class="form_row">
                            <label class="contact"><strong>Password:</strong></label>
                            <input type="password"  class="contact_input" name="password" required/>
                        </div>
                        <div class="form_row">
                            <div class="terms">
                                <input type="checkbox" name="terms"/>
                                Remember me
                            </div>
                        </div>
                        <div class="form_row">
                            <input type="submit" class="register" value="login"/>
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
