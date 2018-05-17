<?php
$con = mysqli_connect("localhost","root","root","db_ibooks");
mysqli_set_charset($con,"utf8");
$query = "SELECT DISTINCT `author` FROM `tbl_books`";
$result = mysqli_query($con, $query);

while($row = mysqli_fetch_assoc($result)){
    $author = $row['author'];
    $authors = explode(',', $author);
    foreach($authors as $author){
        echo '<li class="divider"></li>';
        echo '<li><a href="authors.php?author='.trim($author).'">'.trim($author).'</a></li>';
    }
}
mysqli_close($con);
?>