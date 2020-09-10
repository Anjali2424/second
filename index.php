<?php
error_reporting(E_ALL ^ E_NOTICE);


$conn = new mysqli('localhost','root','','blue');  
if($conn->connect_errno){                         
	echo 'Conection Error';
}

if(isset($_POST['submit'])) { 

   $id= $_POST['id'];

   $name = $_POST['name'];

   $email = $_POST['email'];
  

   $phone = $_POST['phone'];
  

   $call1 = $_POST['call1'];
 
	 if(!empty($_POST['s1']) && !empty($_POST['s2']) && !empty($_POST['s3'])) {
		 $a = $_POST['s1'];
  $b = $_POST['s2'];
    $c = $_POST['s3'];
	
	$d=$a.'-'.$b.'-'.$c; 
		 
	 }
		 
		 
	
   $budget = $_POST['budget'];
    $service = "";
    foreach($_POST['service'] as $i) {
        $service.=$i.',';
    }
  $date= date('Y-m-d');
  $image = $_FILES['image']['name'];
  $fileext = pathinfo($image,PATHINFO_EXTENSION);
  if(!($fileext=="jpg" || $fileext=="png" || $fileext=="jpeg" || $fileext=="gif")) {
	  echo "Sorry File type not correct";
	  
  } else {
   if($stmt = $conn->prepare("INSERT INTO contact SET  id=?,fname = ?,email= ?,phone= ?,call1 = ?,budget = ?,service = ?,image=?,date=?,dob=?"))  
   {
	   
	$stmt->bind_param('isssssssss' ,$id,$name,$email,$phone,$call1,$budget,$service,$image,$date,$d); 
	$stmt->execute();  
	   if($stmt->affected_rows==1) {
		   move_uploaded_file($_FILES['image']['tmp_name'],'upload/'.$image);
		   echo "Insert";
	   }
	}
  }
}



?>






<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Contact Us</title>
<style>
  label{
	  display:inline-block;
	  width:150px;
	   }
           
           

</style>
</head>
<body style="margin:0;background:#1c478e;color:#fff">
<h1 style="margin:0;padding:5px;background:#333;color:#fff" >
  	Blue Developer Directory
 </h1>
  <div>
<center>
     <h3>Contact Us</h3>
     <p>Please use this form to contact a member of our website team</p>
    <form  method="post" name="form1" enctype="multipart/form-data">

        <p>
        

       </p>
       <p>
       
         <input type="hidden" name="id" size="30" >
       </p>
       <p>
         <label for="name">Full Name:</label>
         <input type="text" name="name" size="30" required placeholder="Enter Your Name">
       </p>
<p>
        

       </p>
        <p>
         <label for="email">Email Address:</label>
         <input type="email" name="email" size="30"  placeholder="Enter Your Email ID">
       </p>
        <p>
         <label for="phone">Phone Number:</label>
         <input type="text" name="phone" size="30" placeholder="Enter Your Phone Number" required>
       </p>
      
        <p>
         <label for="call">Best Time To Call:</label>
         <input type="radio" name="call1" value="morning" checked>morning
         <input type="radio" name="call1" value="afternoon">afternoon
         <input type="radio" name="call1" value="evening">evening
         </p>
         
         <p>
         <label for="budget">Budget:</label>
         <select type="list" name="budget" style="width:20%;">
          <option>--Select One--</option>
           <option value="100-500">$100-$500</option>
           <option value="100-500">$100-$500</option>
           <option value="100-500">$100-$500</option>
           <option value="100-500">$100-$500</option>
           <option value="100-500">$100-$500</option>
           <option value="not sure">Not Sure</option>
           </select>
         
         
         </p>
         
         <p>
         <label for="services">Service Needed:(Check all that apply)</label>
         <table width="200px" border=2">
      
            <td><input type="checkbox" name="service[]" value="html" >html</td>
             <td><input type="checkbox" name="service[]" value="php">php</td>
        
          <tr>
            <td><input type="checkbox" name="service[]" value="asp">asp</td>
             <td><input type="checkbox" name="service[]" value="java">java</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="service[]" value="design">Design</td>
             <td><input type="checkbox" name="service[]" value="c">c</td>
          </tr>
         
          <tr>
              <td><label for="Image">Image :</label></td>
            <td><input type="file" name="image"></td>
           
          </tr>
         </table>
         </p>
          <p>
         <label for="dob">Date of birth:</label>
         
         <select name="s1">
         <?php
		 $date = range(1,30);
		 foreach($date as $i){

		 ?>
         <option value="<?php echo $i;?>"><?php echo $i;?></option>
         <?php
		 }
		 ?>
         </select>
          <select name="s2">
            
         <?php
		 $date = range(1,12);
		 foreach($date as $i){

		 ?>
       
    
         <option value="<?php echo $i;?>"><?php echo $i;?></option>
         <?php
		 }
		 ?>
         </select>
          <select name="s3">
         
         <?php
		 $date = range(1880,2020);
		 foreach($date as $i){

		 ?>
       
         <option value="<?php echo $i;?>"><?php echo $i;?></option>
         <?php
		 }
		 ?>
         </select>
       </p>
         <p>
            <input type="submit" name="submit" value="submit" >
         </p>
      </form>
  
  </center>
  </div>

