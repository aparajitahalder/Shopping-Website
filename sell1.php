<?php  
 $connect = mysqli_connect("localhost", "root", "", "test");  
 $name = $_POST['name'];
    $name = strip_tags($name);
    $name = htmlspecialchars($name);
	$price = $_POST['price'];
    $price= strip_tags($price);
    $price= htmlspecialchars($price);

 if(isset($_POST["insert"]))  
 {  
      $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
      $query = "INSERT INTO tbl_product(image,name,price) VALUES ('$file','$name','$price')";  
      if(mysqli_query($connect, $query))  
      {  
           echo '<script>alert("Image Inserted into Database")</script>';  
      }  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>SELL</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
		   <style>
		   .final{
	position:absolute;
	top: 150px;
	right: 500px;
	color: white;
	
}
		   </style>
      </head>  
      <body style="background-color:black">  
           <br /><br />  
		   	    

		   <div class="final" >
           <div class="container" style="width:500px;">  
                <h3 align="center">Insert your product details</h3>  
                <br />  
                <form method="post" enctype="multipart/form-data">  
				 <div class="form-group">
                    <label for="name" class="control-label">NAME</label>
                    <input type="text" name="name" class="form-control">
                    <span class="text-danger"><?php if(isset($errorName)) echo $errorName; ?></span>
                </div>
               <div class="form-group">
                    <label for="price" class="control-label">PRICE</label>
                    <input type="text" name="price" class="form-control">
                    <span class="text-danger"><?php if(isset($errorPrice)) echo $errorPrice; ?></span>
                </div>
               
                     <input type="file" name="image" id="image" />  
                     <br />  
                     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />  <br><br>
					 <a href="index.php">Back to Home Page</a>
                </form>  
                <br />  
                <br />  
                 
           </div>  
           </div>
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#insert').click(function(){  
           var image_name = $('#image').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script>  
