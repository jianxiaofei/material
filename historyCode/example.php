<?php
header("Content-Type:text/plain");
/*echo <<< EOF
Name: $_GET(['userName'])
Passwd: $_GET(['passwd'])
EOF;*/
// echo json_encode();
 echo json_encode(['code'=>200,'result'=>$_POST]);
?>
