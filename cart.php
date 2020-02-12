<!DOCTYPE html PUBLIC -//W3C//DTD XHTML 1.0 Transitional//EN http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd>
<html xmlns=http://www.w3.org/1999/xhtml>
<head>
<title>Eav touch</title>
<meta http-equiv=Content-Type content=text/html; charset=windows-1252 />
<link rel=stylesheet type=text/css href=style.css />
    <style>
    
    .modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 200px; /* Location of the box */
  left: 170px;
  top: 0;
  width: 50%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
        
    </style>
</head>
<body>
<div id=wrap>
  <div class=header>
    <div class=logo><a href=#><img  width=150 height=80 src=images/logo.jpg alt= border=0 /></a></div>
    <div id=menu>
      <ul>
        <li><a href=index.php>home</a></li>
        <li><a href=about.php>about us</a></li>
        <li><a href=myaccount.php>my account</a></li>
        <li><a href=register.php>register</a></li>
        <li><a href=contact.php>contact</a></li>
		<li><a href=help.php>help</a></li>
		 <li><a href=index.php>log out </a></li>
      </ul>
    </div>
  </div>
  
  <div class=center_content>
    <div class=left_content>
      <div class=title><span class=title_icon><img src=images/bullet1.gif alt= ""/></span>My cart</div>
      <div class=feat_prod_box_details>
        <table class=cart_table>
          <tr class=cart_title>
            <td>Item pic</td>
            <td>Product name</td>
            <td>Unit price</td>
            <td>Qty</td>
            <td>Total</td>
          </tr>
          <tr>
                      <?php
                    session_start();
$username= $_SESSION['username'];
                    
                        
$con=mysql_connect("localhost","root","12345678");
mysql_select_db("eva_touch_db",$con);

                        
  $firstname="select * from users where user_name='$username' or email='$username'";
$first=mysql_query($firstname,$con);
    $r=mysql_fetch_row($first);
   $userid=$r[0];

              $search="select * from cart where user_id=$userid";
$find=mysql_query($search,$con);
   $z=mysql_num_rows($find);
    while($row=mysql_fetch_row($find)){
   print('<tr style="width:50%">');
    print('<th ><img src="'.$row[1].'" alt="" width="100px" height="50px" /> </th><th>'.$row[2]."</th><th>".$row[3]."</th><th>".$row[4]."</th><th>".$row[5].'</th>');


    print("</tr>");}       
                        ?>
                    </tr>
        </table>
          <button  class="continue"  id="myBtn"> disscount</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <table>
        <tr style="width:50%"><th>   </th><th>discount</th><th>    </th><th>total</th></tr>
        <?php
        $username= $_SESSION['username'];
                    
                        
$con=mysql_connect("localhost","root","");
mysql_select_db("eva_touch_db",$con);

                        
  $firstname="select * from users where user_name='$username' or email='$username'";
$first=mysql_query($firstname,$con);
    $r=mysql_fetch_row($first);
   $userid=$r[0];

              $search="select * from cart where user_id=$userid";
$find=mysql_query($search,$con);
   $z=mysql_num_rows($find);
        $number=0;$count=0;
    while($row=mysql_fetch_row($find)){
   print('<tr style="width:50%">');
    print("<th ></th><th></th><th>  </th><th>".$row[5].'</th>');
    print("</tr>");
    $number+=$row[5];
       $count+=1; 
    } $discount=0;
        if ($count>=5){
        $discount=$number*0.9;
        }else{
            $discount="you less than 5 sale";
        }
        ?>
                <tr><th></th> <th>total</th><th>    </th><th><?=$number ?></th></tr>

        <tr><th></th> <th>10%</th><th>    </th><th><?=$discount ?></th></tr>
  </table>   
  </div>

</div>
                  
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

          
              <style>
    
    .modal1 {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 200px; /* Location of the box */
  left: 170px;
  top: 0;
  width: 50%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content1 {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

.close1 {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close1:hover,
.close1:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
        
    </style>
       

          <form method="post" action="cart.php">
          <button value="" class="checkout"  name="button1" id="">delivary</button> 
        </form>

<!-- The Modal -->
<div id="myModal1" class="modal1">

  <!-- Modal content -->
  <div class="modal-content1">
    <span class="close1">&#120143;</span>
    <table>
        <?php
    if (isset($_POST['button1']))
{
echo'              <tr style="width:50%"><th>   </th><th></th><th>    </th><th>total</th></tr>';

        $username= $_SESSION['username'];
                    
                        
$con=mysql_connect("localhost","root","");
mysql_select_db("eva_touch_db",$con);

                        
  $firstname="select * from users where user_name='$username' or email='$username'";
$first=mysql_query($firstname,$con);
    $r=mysql_fetch_row($first);
   $userid=$r[0];

              $search="select * from cart where user_id=$userid";
$find=mysql_query($search,$con);
   $z=mysql_num_rows($find);
       if($discount==0){
   print('<tr style="width:50%">');
                
    print("<th ></th><th></th><th>  </th><th>".$number.'</th>');
    print("</tr>");}
                    else{
                    print('<tr style="width:50%">');
                
    print("<th ></th><th></th><th>  </th><th>".$number.'</th>');
    print("</tr>");    
                    }
$delete="  DELETE FROM cart WHERE user_id=$userid";
$deleterecord=mysql_query($delete,$con);
echo '<h1 style="text-align:center"> sucessfull delivery </h1>';
    }
        ?>
  </table>   
  </div>

</div>
      </div>
                          
<script id="mm">
// Get the modal
var modal1 = document.getElementById('myModal1');

// Get the button that opens the modal
var btn1 = document.getElementById("myBtn1");

// Get the <span> element that closes the modal
var span1 = document.getElementsByClassName("close1")[0];

// When the user clicks the button, open the modal 
btn1.onclick = function() {
  modal1.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span1.onclick = function() {
  modal1.style.display = "none";
    window.location = 'cart.php';

}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal1) {
    modal1.style.display = "none";
      window.location = 'cart.php';

  }
}
</script>

      <div class=clear></div>
    </div>
    <!--end of left content-->
    <div class=right_content>
      <div class=title><span class=title_icon><img src=images/bullet3.png alt="" /></span>About Us</div>
      <div class=about>
        <p> <img width=100 height=120 src=images/about.png alt= class=right />this website is my gift for each woman that has unique identity and touch that makes her special.for each woman driven by innovation and passion to make extraordinary crafts that express her creativity talent and feminine nature<br><br></p>
      </div>
      <div class=right_box>
        <div class=title><span class=title_icon><img src=images/promotion.png alt="" /></span></div>
        <div class=new_prod_box> <a href=#>Food</a>
          <div class=new_prod_bg> <span class=new_icon><img  width=150 height=120 src=images/food.jpeg alt= ""/></span> <a href=#><img src=images/thumb1.gif alt= class=thumb border=0 /></a> </div>
        </div><br>
        <div class=new_prod_box> <a href=#>Tutor</a>
          <div class=new_prod_bg> <span class=new_icon><img width=150 height=120 src=images/teacher.jpg alt="" /></span> <a href=#><img src=images/thumb2.gif alt= class=thumb border=0 /></a> </div>
        </div><br>
        <div class=new_prod_box> <a href=#>Photographer</a>
          <div class=new_prod_bg> <span class=new_icon><img width=150 height=120 src=images/photographer.jpg alt= ""/></span> <a href=#><img src=images/thumb3.gif alt= class=thumb border=0 /></a> </div>
        </div><br>
      </div>
      <div class=right_box>
        <div class=title><span class=title_icon><img src=images/services.png alt= ""/></span>Service</div>
        <ul class=list>
            <li><b><span class=title_icon><img src=images/makeUp.png alt="" >Make up</span></b>
		  <ul><br><br>
          <li><a href=Perfumes.html>Perfumes</a></li>
          <li><a href=Accessories.html>Accessories</a></li>
          <li><a href=Make up artist.html> Make up artist</a></li>
		  </ul>
              </li></ul>
          <li><b><span class=title_icon><img src=images/clothes.png alt="">Clothes</span></b>
		  <ul><br><br> 
          <li><a href=Scarf.html> Scarf</a></li>
          <li><a href=Jacket.html>Jacket</a></li>
          <li><a href=Shoes.html> Shoes</a></li>
		  </ul></li>
          <li><b><span class=title_icon><img src=images/handMade.png alt= "">Hand made</span></b>
		  <ul><br><br>
          <li><a href= Boxes.html> Boxes</a></li>
          <li><a href=Draw.html>Draw</a></li>
		  <li><a href=Sewing.html>Sewing</a></li>
          <li><a href=Dreams_catcher.html>Dreams catcher</a></li>
		  </ul></li>		  
          <li><b><span class=title_icon><img src=images/food.png alt= "">Food</span></b>
		  <ul><br><br>
          <li><a href=Easer_food.html> East food</a></li>
          <li><a href=Sea_food.html>Sea food</a></li>
		  <li><a href=Sweets.html>Sweets</a></li>        
		  </ul></li>
          <li><b><span class=title_icon><img src=images/teacher.png alt="" >Private Teacher</span></b>
		  <ul><br><br> 
          <li><a href=Home_Tutor.html> Home_Tutor </a></li>
          <li><a href=Center_Tutor.html> Center_Tutor</a></li>  
		  </ul></li>
          <li><b><span class=title_icon><img src=images/photograph.png alt= "">Photographer</span></b>
		  <ul><br><br>
          <li><a href=photo.html>photo</a></li>
          <li><a href=video.html> Video</a></li>  
		  </ul></li>

          <div class=title><span class=title_icon></span></div>
        <ul class=list>
		</ul>
		
          
      </div>
    </div>
    <!--end of right content-->
    <div class=clear></div>
  </div>
  <!--end of center content-->
  <div class=footer>
    <div class=right_footer> <a href=#>home</a> <a href=#>about us</a> <a href=#>my account</a> <a href=#>register</a> <a href=#>contact us</a> </div>
  </div>
</div>
</body>
</html>
