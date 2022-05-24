<!DOCTYPE html>
<html>
<head>
	<title>Registration Page</title>

  <?php include 'acclog.php' ?>

	<link rel="stylesheet" href="registration.css">
	<link href="css/footer.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,900' rel='stylesheet' type='text/css'>

  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Dosis:wght@200;300;400&family=Monoton&family=Orbitron:wght@400;500;600;700;800;900&family=Parisienne&family=Ubuntu:ital,wght@0,300;1,300&family=Zen+Dots&display=swap" rel="stylesheet">

</head>
<body>
	<!--Connecting to Databse-->
	<?php
	$crude = new acclog();

	if(isset($_POST['submit'])){
		$crude->insert($_POST['accEmail'],$_POST['userName'],$_POST['accPass']);
	}

	?>

 <!-- multistep form -->
<form id="msform" action="" method="POST">
  <!-- progressbar -->
  <ul id="progressbar">
    <li class="active">Account Setup</li>
    <!--<li>Social Profiles</li>-->
    <li>Personal Details</li>
  </ul>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">Create your account</h2>
    <h3 class="fs-subtitle">This is step 1</h3>
    <input type="email" id="username" name="accEmail" placeholder="Email Address" required />
    <input type="password" id="pass" name="accPass" placeholder="Password" />
    <input type="password" id="cpass" name="cpass" placeholder="Confirm Password" required />
    <error id="alert"></error>
    <input type="button" name="next" class="next action-button" value="Next" onkeyup="emptyInput()"/>
  </fieldset>
	<!--Field 2-->
  <fieldset>
    <h2 class="fs-title">Personal Details</h2>
    <h3 class="fs-subtitle">We will never sell it</h3>
    <input type="text" name="userName" placeholder="User Name" />
    <input type="text" name="lname" placeholder="Last Name" />
		<!--Code for Subscription Here-->
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <button type="submit" name="submit" class="submit action-button" value="Submit"/>Submit</Button>
  </fieldset>
</form>

<script type="text/javascript">

		function submitReg(){
		location.replace("home.html");
		alert("Thank You for Signing Up!");

	}
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="registration.js"></script>

</body>
</html>