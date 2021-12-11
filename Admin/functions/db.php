<?php

$db = mysqli_connect('localhost', 'root', '', 'ebookshop');

if (!($db)) {
     echo 'Database Error';
}else{
     echo 'Db ok';
}

?>
