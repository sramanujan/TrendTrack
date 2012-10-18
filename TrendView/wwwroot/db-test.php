<html>
<head><title>Test Page</title></head>
<body>
<?php

if(mysql_connect('localhost:3306','temp_route','androida60','tt_db'))
echo "Connected!!";
else
echo "Nope... Fail!";


?>

</body>