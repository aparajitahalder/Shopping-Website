<?php   
 session_start();  
 $connect = mysqli_connect("localhost", "root", "", "test");  
 if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_GET["id"],  
                     'item_name'               =>     $_POST["hidden_name"],  
                     'item_price'          =>     $_POST["hidden_price"],  
                     'item_quantity'          =>     $_POST["quantity"]  
                );  
                $_SESSION["shopping_cart"][$count] = $item_array;  
           }  
           else  
           {  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location="index.php"</script>';  
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],  
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"],  
                'item_quantity'          =>     $_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
 }  
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo '<script>alert("Item Removed")</script>';  
                     echo '<script>window.location="index.php"</script>';  
                }  
           }  
      }  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>MainPage</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
		   <style>
		      .home {
position:fixed;
top: 0px;
right: 0px;
font-size: 60px;
	color: black;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    margin: 0px;
    cursor: pointer;
	font-family:Georgia;
	font-style: italic;
	font-weight: bold;
	height: 100%;
	width: 20%;
	background-color: #111;
	 
	}
.home1 {
position:fixed;
top: 10px;
left: 400px;
font-size: 100px;
	color: black;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    margin: 0px;
    cursor: pointer;
	font-family:Georgia;
	font-style: italic;
	font-weight: bold;
	height: 100%;
	width: 20%;
	}
.c{
position: fixed;
	top: 50px;
	right: 50px;
	border-radius: 70%;
 
	}
.g{
position: fixed;
	top: 270px;
	right: 50px;
	border-radius: 70%;
 
	}
.f{
position: fixed;
	top: 500px;
	right: 50px;
	border-radius: 70%;
 
	}

	.e{
position: fixed;
	top: 0px;
	right: 0px;
}
.sidenav {
  height: 100%;
  width: 240px;
  position: fixed;
  top: 0px;
  left: 0px;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 40px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 160px; /* Same as the width of the sidenav */
  font-size: 70px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 100px;}
}
.final{
	position:absolute;
	top: 150px;
	right: 450px;
}

		   </style>
      </head>  
      <body style="background-color: Lightgrey">  
	   <header>
	   
	    
<div class="sidenav">
<br><br><br>
  <a href="FirstPage.html">Logout</a><br><br>
  <a href="cart.php">Cart</a><br><br>
  <a href="contact.html">Contact</a><br><br>
  <a href="aboutus2.html">About Us</a><br><br>
  <a href="sell1.php">Sell</a>
</div>
 <div class="home1"> GrandBazaar<br>
 <div class="home"> 
 <img class="c" src="bg5.jpg" height="200 px" width="200 px" >
<img class="g" src="COD.png" height="200 px" width="200 px" >
<img class="f" src="bestoffer.jpg" height="200 px" width="200 px" >
</div><br><br><br><br><br>


 </header>
 <div class="final">
           <br />  
           <div class="container" style="width:700px;">  
                <?php  
                $query = "SELECT * FROM tbl_product ORDER BY id ASC";  
                $result = mysqli_query($connect, $query);  
                if(mysqli_num_rows($result) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
                ?>  
                <div class="col-md-4">  
                     <form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">  
                          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center"> 

<?php  
               
					 echo '  
					      <tr>  
                               <td>  
                                    <img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" height="200" width="200" class="img-responsive" />  
                               </td> 
                                					   
                          </tr>
                     ';  
					 			        

                 
                ?>						  
					           <h4 class="text-info"><?php echo $row["name"]; ?></h4>  
                               <h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>  
                               <input type="text" name="quantity" class="form-control" value="1" />  
                               <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />  
                               <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
                               <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />  
                          </div>  
                     </form>  
                </div>  
                <?php  
                     }  
                }  
                ?>  
                <div style="clear:both"></div>  
                <br />  
                
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          
                          <?php   
                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {  
                          ?>  
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                               }  
                          ?>  
                          
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
           <br />  
		   </div>
      </body>  
 </html>
   