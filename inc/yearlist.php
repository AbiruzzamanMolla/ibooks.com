<?php
$con = mysqli_connect("localhost","root","root","db_ibooks");
mysqli_set_charset($con,"utf8");
$query = "SELECT DISTINCT `year` FROM `tbl_books`";
$result = mysqli_query($con, $query);

while($row = mysqli_fetch_assoc($result)){
    $year = $row['year'];
    echo '<li><a href="year.php?year='.$year.'">'.$year.'</a></li>';
}
mysqli_close($con);
?>