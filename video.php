<?php

require "includes/includes.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Eav touch</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:500,100,300,700,400);
div.stars{
  width: 270px;
  display: inline-block;
}
 
input.star{
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
  content:'\f005';
  color: #FD4;
  transition: all .25s;
}
 
 
input.star-5:checked ~ label.star:before {
  color:#FE7;
  text-shadow: 0 0 20px #952;
}
 
input.star-1:checked ~ label.star:before {
  color: #F62;
}
 
label.star:hover{
  transform: rotate(-15deg) scale(1.3);
}
 
label.star:before{
  content:'\f006';
  font-family: FontAwesome;
}
 
.rev-box{
  overflow: hidden;
  height: 0;
  width: 100%;
  transition: all .25s;
}
 
textarea.review{
  background: #222;
  border: none;
  width: 100%;
  max-width: 100%;
  height: 100px;
  padding: 10px;
  box-sizing: border-box;
  color: #EEE;
}
 
label.review{
  display: block;
  transition:opacity .25s;
}
 
input.star:checked ~ .rev-box{
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
      <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" /></span> Video</div>
      <div class="feat_prod_box">
        <div class="prod_img"><a href="#"><img src="images/prod2.gif" alt="" border="0" /></a></div>
        <div class="prod_det_box"> <span class="special_icon"></span>
          <div class="box_top"></div>
          <div class="box_center">
            <div style="color:#000000; text-decoration:underline " class="prod_title"><b> product name 1</b></div>
            <p style=color:#990000 class="details"><b>price :<span  style="color:black">10$</span></b>
		
			<br>
			
              <b>product status :<span  style="color:black">(available , not available ,disabled)</span></b>			
			<br>
			<b> seller phone:<span  style="color:black">....$</span></b>
			<br>
			<b>product description :<span  style="color:black">(color .size ,discount)</span></b>			
			<br >	
			<div class="stars">
<form action=""  method="">
  <input class="star star-5" id="star-51" type="radio" name="vid1" checked/>
  <label class="star star-5" for="star-51"></label>
  <input class="star star-4" id="star-41" type="radio" name="vid1" checked/>
  <label class="star star-4" for="star-41"></label>
  <input class="star star-3" id="star-31" type="radio" name="vid1"/>
  <label class="star star-3" for="star-31"></label>
  <input class="star star-2" id="star-21" type="radio" name="vid1"/>
  <label class="star star-2" for="star-21"></label>
  <input class="star star-1" id="star-11" type="radio" name="vid1"/>
  <label class="star star-1" for="star-11"></label>
</form>
</div>
			
	<form method="post" action="">
            <label  style=color:#990000;padding-left:15px><b>Comments:</b>
            <input type="text" name="comment">
			<input  style="background-color:#cc0000;  border: none; color:#ffffff;"type="submit"  value="send" />
			</form>
			</p>          
            <div class="clear"></div>
          </div>
          <div class="box_bottom"></div>
        </div>
        <div class="clear"></div>
      </div>

      <div class="feat_prod_box">
        <div class="prod_img"><a href="#"><img src="images/prod2.gif" alt="" border="0" /></a></div>
        <div class="prod_det_box"> <span class="special_icon"></span>
          <div class="box_top"></div>
          <div class="box_center">
            <div style="color:#000000; text-decoration:underline " class="prod_title"><b> product name 2</b></div>
            <p style=color:#990000 class="details"><b>price :<span  style="color:black">10$</span></b>
		
			<br>
			
              <b>product status :<span  style="color:black">(available , not available ,disabled)</span></b>			
			<br>
			<b> seller phone:<span  style="color:black">....$</span></b>
			<br>
			<b>product description :<span  style="color:black">(color .size ,discount)</span></b>			
			<br >	
			
			<div class="stars">
<form   method=""  action="">
  <input class="star star-5" id="star-52" type="radio" name="vid2"/>
  <label class="star star-5" for="star-52"></label>
  <input class="star star-4" id="star-42" type="radio" name="vid2"/>
  <label class="star star-4" for="star-42"></label>
  <input class="star star-3" id="star-32" type="radio" name="vid2"/>
  <label class="star star-3" for="star-32"></label>
  <input class="star star-2" id="star-22" type="radio" name="vid2"/>
  <label class="star star-2" for="star-22"></label>
  <input class="star star-1" id="star-12" type="radio" name="vid2" />
  <label class="star star-1" for="star-12"></label>
</form>
</div>
			
	<form method="post" action="">
            <label  style=color:#990000;padding-left:15px><b>Comments:</b>
            <input type="text" name="comment">
			<input  style="background-color:#cc0000;  border: none; color:#ffffff;"type="submit"  value="send" />
			</form>	
			</p>
            <div class="clear"></div>
			
          </div>
          <div class="box_bottom"></div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="feat_prod_box">
        <div class="prod_img"><a href="#"><img src="images/prod2.gif" alt="" border="0" /></a></div>
        <div class="prod_det_box"> <span class="special_icon"></span>
          <div class="box_top"></div>
		  

          <div class="box_center">
            <div style="color:#000000; text-decoration:underline " class="prod_title"><b> product name 3 </b></div>
            <p style=color:#990000 class="details"><b>price :<span  style="color:black">10$</span></b>
		
			<br>
			
              <b>product status :<span  style="color:black">(available , not available ,disabled)</span></b>			
			<br>
			<b> seller phone:<span  style="color:black">....$</span></b>
			<br>
			<b>product description :<span  style="color:black">(color .size ,discount)</span></b>			
			<br >	
			<div class="stars">
<form method="" action="" >
  <input class="star star-5" id="star-53" type="radio" name="vid3"/>
  <label class="star star-5" for="star-53"></label>
  <input class="star star-4" id="star-43" type="radio" name="vid3"/>
  <label class="star star-4" for="star-43"></label>
  <input class="star star-3" id="star-33" type="radio" name="vid3"/>
  <label class="star star-3" for="star-33"></label>
  <input class="star star-2" id="star-23" type="radio" name="vid3"/>
  <label class="star star-2" for="star-23"></label>
  <input class="star star-1" id="star-13" type="radio" name="vid3"/>
  <label class="star star-1" for="star-13"></label>
</form>
</div>
			
	<form method="post" action="">
            <label  style=color:#990000;padding-left:15px><b>Comments:</b>
            <input type="text" name="comment">
			<input  style="background-color:#cc0000;  border: none; color:#ffffff;"type="submit"  value="send" />
			</form>		
			</p>
            
            <div class="clear"></div>
          </div>
          <div class="box_bottom"></div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="feat_prod_box">
        <div class="prod_img"><a href="#"><img src="images/prod2.gif" alt="" border="0" /></a></div>
        <div class="prod_det_box"> <span class="special_icon"></span>
          <div class="box_top"></div>
          <div class="box_center">
           <div style="color:#000000; text-decoration:underline " class="prod_title"><b> product name 4</b></div>
            <p style=color:#990000 class="details"><b>price :<span  style="color:black">10$</span></b>
		
			<br>
			
              <b>product status :<span  style="color:black">(available , not available ,disabled)</span></b>			
			<br>
			<b> seller phone:<span  style="color:black">....$</span></b>
			<br>
			<b>product description :<span  style="color:black">(color .size ,discount)</span></b>			
			<br >	
			<div class="stars">
<form action="">
  <input class="star star-5" id="star-54" type="radio" name="vid4"/>
  <label class="star star-5" for="star-54"></label>
  <input class="star star-4" id="star-44" type="radio" name="vid4"/>
  <label class="star star-4" for="star-44"></label>
  <input class="star star-3" id="star-34" type="radio" name="vid4"/>
  <label class="star star-3" for="star-34"></label>
  <input class="star star-2" id="star-24" type="radio" name="vid4"/>
  <label class="star star-2" for="star-24"></label>
  <input class="star star-1" id="star-14" type="radio" name="vid4"/>
  <label class="star star-1" for="star-14"></label>
</form>
</div>
			
	<form method="post" action="">
            <label  style=color:#990000;padding-left:15px><b>Comments:</b>
            <input type="text" name="comment">
			<input  style="background-color:#cc0000;  border: none; color:#ffffff;"type="submit"  value="send" />
			</form>		
			</p>
                      
			<div class="clear"></div>
          </div>
          <div class="box_bottom"></div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="pagination"> <span class="disabled"><<</span><span class="current">1</span><a href="#">2</a><a href="#">3</a><a href="#">...</a><a href="#">10</a><a href="#">11</a><a href="#">>></a> </div>
      <div class="clear"></div>
    </div>
    <!--end of left content-->
      <?php include "views/right_sidebar.php"; ?>
    <!--end of right content-->
    <div class="clear"></div>
  </div>
  <!--end of center content-->
  <div class="footer">
    
    <div class="right_footer"> <a href="#">home</a> <a href="#">about us</a> <a href="#">my account</a> <a href="#">register</a> <a href="#">contact us</a> </div>
  </div>
</div>
</body>
</html>