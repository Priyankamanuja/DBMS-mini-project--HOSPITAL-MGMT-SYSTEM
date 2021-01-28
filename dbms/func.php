<?php
session_start();
$con=mysqli_connect("localhost","root","","hmsdb");
if(isset($_POST['login_submit'])){
	$username=$_POST['username'];
	$password=$_POST['password'];
	$query="select * from logintb where username='$username' and password='$password';";
	$result=mysqli_query($con,$query);
	if(mysqli_num_rows($result)==1)
	{
		$_SESSION['username']=$username;
		header("Location:admin-panel.php");
	}
	else
		header("Location:error.php");
}

if(isset($_POST['update_data']))
{
	$contact=$_POST['contact'];
	$status=$_POST['status'];
	$query="update appointmenttb set payment='$status' where contact='$contact';";
	$result=mysqli_query($con,$query);
	if($result)
		header("Location:updated.php");
}
if(isset($_GET['delete_data']))
{
  $ano=$_GET['ano'];
  $query="delete from appointmenttb where ano='$ano';";
  $result=mysqli_query($con,$query);
  if($result)
    header("Location:deleted.php");
}
if(isset($_GET['delete_doc']))
{
  $id=$_GET['id'];
  $query="delete from doctb where id='$id';";
  $result=mysqli_query($con,$query);
  if($result)
    header("Location:deleted.php");
}
if(isset($_GET['delete_staff']))
{
  $id=$_GET['id'];
  $query="delete from staff where id='$id';";
  $result=mysqli_query($con,$query);
  if($result)
    header("Location:deleted.php");
}
function display_docs()
{
	global $con;
	$query="select * from doctb";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
		$name=$row['name'];
		echo '<option value="'.$name.'">'.$name.'</option>';
	}
}
function display_staff()
{
  global $con;
  $query="select * from staff";
  $result=mysqli_query($con,$query);
  while($row=mysqli_fetch_array($result))
  {
    $name=$row['name'];
    echo '<option value="'.$name.'">'.$name.'</option>';
  }
}
if(isset($_POST['staff_sub']))
{
  $id=$_POST['id'];
  $name=$_POST['name'];
  $contact=$_POST['contact'];
  $email=$_POST['email'];
  $query="insert into staff(id,name,contact,email)values('$id','$name','$contact','$email');";
  $result=mysqli_query($con,$query);
  if($result)
    header("Location:staff.php");
}
if(isset($_POST['doc_sub']))
{
  $id=$_POST['id'];
  $name=$_POST['name'];
  $specification=$_POST['specification'];
  $contact=$_POST['contact'];
  $query="insert into doctb(id,name,specification,contact)values('$id','$name','$specification','$contact');";
  $result=mysqli_query($con,$query);
  if($result)
    header("Location:adddoc.php");
}
function get_doctors_details()
{
  global $con;
  $query="select * from doctb";
  $result=mysqli_query($con,$query);
  while ($row=mysqli_fetch_array($result))
  {
    $id=$row['id'];
    $name=$row['name'];
    $specification=$row['specification'];
    $contact=$row['contact'];
    echo "<tr>
      <td>$id</td>
      <td>$name</td>
      <td>$specification</td>
      <td>$contact</td>
    </tr>";
  }
}
function get_patients_details()
{
  global $con;
  $query="select * from appointmenttb";
  $result=mysqli_query($con,$query);
  while ($row=mysqli_fetch_array($result))
  {
    $ano=$row['ano'];
    $fname=$row['fname'];
    $lname=$row['lname'];
    $email=$row['email'];
    $contact=$row['contact'];
    $doctor=$row['doctor'];
    $payment=$row['payment'];
    $wid=$row['wid'];
    $allocated_staff=$row['allocated_staff'];
    echo "<tr>
      <td>$ano</td>
      <td>$fname</td>
      <td>$lname</td>
      <td>$email</td>
      <td>$contact</td>
      <td>$doctor</td>
      <td>payment</td>
      <td>$wid</td>
      <td>$allocated_staff</td>
    </tr>";
  }
}
function display_admin_panel(){
	echo '<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <a class="navbar-brand" href="#"><i class="fa fa-user-plus" aria-hidden="true"></i>Wellness Hospital Center</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav mr-auto">
       <li class="nav-item">
        <a class="nav-link" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method="post" action="search.php">
      <input class="form-control mr-sm-2" type="text" placeholder="enter contact number" aria-label="Search" name="contact">
      <input type="submit" class="btn btn-outline-light my-2 my-sm-0 btn btn-outline-light" id="inputbtn" name="search_submit" value="Search">
    </form>
  </div>
</nav>
  </head>
  <style type="text/css">
    button:hover{cursor:pointer;}
    #inputbtn:hover{cursor:pointer;}
  </style>
  <body style="padding-top:50px;">
 <div class="jumbotron" id="ab1"></div>
   <div class="container-fluid" style="margin-top:50px;">
    <div class="row">
  <div class="col-md-4">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Appointment</a>
      <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Payment Status</a>
      <a class="list-group-item list-group-item-action" id="list-delete-list" data-toggle="list" href="#list-delete" role="tab" aria-controls="delete">Delete Status</a>
      <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Doctors Details</a>
       <a class="list-group-item list-group-item-action" id="list-show-list" data-toggle="list" href="#list-show" role="tab" aria-controls="show">Patients Details</a>
      <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Doctors Section</a>
       <a class="list-group-item list-group-item-action" id="list-attend-list" data-toggle="list" href="#list-attend" role="tab" aria-controls="settings">Staffs Section</a>
    </div><br>
  </div>
  <div class="col-md-8">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <center><h4>Create an appointment</h4></center><br>
              <form class="form-group" method="post" action="appointment.php">
                <div class="row">
                  <div class="col-md-4"><label>First Name:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="fname"></div><br><br>
                  <div class="col-md-4"><label>Last Name:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control"  name="lname"></div><br><br>
                  <div class="col-md-4"><label>Email id:</label></div>
                  <div class="col-md-8"><input type="text"  class="form-control" name="email"></div><br><br>
                  <div class="col-md-4"><label>Contact Number:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control"  name="contact"></div><br><br>
                  <div class="col-md-4"><label>Doctor:</label></div>
                  <div class="col-md-8">
                   <select name="doctor" class="form-control" >
                     <option value="Select">Select</option>'; 
                     display_docs();
                   echo  '</select>
                  </div><br><br>
                  <div class="col-md-4"><label>Payment:</label></div>
                  <div class="col-md-8">
                    <select name="payment" class="form-control" >
                    <option value="select">Select</option>
                      <option value="Paid">Paid</option>
                      <option value="Pay later">Pay later</option>
                    </select>
                  </div><br><br>
                  <div class="col-md-4"><label>Wards Id:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control"  name="wid"></div><br><br>
                  <div class="col-md-4"><label>Allocated Staff:</label></div>
                  <div class="col-md-8">
                  <select name="allocated_staff" class="form-control">
                  <option value="select">Select</option>';
                  display_staff();
                  echo '</select>
                  </div><br><br><br>
                  <div class="col-md-4">
                    <input type="submit" name="entry_submit" value="Create new entry" class="btn btn-primary" id="inputbtn">
                  </div>
                  <div class="col-md-8"></div>                  
                </div>
              </form>
            </div>
          </div>
        </div><br>
      </div>
      <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
        <div class="card">
          <div class="card-body">
            <form class="form-group" method="post" action="func.php">
              <input type="text" name="contact" class="form-control" placeholder="enter contact"><br>
              <select name="status" class="form-control">
              <option value="select">Select</option>
                <option value="paid">paid</option>
                <option value="pay later">pay later</option>
              </select><br><hr>
              <input type="submit" value="update" name="update_data" class="btn btn-primary">
            </form>
          </div>
        </div><br><br>
      </div>
      <div class="tab-pane fade" id="list-delete" role="tabpanel" aria-labelledby="list-delete-list">
      <div class="card">
      <div class="card-body">
      <form class="form-group" method="get" action="func.php">
      <input type="text" name="ano" class="form-control" placeholder="enter ano"><br>
      <input type="submit" value="delete" name="delete_data" class="btn btn-primary">
      </form>
      </div>
      </div><br>
      <div class="card">
      <div class="card-body">
      <form class="form-group" method="get" action="func.php">
      <input type="text" name="id" class="form-control" placeholder="enter id"><br>
      <input type="submit" value="delete" name="delete_doc" class="btn btn-primary">
      </form>
      </div>
      </div><br>
      <div class="card">
      <div class="card-body">
      <form class="form-group" method="get" action="func.php">
      <input type="text" name="id" class="form-control" placeholder="enter id"><br>
      <input type="submit" value="delete" name="delete_staff" class="btn btn-primary">
      </form>
      </div>
      </div>
      </div>
      <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
       <!--<div class="container-fluid">
       <div class="card">
       <br>
       <center><h4>Click here inorder to view the Doctors Details</h4></center><br><br>
       <form action="doctors_details.php">
       <center><button type="submit" class="btn btn-primary">click me</button></center><br>
       </form>
       </div>
       </div><br>-->
       <div class="container-fluid">
       <div class="card text-black bg-secondary mb-3" style="max-width: cover;">
  <!--<div class="card-header">Header</div>-->
  <div class="card-body">
    <center><h5 class="card-title">Click here inorder to view the Doctors Details</h5></center><br>
    <form action="doctors_details.php">
       <center><button type="submit" class="btn btn-primary">click me</button></center>
       </form>
  </div>
  </div>
</div>
      </div>
      <div class="tab-pane fade" id="list-show" role="tabpanel" aria-labelledby="list-show-list">
       <!--<div class="container-fluid">
       <div class="card">
       <br>
       <center><h4>Click here inorder to view the Patients Details</h4></center><br><br>
       <form action="patients_details.php">
       <center><button type="submit" class="btn btn-primary">click me</button></center><br>
       </form>
       </div>
       </div>-->
       <div class="container-fluid">
       <div class="card text-black bg-secondary mb-3" style="max-width: cover;">
  <!--<div class="card-header">Header</div>-->
  <div class="card-body">
    <center><h5 class="card-title">Click here inorder to view the Patients Details</h5></center><br>
    <form action="patients_details.php">
       <center><button type="submit" class="btn btn-primary">click me</button></center>
       </form>
  </div>
  </div>
  </div>
      </div>
      <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
      <div class="container-fluid">
      <div class="card">
      <div class="card-body">
      <center><h4>Enter Doctors Details</h4></center><br>
        <form class="form-group" method="post" action="func.php">
        <div class="row">
          <div class="col-md-4"><label>Doctors Id: </label></div>
          <div class="col-md-8"><input type="text" name="id" class="form-control"></div><br><br>
          <div class="col-md-4"><label>Doctors Name: </label></div>
          <div class="col-md-8"><input type="text" name="name" class="form-control"></div><br><br>
          <div class="col-md-4"><label>Doctors Specification: </label></div>
          <div class="col-md-8"><input type="text" name="specification" class="form-control"></div><br><br>
          <div class="col-md-4"><label>Doctors Contact: </label></div>
          <div class="col-md-8"><input type="text" name="contact" class="form-control"></div><br><br>
          <br>
          </div>
          <div class="col-md-4"><input type="submit" name="doc_sub" value="Add Doctor" class="btn btn-primary"></div>
        </form>
        </div>
      </div>
      </div><br>
      </div>
      <div class="tab-pane fade" id="list-attend" role="tabpanel" aria-labelledby="list-attend-list">
      <div class="container-fluid">
      <div class="card">
      <div class="card-body">
      <center><h4>Enter Staff Details</h4></center><br>
      <form class="form-group" method="post" action="func.php">
      <div class="row">
      <div class="col-md-4"><label>Staff Id: </label></div>
      <div class="col-md-8"><input type="text" name="id" class="form-control"></div><br><br>
      <div class="col-md-4"><label>Staff Name: </label></div>
      <div class="col-md-8"><input type="text" name="name" class="form-control"></div><br><br>
      <div class="col-md-4"><label>Staff Contact: </label></div>
      <div class="col-md-8"><input type="text" name="contact" class="form-control"></div><br><br>
      <div class="col-md-4"><label>Staff Email: </label></div>
      <div class="col-md-8"><input type="text" name="email" class="form-control"></div><br><br>
      <br>
      </div>
      <div class="col-md-4"><input type="submit" name="staff_sub" value="Add staff" class="btn btn-primary"></div>
      </form>
      </div>
      </div>
      </div><br>
      </div>
         <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <!--Sweet alert js-->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js"></script>
  </body>
</html>';
}
?>