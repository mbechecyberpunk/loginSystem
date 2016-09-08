<?php
include_once 'dbconfig.php';
require('Category.php');
if(!$user->is_loggedin())
{
 $user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>Welcome - <?php print($userRow['user_name']); ?></title>
</head>

<body>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Home</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Users</a></li>
          <li><a href="#">Categories</a></li>
          <li><a href="#">Location</a></li>

        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li><a href="logout.php?logout=true"><i class="glyphicon glyphicon-log-out"></i> logout</a></li>

        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="content">
<div class="row">
<div class="col-sm-6 col-sm-offset-1">
<form action="addCategory.php" method="post">
  <?php
  if(isset($error))
  {
     foreach($error as $error)
     {
        ?>
        <div class="alert alert-danger">
            <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
        </div>
        <?php
     }
  }
  else if(isset($_GET['joined']))
  {
       ?>
       <div class="alert alert-info">
            <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='index.php'>login</a> here
       </div>
       <?php
  }
  ?>
 <h1>categories</h1>
 <a href="addCategory.php" class="btn btn-info" role="button">Add Category</a>

<table class="table table-sm">
    <thead>
	<tr>
    <th>Number</th>
		<th>Category Name </th>
		<th>Category Descr</th>
    <th>Action</th>

	</tr>
</thead>
<tbody>
	<?php

		$result = $DB_con->prepare("SELECT * FROM categories ORDER BY id ASC");
		$result->execute();
		for($i=1; $row = $result->fetch(); $i++){
	?>
	<tr class="record">
    <td><?php  echo $i;?></td>
		<td><?php echo $row['name']; ?></td>
		<td><?php echo $row['descr']; ?></td>
    <td><a href="editCategory.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="deleteCategory.php?id=<?php echo $row['id']; ?>">Delete</a></td>

	</tr>
	<?php

		}
	?>

</div>
</div>
</div>
</body>
</html>
