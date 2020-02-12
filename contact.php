<?php
require "includes/includes.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message_body = $_POST['message_body'];
    if ($db->insert("feedback",
        [
            "name" => $name,
            "email" => $email,
            "subject" => $subject,
            "message_body" => $message_body,

        ]
    )) {

        // todo: message send successfully do something ...
        redirect("index.php");
    }
    else {

        $db->last_error();exit;

    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Eav touch - Contact Us</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="wrap">
    <?php include "views/header.php"; ?>
  <div class="center_content">
    <div class="left_content">
      <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" /></span>Contact Us</div>
      <div class="feat_prod_box_details">
        <p class="details"> <br><br><br><br> </p>
        <div class="contact_form">
          <div class="form_subtitle">All Fields Are Requierd</div>
          <div class="form_row"> <form method="post"  action="<?= $_SERVER["PHP_SELF"] ?>">
            <label class="contact"><strong>Name:</strong></label>
            <input type="text" name ="name" class="contact_input" required />
          </div>
          <div class="form_row">
            <label class="contact"><strong>Email:</strong></label>
            <input type="email"   name="email"  class="contact_input" required/>
          </div>
          <div class="form_row">
            <label class="contact"><strong>subject:</strong></label>
            <input type="text" name="subject" class="contact_input" required />
          </div>
          
          <div class="form_row">
            <label class="contact"><strong>Message:</strong></label>
            <textarea class="contact_textarea"  name="message_body" required ></textarea>
          </div>
          <div class="form_row"> <input type="submit"  value="send "></div>
            <!-- todo : fix the send button style  -->
        </div>
      </div>
      <div class="clear"></div>
    </div>
</form>
<!--end of left content-->
      <?php include "views/right_sidebar.php"; ?>
    <!--end of right content-->
    <div class="clear"></div>
  </div>
  <!--end of center content-->
  <div class="footer">
    <div class="right_footer"> <a href="#">home</a> <a href="#">about us</a> <a href="#">services</a> <a href="#">privacy policy</a> <a href="#">contact us</a> </div>
  </div>
</div>
</body>
</html>
