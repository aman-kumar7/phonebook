<?php
error_reporting(0);
session_start();
$conn=mysqli_connect('localhost','root','','phonebook');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id=$_SESSION['id'];
$sql = "SELECT name,email,phone,birthday FROM phonebook WHERE id='$id'";
           $result = $conn->query($sql);

                         if ($result->num_rows > 0) {
                            // output data of each row
                         while($row = $result->fetch_assoc()) {
                            $name=$row["name"];
                            $email=$row["email"];
                            $phone=$row["phone"];
                            $birthday=$row["birthday"];
                          
                        }
                    }
        
 $nameErr=$emailErr=$phoneErr=$birthdayErr="";
        if($_POST["save"])
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
    $sql ="UPDATE phonebook SET name='$name',email='$email',phone='$phone',birthday='$birthday' WHERE id='$id'";
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<style type="text/css">
  input[type="number"]
{
    border: none;
    border: 1px solid #fff;
    background: transparent;
    outline:none;
    height: 30px;
    color:#fff;
    font-size: 16px;
    width:50%;
    padding: 10px;
    margin:15px;
}
.signup-box{
    width: 90%;
    height:97%;
    background: rgba(0, 0, 0, 0.7);
    color: #fff;
    margin:5% 2% 2% 5%;
    position:absolute;
  
    padding-top:2vh;
    padding-bottom:5vh;
}
.signup-box input{
   height: 10%;
    width: 30%;
    margin-bottom: 20px;
}

.signup-box input[type="text"], input[type="password"], input[type="email"], input[type="number"],input[type="date"]

{
    border: none;
    border: 1px solid #fff;
    background: transparent;
    outline:none;
    height: 30px;
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
    background:#3CB371;
    color:#fff;
    font-size: 18px;
    border-radius: 20px;
}
.btnsignup{
    
}

.signup-box input[type="submit"]:hover{
    cursor: pointer;
    background:green;
    color:white;
    opacity: 0.8;
    
}
.fa-input {
  font-family: FontAwesome, 'Helvetica Neue', Helvetica, Arial, sans-serif;
}
::placeholder{
  color:#fff;
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
</style>
<center>
<div class="signup-box">
  <h3>Edit Contact</h3>
<form name="myForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 <p>

     <label for="name">Name</label><br>
     <input type="text" name="name"  placeholder="Name" value="<?php  echo $name;?>">
    <br>
          <span class="error"><?php echo $nameErr;?></span><br>
     
     <label >Email Id</label><br>
        <input type="email" name="email" placeholder="eg. John27@gmail.com" value="<?php  echo $email;?>"><br>
          <span class="error"><?php echo $emailErr;?></span><br>
     <label>Birthday</label><br>
        <input type="date" name="birthday" placeholder="Birthday" value="<?php  echo $birthday;?>"><br>
          <span class="error"><?php echo $birthdayErr;?></span><br>
  
     <label >Phone Number</label><br>
       <input type="number" name="phone" placeholder="Phone Number" maxlength="10" value="<?php  echo $phone;?>"><br>
         <span class="error"><?php echo $phoneErr;?></span><br>
      
  </p>    

  <div class="btnsignup">
     <input type="submit" name="save" class="save fa-input" id="save" value="&#xf040; Save"> 
     <button class="back"><a href="index.php" class="back1">Back</a></button>
  </div>
  </form> 
  </div>  
</center>
</html>
