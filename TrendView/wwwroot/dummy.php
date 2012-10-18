<?php

require(dirname(__FILE__)."\wp-includes\pluggable.php");
//auth_redirect();
header("Location:http://radsinnovativesolutions.com/wp-login.php?redirect_to=TrendView_ol1.php");

echo "
<html>
<head><title>DUMMY!!!</title></head>
<body>";
echo wp_logout_url();

//.wp_logout_url()."
//";
 //auth_redirect();
 
 ?>

HAA
</body>
</html>