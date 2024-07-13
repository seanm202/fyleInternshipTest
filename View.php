<?php
require_once "pdo.php";
// session_start();
if ( !isset($_SESSION['user_Id']) ) {
  die('Not logged in');
}


if (isset($_SESSION['flash'])) {
  echo('<p style="color: green;">'.$_SESSION['flash']."</p>\n");
   unset($_SESSION['flash']);
}
if (isset($_SESSION['delete'])) {
  echo('<p style="color: green;">'.$_SESSION['delete']."</p>\n");
   unset($_SESSION['delete']);
}

if ( isset($_POST['logout'] ) )
	{
		header("Location: Logout.php");
		return;
	}

	$stmtCur = $pdo->query("SELECT * FROM currencycode");
$rowsCur = $stmtCur->fetchAll(PDO::FETCH_ASSOC);


?>



<!DOCTYPE html>
<html>
<head>
<title>Make Payment</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<body>

  <div style="padding-left:170px;padding-right:170px;padding-top:60px;padding-bottom:60px;overflow-y:scroll;">

        <div style="text-align:center;"><h2>Welcome!! Mr./Mrs.<?php echo $_SESSION['firstName']." ". $_SESSION['lastName'] ?></h2>
        <h2><a href="viewStatus.php">View Payment Status</a></h2>
        <div class="logoutButton">
      <form method="POST">
      	<p>
      <input type="submit" name="logout" value="Logout"/></p>
      </form>
      </div>
      </div>

      Make Payment here.....<hr><hr><hr>
  <form action="paymentrequest.php" method="POST">
  <input type="hidden" name="udf3" value="NIL"></input>
    <input type="hidden" name="udf4" value="NIL"></input>
      <input type="hidden" name="udf5" value="NIL"></input>
 <div class="form-group">
    <label for="udf1">Journal Name</label>
<input class="form-control" type="text" name="udf1" placeholder="Journal Name" required>
  </div>
<div class="form-group">
    <label for="udf2">Article Name</label>
<input class="form-control" type="text" name="udf2" placeholder="Article Name" required>
  </div>
 <div class="form-group">
    <label for="exampleFormControlTextarea1">Purpose</label>
<input class="form-control" type="text" name="purpose" placeholder="Purpose" required>
  </div>
<div class="form-group">
    <label for="amount">Amount</label>
<input class="form-control" type="number" name="amount" placeholder="Amount" required>
  </div>
<!-- <div class="form-group">
    <label for="address_line_1">Address line 1</label> -->
<input class="form-control" type="hidden" name="address_line_1" placeholder="Address line 1" required>
  <!-- </div>
 <div class="form-group">
    <label for="address_line_2">Address line 2</label> -->
<input class="form-control" type="hidden" name="address_line_2" placeholder="Address line 2" required>
  <!-- </div> -->

  <input type="submit" name="submitDetails" class="btn btn-primary"></input>
</form>
</div>
</body>
</html>
