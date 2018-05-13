<?php include "./database/Session.php"; ?>
<?php include "./database/Database.php"; ?>
<?php include "./inc/header.php"; ?>
<?php
if(!isset($_GET['id']) || $_GET['id'] == null){
	header("Location: index.php");
} else { ?>
<!-- Page Content -->
<div id="page-wrapper">
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
            $id = $_GET['id'];
            $query = "SELECT * FROM `".$table."` WHERE `tbl_books`.`id` = $id";
            $stmt = $dbh->prepare($query);
            //$stmt->bindValue(':search', '%' . $author . '%');
            $stmt->execute();
            if ($stmt->rowCount() > 0) { 
                $result = $stmt->fetchAll();
                    foreach( $result as $data ) {
                        $bookname = $data['name'];
        ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header text-center" style="color:red;"><b><?php echo $bookname; ?></b></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>
                            <label for="info">বইয়ের তথ্যঃ </label>
                        </h3>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="col-md-4" id="info">
                            <img src="covers/<?php echo $data['preview']; ?>" alt="" class="img-responsive img-thumbnail" height="185px" width="300px">
                        </div>
                        <!-- Div col-lg-4 -->
                        <div class="col-md-8">
                            <table class="table table-hover table-responsive">
                                <tbody>
                                    <tr>
                                        <td width="20%" height="80px">
                                            <label for="bookname" style="font-size:20px;color:green;">বইয়ের নামঃ</label>
                                        </td>
                                        <td width="80%">
                                            <b id="bookname" style="font-size:20px"><?php echo $data['name']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%" height="80px">
                                            <label for="publisher" style="font-size:20px;color:green;">প্রকাশনীঃ </label>

                                        </td>
                                        <td width="80%">
                                            <b id="publisher" style="font-size:20px"><?php echo $data['publisher']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%" height="80px">
                                            <label for="author" style="font-size:20px;color:green;">লেখকঃ </label>

                                        </td>
                                        <td width="80%">
                                            <b id="author" style="font-size:20px"><?php echo $data['author']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%" height="80px">
                                            <label for="price" style="font-size:20px;color:green;">মূল্যঃ </label>

                                        </td>
                                        <td width="80%">
                                            <b id="price" style="font-size:20px"><?php echo $data['price']; ?> টাকা</b>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-md-12 text-right" style="color:red;padding-bottom:15px">
                                <b class="text-right">বিক্রয় মূল্যঃ</b>
                                <b class="text-right"><?php echo $data['discount']; ?> টাকা</b>
                            </div>
                            <div class="col-md-12 text-right">
                                <?php
                                    $status = $data['status'];
                                    if($status == 1){
                                    $status = '<button class="btn btn-success" type="" disabled>বই সংগ্রহে রয়েছে।</button>';
                                    } else {
                                        $status = '<button class="btn btn-success" type="">বই সংগ্রহ হয়েছে</button>';
                                    }
                                ?>
                                <?php echo $status; ?> 
                            </div>
                        </div>
                        <!-- Div col-lg-4 -->
                    </div>
                    <!-- .panel-body -->
                </div>
                <!-- /.panel -->

            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Modals
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <?php include "model.php"; ?>
                    </div>
                    <!-- .panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <?php } } ?>
</div>
<!-- /#page-wrapper -->
<?php } ?>
<?php include "./inc/footer.php"; ?>