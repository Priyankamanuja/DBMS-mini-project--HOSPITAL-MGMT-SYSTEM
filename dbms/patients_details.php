<!DOCTYPE html>
<?php include("func.php");?>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
<div class="jumbotron" style="background:url('head.jpeg') no-repeat;background-size:cover;height: 300px;"></div>
<div class="container-fluid">
	<div class="card">
		<center><div class="card-body" style="background-color:#3498DB;color:#ffffff;">PATIENTS DETAILS</div></center>
		<div class="card-body">
		<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Appointment No</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Contact</th>
      <th scope="col">Doctors Name</th>
      <th scope="col">Payment</th>
      <th scope="col">Ward Id</th>
      <th scope="col">Allocated Staff</th>
    </tr>
  </thead>
  <tbody>
   <?php get_patients_details(); ?>
  </tbody>
</table>
</div>	
</div>
</div><br>
<center><div class="col-md-3">
	<a href="admin-panel.php" class="btn btn-primary">Go Back</a>
</div></center><br>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>