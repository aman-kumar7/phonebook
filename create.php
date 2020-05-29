<?php
error_reporting(0);
 $conn=mysqli_connect('localhost','root','','phonebook');
 // Check connection
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
 }
       $name=$email=$phone=$birthday=$code="";
       $nameErr=$emailErr=$phoneErr=$birthdayErr="";


         if($_POST["submit"])
        {
            if(empty($_POST["name"]))
            {
                $nameErr = "Name is required";
            }
            else{
                $name = test_input($_POST["name"]);
            }
           
            if(empty($_POST["email"]))
            {
                $emailErr = "Email is required";
            }
            elseif(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL))
            {
                $emailErr = "Invalid email format";
            }
            else
            {
                $email = test_input($_POST["email"]);
            }

           
            if (empty($_POST["phone"])) 
            {
                $phoneErr = "Phone Number is required";
            } 
            else {
                $phone = test_input($_POST["phone"]);
            }
            
           
            if(empty($_POST["birthday"]))
            {
                $birthdayErr = "Birthday is required";
            }
            else{
                $birthday = test_input($_POST["birthday"]);
            }
            if(!empty($name) && !empty($email) && !empty($phone) && !empty($birthday) ){
    $sql ="INSERT INTO phonebook (name,birthday,phone,email) VALUES ('$name','$birthday','$phone','$email')";
            
         if ($conn->query($sql) === TRUE){
          echo "<script>alert('Your Contact has been Successfully Saved');</script>";
             header("Location: home.php");
         }
         else {
     echo "<script>alert('Problem in Creating Contact');</script>";
     }  
 }
 else{
  echo "<script>alert('Already exisiting Account with same Username or Email');</script>";
 }
}
 function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }


?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Contact</title>
</head>
<style type="text/css">
  input[type="number"]
{
    border: none;
    border: 1px solid #fff;
    background: transparent;
    outline:none;
    height: 20px;
    color:#fff;
    font-size: 16px;
    width:50%;
    padding: 10px;
    margin:15px;
}
.signup-box{
    width: 90%;
    height:90%;
    background: rgba(0, 0, 0, 0.7);
    color: #fff;
    margin:5% 2% 2% 5%;
    position:absolute;
  
    padding-top:2vh;
    padding-bottom:5vh;
}
.signup-box input{
height:50%;
    width: 30%;
    margin-bottom: 20px;
}

.signup-box input[type="text"], input[type="email"], input[type="number"],input[type="date"]

{
    border: none;
    border: 1px solid #fff;
    background: transparent;
    outline:none;
    height: 20px;
    color:#fff;
    font-size: 16px;
    width:30%;
    padding: 10px;
    margin:15px 15px 5px 15px;
}


.signup-box input[type="submit"]
{
    border: none;
    outline: none;
    height: 35px;
    width: 120px;
    background:orange;
    color:#fff;
    font-size: 18px;
    border-radius: 20px;
}
.btnsignup{
    
}
.back
{
    border: none;
    outline: none;
    height: 35px;
    width: 120px;
    background:blue;
    color:#fff;
    font-size: 18px;
    border-radius: 20px;
}
.back:hover{
    cursor: pointer;
    background:red;
    color:white;
    opacity: 0.8;
    
}
.back1{
  color:white;
  text-decoration: none;
}
.signup-box input[type="submit"]:hover{
    cursor: pointer;
    background:green;
    color:white;
    opacity: 0.8;
    
}

.error{
	color:red;
}
::placeholder{
	color:#fff;
	opacity: 0.7;
}
</style>
<center>
<div class="signup-box">
  <h3>Create Contact</h3>
<form name="myForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 <p>

     <label >Name</label><br>
     <input type="text" name="name"  placeholder="Name" >
    <br>
          <span class="error"><?php echo $nameErr;?></span><br>
     
     <label >Email Id</label><br>
        <input type="email" name="email" placeholder="eg. John27@gmail.com"><br>
          <span class="error"><?php echo $emailErr;?></span><br>
     <label>Birthday</label><br>
        <input type="date" name="birthday" placeholder="Birthday" ><br>
          <span class="error"><?php echo $birthdayErr;?></span><br>
  
     <label >Phone Number</label><br>
       <input type="number" name="phone" placeholder="Phone Number" maxlength="10"><br>
         <span class="error"><?php echo $phoneErr;?></span><br>
      
  </p>    

  <div class="btnsignup">
     <input type="submit" value="Save" name="submit">
      <button class="back"><a href="index.php" class="back1">Back</a></button>
    <br>

  </div>
  </form> 
  </div>  
</center>
</html>