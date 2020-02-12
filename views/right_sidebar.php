<?php

// get cats and it's subs .
// this method isn't good , but easier . we don't have time :)


$products_main_cats = $db->getRows("SELECT * FROM products_main_categories");
$services_main_cats = $db->getRows("SELECT * FROM services_main_categories");
//
$products_sub_cats = $db->getRows("SELECT * FROM products_sub_categories");
$services_sub_cats = $db->getRows("SELECT * FROM services_sub_categories");

?>
<style>
.text-select{
    border-top:thin solid  #e5e5e5;
    border-right:thin solid #e5e5e5;
    border-bottom:0;
    border-left:thin solid  #e5e5e5;
    box-shadow:0px 1px 1px 1px #e5e5e5;
    
    height:27px;
    margin:.8em 0 0 .5em; 
    outline:0;
    padding:.4em 0 .4em .6em; 
    width:169px; 
}

.text-input{
    border-top:thin solid  #e5e5e5;
    border-right:thin solid #e5e5e5;
    border-bottom:0;
    border-left:thin solid  #e5e5e5;
    box-shadow:0px 1px 1px 1px #e5e5e5;
    
    height:17px;
    margin:.8em 0 0 .5em; 
    outline:0;
    padding:.4em 0 .4em .6em; 
    width:70px; 
}


#search-text-input{
    border-top:thin solid  #e5e5e5;
    border-right:thin solid #e5e5e5;
    border-bottom:0;
    border-left:thin solid  #e5e5e5;
    box-shadow:0px 1px 1px 1px #e5e5e5;
    
    height:17px;
    margin:.8em 0 0 .5em; 
    outline:0;
    padding:.4em 0 .4em .6em; 
    width:257px; 
}
  
#button-holder{
    background-color:#f1f1f1;
    border-top:thin solid #e5e5e5;
    box-shadow:1px 1px 1px 1px #e5e5e5;
    cursor:pointer;
    float:left;
    height:27px;
    margin:11px 0 0 0;
    text-align:center;
    width:50px;
}
  
#button-holder img{
    margin:4px;
    width:20px; 
}
.myButton {
	    margin-left: 60px;
    margin-top: 11px;
	background-color:#44c767;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	border-radius:5px;
	border:1px solid #18ab29;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:17px;
	padding:4px 20px;
	text-decoration:none;
	text-shadow:0px 1px 0px #2f6627;
}
.myButton:hover {
	background-color:#5cbf2a;
}
.myButton:active {
	position:relative;
	top:1px;
}


</style>
<div class="right_content">
    <div class="title"><span class="title_icon"><img src="images/search-icon-png-25.png" alt="" width="32px" height="32px" style="    margin-top: -9px;"/></span>Search Products & Service</div>
<form  method="GET" action="index.php">
    <div class="about">
	
        <div style="height:200px;border:1px solid #d1cfcf; border-radius:6px;padding-left:8px;"> 
		Word : <input type='text' name="word"  placeholder='Search...' id='search-text-input' style="    margin-left: 23px;"   value="<?php echo $_GET["word"]?>" />
		 
		<br> 
		 <div style="display:block;">
		Price : <input type="text" name="minprice"  value="<?php echo $_GET["minprice"]?>"  placeholder="min" class="text-input" style="    margin-left: 23px;"/> - 
		<input type="text" name="maxprice"    value="<?php echo $_GET["maxprice"]?>"   placeholder="max" class="text-input"/>
		 </div>
		 
		 
		  <div style="display:block;">
		Rating : <select name="rating" class="text-select" style="    margin-left: 16px;"   >
		<option value="0" <?php     if (isset($_GET['rating']) )   if ( $_GET["rating"] == "0") echo "selected"    ?> > --All-- </option>
		<option value="1" <?php     if (isset($_GET['rating']) )   if ( $_GET["rating"] == "1") echo "selected"    ?> >1</option>
		<option value="2" <?php     if (isset($_GET['rating']) )   if ( $_GET["rating"] == "2") echo "selected"    ?> >2</option>
		<option value="3" <?php     if (isset($_GET['rating']) )   if ( $_GET["rating"] == "3") echo "selected"    ?> >3</option>
		<option value="4" <?php     if (isset($_GET['rating']) )   if ( $_GET["rating"] == "4") echo "selected"    ?> >4</option>
		<option value="5" <?php     if (isset($_GET['rating']) )   if ( $_GET["rating"] == "5") echo "selected"    ?> >5</option>
		
		
		</select>
		 </div>
		 
		  <div style="display:block;">
		Location : <select name="location" class="text-select">
		<option value="0"  <?php     if (isset($_GET['location']) )   if ( $_GET["location"] == "0") echo "selected"    ?> > --All-- </option>
		<option value="Amman"  <?php     if (isset($_GET['location']) )   if ( $_GET["location"] == "Amman") echo "selected"    ?> >Amman</option>
		<option value="Zarqa"  <?php     if (isset($_GET['location']) )   if ( $_GET["location"] == "Zarqa") echo "selected"    ?> >Zarqa</option>
		<option value="Irbid"  <?php     if (isset($_GET['location']) )   if ( $_GET["location"] == "Irbid") echo "selected"    ?> >Irbid</option>
		 
		</select>
		 </div>
		 
		 <div>
		 <input type="submit" value="Search" class="myButton"   /> 
		 </div>
		 
    </span>
	
		
		<br><br></div>
    </div>


</form>

    <div class="right_box">
        <div class="title"><span class="title_icon"><img src="images/promotion.png" alt=""/></span>Promotions</div>
        <div class="new_prod_box"><a href="#">Food</a>
            <div class="new_prod_bg"><span class="new_icon"><img width=150 height=120 src="images/food.jpeg"
                                                                 alt=""/></span> <a href="#"><img
                            src="images/thumb1.gif" alt="" class="thumb"  width="139px" height="139px" border="0"/></a></div>
        </div>
        <br>
        <div class="new_prod_box"><a href="#">Tutor</a>
            <div class="new_prod_bg"><span class="new_icon"><img width=150 height=120 src="images/teacher.jpg" alt=""/></span>
                <a href="#"><img src="images/thumb2.gif" alt="" class="thumb" width="139px" height="139px" border="0"/></a></div>
        </div>
        <br>
        <div class="new_prod_box"><a href="#">Photographer</a>
            <div class="new_prod_bg"><span class="new_icon"><img width=150 height=120 src="images/photographer.jpg"
                                                                 alt=""/></span> <a href="#"><img
                            src="images/thumb3.gif" alt="" class="thumb" width="139px" height="139px" border="0"/></a></div>
        </div>
        <br>
    </div>
    <div class="right_box">
        <div class="title"><span class="title_icon"><img src="images/services.png" alt=""/></span>
            <small>Products & Service</small>
        </div>
        <ul class="list">

            <?php foreach ($products_main_cats as $product_main_cat) : ?>
            <li><b><span class="title_icon"><img src="<?= $product_main_cat->icon_path ?>"
                                                 height="26" width="26"/><?= ucwords(strtolower($product_main_cat->name)) ?></b>
                <ul><br><br>
                    <?php foreach ($products_sub_cats as $product_sub_cat) : ?>
                    <?php if ($product_sub_cat->main_category_id == $product_main_cat->id ) : ?>
                        <li><a href="lister.php?type=1&id=<?= $product_sub_cat->id; ?>"><?= ucwords(strtolower($product_sub_cat->name)); ?></a></li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </li>
            <?php endforeach; ?>

            <?php foreach ($services_main_cats as $service_main_cat) : ?>
                <li><b><span class="title_icon"><img src="<?= $service_main_cat->icon_path ?>"
                                                     height="26" width="26"/><?= ucwords(strtolower($service_main_cat->name)) ?></b>
                    <ul><br><br>
                        <?php foreach ($services_sub_cats as $service_sub_cat) : ?>
                        <?php if ($service_sub_cat->main_category_id == $service_main_cat->id ) : ?>
                            <li><a href="lister.php?type=2&id=<?= $service_sub_cat->id; ?>"><?= ucwords(strtolower($service_sub_cat->name)); ?></a></li>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>


    </div>
</div>
