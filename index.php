<?php
error_reporting(0);
session_start();
$conn = mysqli_connect('localhost','root','','phonebook');
?>
<html>
<head>
	<title>Phonebook</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<style type="text/css">
		.heading{
			color:#fff;
			background-color: grey;
			font-size: 20px;
			text-align: left;
			padding: 20px;
		}
		.sec{
          border:1px solid #000;
          height: 500px;
          width: 500px;
          margin:7% 10% 10% 30%;
          
		}
		.search {
  background-color:transparent;
  width:100%;
  padding: 15px;
  margin-top: 15px 10px 0px 10px;
  font-size: 20px;
  border:1px solid #ccc;
  border-radius:2px;
  float:right;
  color:#000;
}
summary{
	outline:none;
}
	.edit
{
    
    border: none;
    outline: none;
    height: 35px;
    background: #3CB371;
    color: #fff;
    font-size: 16px;
    border-radius: 5px;
    
    padding:7px 20px 5px 15px;
}
.delete
{
    border: none;
    outline: none;
    height: 35px;
    background: #FF3F6C;
    color: #fff;
    font-size: 16px;
    border-radius: 5px;
    padding: 7px 15px 6px 15px;
}
.fa-input {
  font-family: FontAwesome, 'Helvetica Neue', Helvetica, Arial, sans-serif;
}
.box{

	 border:1px solid #333; 
	 background-color:#f1f1f1; 
	 width:100%; 
	 height: auto;
	 text-align: center;
	 padding-bottom: 10px;
}
.fa-input1 {
  font-family: FontAwesome, 'Helvetica Neue', Helvetica, Arial, sans-serif;
  font-size: 50px;
  color:#6666ff;
  margin:-15% 10% 5% 80%;
  float: right;
  border-radius: 50%;
} 
	</style>



</head>
<body>
	<div class="sec">
	<div class="heading">
		<h4>PhoneBook</h4>
	</div>
	 <?php 
       $val="";
     if(isset($_GET['search'])){
       $val=$_GET['search'];
      }
      ?>
     <form method="get" action="<?php echo $_SERVER["PHP_SELF"];?>">
      <input type="search" placeholder="Search..." name="search" id="mySearch" class="search " value="<?php echo $val; ?>" >
    </form>
      <br><br><br>
     <?php
     if($_GET['edit']){
     $_SESSION['id']=$_GET['hidden_id'];
     header("Location: edit.php");
   }

     if($_GET['delete']){
   $id=$_GET['hidden_id'];
 $query="DELETE FROM phonebook WHERE id ='$id'";
 $result=mysqli_query($conn,$query);
 if($result){
    echo "<script>alert('Contact deleted');</script>";
     
}
else{
    echo "<script>alert('Failed to delete Contact');</script>";
}
}
      

      if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$LIMIT = 5;
$offset = ($pageno-1) * $LIMIT; 

$total_page = "SELECT COUNT(*) FROM phonebook";
$result3 = mysqli_query($conn,$total_page);
$total_rows = mysqli_fetch_array($result3)[0];
$total_pages = ceil($total_rows / $LIMIT);

     
                $sql = "SELECT name,phone,email,birthday FROM phonebook WHERE name LIKE '$val%' ORDER BY name ASC limit $offset,$LIMIT";
                    $result = $conn->query($sql);
 
                         if ($result->num_rows > 0) {
                            // output data of each row
                         while($row = $result->fetch_assoc()) {
                            ?>
                   <form method="get" action="<?php echo $_SERVER["PHP_SELF"];?>"> 
                   <div class="box		`">   
              <div class="row">
                <div class="col-md-6 "><h4><?php echo $row["name"]; ?></h4></div>
                <div class="col-md-6 "></div>
                <details >
                	<summary style="font-size:18px; color:#3ea4c4; border:none; margin-top:5px; ">Details</summary>
                	<br>
                
                
                 
                <div class="col-md-6"><h4><i class="fa fa-phone" aria-hidden="true">&nbsp;<?php echo $row["phone"]; ?></i></h4></div>
                <div class="col-md-6"><h4> <i class="fa fa-envelope icon"></i>&nbsp;<?php echo $row["email"]; ?></h4></div>  
                <input type="hidden" name="hidden_id" value="<?php echo $row["id"]; ?>" />
                <div class="col-md-6 "><h4><?php echo $row["birthday"]; ?></h4> </div>
                <div class="col-md-6">
             <input type="submit" name="edit" class="edit fa-input" id="edit" value="&#xf040; Edit">
          <input type="submit" name="delete" class="delete fa-input" id="delete" value="&#xf014; Delete"></div>   

                    </details>    
              </div>
          </div>
                </form>

              <?php
               }
                    }
              
           ?>
           </div>
    <div>
    	 
    	<a href="create.php" name="new" id="new"><i class="far fa-plus-circle fa-input1" ></i></a>
    </div>
      
               <section>
<div class="container text-center" style="width:100%; margin-top:50px;">
 <ul class="pagination  pagination-lg justify-content-center">
    <li><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
  </ul>
  <!-- <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li> -->
</div>

    </section>     
        </div><!-- container -->
</section>
</div>
</body>