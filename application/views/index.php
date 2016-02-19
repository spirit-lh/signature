<!DOCTYPE HTML>
<html>
<head>
<title>Home</title>

<link href="<?php echo $baseUrl;?>resources/css/style.css" rel="stylesheet" type="text/css" media="all"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 

</head>
<body>
<div class="login">
	<h2>Welcome</h2>
	<div class="login-top">
		<h1>LOGIN</h1>
		<form method="post" action="<?php echo $baseUrl;?>index.php/platform/LoginController">
			<input name="userid" type="text" value="User Id" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'User Id';}">
			<input name="password" type="password" value="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'password';}">	    
			<div class="forgot">
	    		<a href="#">forgot Password</a>
	    		<input type="submit" value="Login" >
	    	</div>
	    	<div style="text-align:center;font-size:40px;color:#5fa2dd;"><?php echo $error;?></div>
	    </form>

	</div>
	<div class="login-bottom">
		<h3>New User &nbsp;<a href="#">Register</a>&nbsp Here</h3>
	</div>
</div>	
<div class="copyright">
	<p>Copyright 2015.CUIKAI All rights reserved.</p>
</div>


</body>
</html>