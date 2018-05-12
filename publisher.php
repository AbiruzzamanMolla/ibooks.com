<?php include "./database/Session.php"; ?>
<?php include "./database/Database.php"; ?>
<?php include "./inc/header.php"; ?>
<?php
if(!isset($_GET['publisher']) || $_GET['publisher'] == null){
	header("Location: index.php");
} else { ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo "<b style='color:red;'>".$_GET['publisher']."</b>"; ?> এর বই সমূহ</h1>
            <?php
            //Session::init();
            $msg = Session::get('msg');
            if (!empty($msg)) {
            echo '<h2 class="alert alert-info text-right">' . $msg . '</h2>';
            Session::unset();
            } ?>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th width="5%">
                                <b>আইডি</b>
                            </th>
                            <th>
                                <b>নাম</b>
                            </th>
                            <th>
                                <b>লেখক</b>
                            </th>
                            <th>
                                <b>প্রকাশক</b>
                            </th>
                            <th width="5%">
                                <b>প্রকাশ সন</b>
                            </th>
                            <th>
                                <b>দাম</b>
                            </th>
                            <th>
                                <b>অবস্থা</b>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            try {
                                $dbh = new PDO("mysql:dbname=db_ibooks;host=localhost", "root", "root");
                                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $dbh->exec("SET CHARACTER SET utf8");
                                $dbh->pdo = $dbh;
                            } catch (PDOException $e) {
                                echo 'Connection failed: ' . $e->getMessage();
                            }
                            $table = "tbl_books";
                            $publisher = $_GET['publisher'];
                            $query = "SELECT * FROM `".$table."` WHERE `publisher` LIKE '%{$publisher}%'";
                            $stmt = $dbh->prepare($query);
                            //$stmt->bindValue(':search', '%' . $author . '%');
                            $stmt->execute();
                            if ($stmt->rowCount() > 0) { 
                                $result = $stmt->fetchAll();
                                    foreach( $result as $data ) {
                        ?>
                        <?php
                            $oddeven = $data['id'];
                            if($oddeven%2 == 0){
                                $class = "odd gradeX";
                            } else {
                                $class = "even gradeC";
                            }
                        ?>
                                <tr class="<?php echo $class; ?>">
                                    <td width="05%">
                                        <?php echo $data['id']; ?>
                                    </td>
                                    <td>
                                        <a href="book_details.php?id=<?php echo $data['id']; ?>"><img src="covers/<?php echo $data['preview']; ?>" alt="" height="20px" width="20px">
                                            <?php echo $data['name']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?php echo $data['author']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['publisher']; ?>
                                    </td>
                                    <td width="5%">
                                            <?php echo $data['year']; ?>
                                    </td>
                                    <td width="7%">
                                        <?php echo $data['price']; ?> টাকা
                                    </td>
                                    <td width="11%">
                                        <?php
                                            $status = $data['status'];
                                            if($status == 1){
                                            $status = "সংগ্রহে আছে।";
                                            } else {
                                                $status = "কেনা হয়নি।";
                                            }
                                        ?>
                                        <?php echo $status; ?>
                                        <?php
                                            $process = $data['process'];
                                            if($process == 0){
                                                echo '<span><abbr title="পড়তে চাই না।"><i class="fa fa-times-circle fa-fw"></i></abbr></span>';
                                            } elseif($process == 1){
                                                echo '<span><abbr title="পড়বো ইনশাল্লাহ।"><i class="fa fa-book fa-fw"></i></abbr></span>';
                                            } elseif($process == 3){
                                                echo '<span><abbr title="আলহামদুলিল্লাহ, পড়া হয়েছে।"><i class="fa fa-check-square fa-fw"></i></abbr></span>';
                                            } elseif($process == 2) {
                                                echo '<span><abbr title="আলহামদুলিল্লাহ, পড়তেছি।"><i class="fa fa-spinner fa-fw"></i></abbr></span>';
                                            } else {
                                                echo "";
                                            }
                                            ?>
                                    </td>
                                </tr>
                                <?php 
                                    }
                                } ?>
                    </tbody>
                </table>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

</div>
                            <?php } ?>
<!-- /#page-wrapper -->
<?php include "./inc/footer.php"; ?>