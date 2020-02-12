<?php
require "includes/includes.php";



  

 
 
 
 
 $isSelectSearch = 0  ;
 $countResult =0 ; 
  if (isset($_GET['word']) && ( $_GET["word"] != "")  || isset($_GET['minprice']) && ( $_GET["minprice"] != "")   || isset($_GET['rating']) && ( $_GET["rating"] != "")   || isset($_GET['location']) && ( $_GET["location"] != "")  )
  {
	  $qey = ""; 
	  
	  $qry = $qry . "SELECT products.*, IFNULL(products_rating.rating,0)    as 'rating'  , IFNULL(users.location,'')    as 'location'  FROM products left JOIN products_rating
ON products.id=products_rating.product_id

left JOIN users
ON products.owner_id=users.id 

where 1=1  " ;


$eg =  str_replace(" ","%",$_GET['word'] );


if (( $_GET["word"] != "") ) 
{
	 $qry = $qry . " and   products.product_name like '%".$eg   . "%'  " ;

	
	

	 }
 if (( $_GET["minprice"] != "")  &&   ( $_GET["maxprice"] != "")   ) 
	 $qry = $qry . " and   products.price  between ".$_GET['minprice']  . " and ".$_GET['maxprice']  . "   " ;
 

 if (( $_GET["rating"] != "0" )     ) 
	 $qry = $qry . " and   products_rating.rating =".$_GET['rating']  ."    " ;
 
 if (( $_GET["location"] != "0" )     ) 
	 $qry = $qry . " and   users.location ='".$_GET['location']  ."'    " ;

  
   	  $qry = $qry  . "    order by sort_id desc  ";
	   
	   $promotion_products = $db->getRows($qry);	
	   $isSelectSearch = 1  ;
	   $countResult = count($promotion_products); // output 2
		
  }
  else 
	
$promotion_products = $db->getRows("SELECT products.*, IFNULL(products_rating.rating,0)    as 'rating' FROM products left JOIN products_rating
ON products.id=products_rating.product_id  order by sort_id desc ");	

//die (print_r($promotion_products )) ;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Eav touch - Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style> 


.checked {
    color: orange;
	padding:5px;
}


</style>
</head>
<body>
<div id="wrap">
  <?php include "views/header.php"; ?>
  
 <div class="center_content">
    <div class="left_content">
      <div class="title"><span class="title_icon">
	  <img src="images/featuredProd.png" alt="" /></span>
	  <?php  if ($isSelectSearch ==0) echo "Featured Products" ;  else  echo "Search Result ( " .$countResult  ." ) : " ;?>
	  </div>

     <?php if ($promotion_products) : ?>
     <?php foreach ($promotion_products as $promotion_product) : ?>
	 
	 
	 <?php
	 
if (( $_GET["word"] != "") ) 
{
	  
	 /////////////////////////////////////////////////////////////////////////////////////////
	  $once =  0 ;
if ($once  == 0 ){	  
	
$max = $db->getRows("SELECT max(sort_id)  as ms from products");	
  
 $anas=0 ; 
  foreach ($max as $ffffff) {
	 
 $anas =strval( (int)( $ffffff->ms  ) +1 )  ;
    
 }
  
  
	  if ($db->update("products",
        [
            "sort_id" => $anas
        ]
    ," id=" .$promotion_product->id  )) {
 
 
	}
	$once  = -1 ;
	 
	
	}
	}
	///////////////////////////////////////////////////////////////////////////////////////////
	
   ?> 
	<div class="feat_prod_box">
	<div class="prod_img"><a href="#"><img width=150 height=150 src="<?= $promotion_product->product_image_path; ?>" alt="" border="0" /></a></div>
        <div class="prod_det_box">
          <div class="box_top"></div>
          <div class="box_center">
            <div style="color:#000000" class="prod_title"><b> <?= $promotion_product->product_name; ?> </b></div><br>
            <p style=color:#990000 class="details">


                <b>price : <?= $promotion_product->price; ?> $</b>

                <br>

                <b>Status :<span
                            style="color: <?= $productStatus[$promotion_product->product_status][1] ?>;"> <?= $productStatus[$promotion_product->product_status][0]; ?></span></b>
                <br>
                <b> Phone : <span style="color:black"><?= $promotion_product->phone ?></span></b>
                <br>
                <b>Description : <span style="color:black"><?= $promotion_product->description ?></span></b>
                <br>
				 <b>Rating : <span style="color:black"><?= $promotion_product->rating ?></span></b>
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
                                           data-productid="<?= $product->id; ?>" <?= $product->id; ?>" <?= $user_rating == 4 ? "checked": "" ?>"/>
                                    <label class="star star-4" for="star-4<?= $product->id; ?>"></label>
                                    <input class="star star-3" id="star-3<?= $product->id; ?>" type="radio"
                                           name="<?= $product->id; ?>" value="3"
                                           data-type="<?= intval($_GET['type']); ?>"
                                           data-productid="<?= $product->id; ?>" <?= $product->id; ?>" <?= $user_rating == 3 ? "checked": "" ?>"/>
                                    <label class="star star-3" for="star-3<?= $product->id; ?>"></label>
                                    <input class="star star-2" id="star-2<?= $product->id; ?>" type="radio"
                                           name="<?= $product->id; ?>" value="2"
                                           data-type="<?= intval($_GET['type']); ?>"
                                           data-productid="<?= $product->id; ?>" <?= $product->id; ?>" <?= $user_rating == 2 ? "checked": "" ?>"/>
                                    <label class="star star-2" for="star-2<?= $product->id; ?>"></label>
                                    <input class="star star-1" id="star-1<?= $product->id; ?>" type="radio"
                                           name="<?= $product->id; ?>" value="1"
                                           data-type="<?= intval($_GET['type']); ?>" <?= $product->id; ?>" <?= $user_rating == 1 ? "checked": "" ?>"
                                           data-productid="<?= $product->id; ?>"/>
                                    <label class="star star-1" for="star-1<?= $product->id; ?>"></label>
                                </div>
                                <form method="post" action="">
                                    <label style=color:#990000;padding-left:15px><b>
                                            <small>Message:</small>
                                        </b></label>
                                        <input type="text" name="comment">
                                        <input style="background-color:#cc0000;  border: none; color:#ffffff;"
                                               type="submit" value="send"/>
                                </form>
								<form method="post" action="check.php">
                    <input type="hidden" name="product" value="<?= $promotion_product->id ?>">

								<div id="pro_buy">
								<label style="color:#990000;padding-left:15px"><b>
								<small>Quantity:</small>
                                    </b></label>
                                        <input type="number" name="qty" value="1" min="1" max="6"  style="width:50%"/>
                                      <input type="submit"  name="Add_cart" value="Add cart"  style="background-color:#cc0000;color:#ffffff;" />
                                           </div>
								</form>

	


			

            <div class="clear"></div>
          </div>
          <div class="box_bottom"></div>
        </div>
                                        
        <div class="clear"></div>
      </div>
                                    								

        <?php endforeach;?>
        <?php endif;?>
      <div class="clear"></div>
    </div>
	
    
    <!--end of left content-->

	<?php

	echo"<div class=cart>
        <div class=title><span class=title_icon><img src=images/cart.gif alt= /></span>My cart</div>
        <div class=home_cart_content> 3 x items | <span class=red>TOTAL: 100$</span> </div>
        <a href=cart.php class=view_cart>view cart</a> </div>";
	
	
	
	
	?>
	
	

     <?php include "views/right_sidebar.php"; ?>
	 
	 
	 <?php
	 
	 if (isset($_GET['word']) )   
		 if ( $_GET["word"] != "")
			 
 
		 
	 
	 ?>
	 
	  
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