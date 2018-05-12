<?php
$con = mysqli_connect("localhost","root","root","db_ibooks");
mysqli_set_charset($con,"utf8");
$query = "SELECT DISTINCT `publisher` FROM `tbl_books`";
$result = mysqli_query($con, $query);

while($row = mysqli_fetch_assoc($result)){
    $publisher = $row['publisher'];
    echo '<li><a href="publisher.php?publisher='.$publisher.'">'.$publisher.'</a></li>';
}
mysqli_close($con);
?>