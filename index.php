<?php include "./database/Session.php"; ?>
<?php include "./database/Database.php"; ?>
<?php include "./lib/function.php"; ?>
<?php include "./inc/header.php"; ?>
<?php
        try {
            $dbh = new PDO("mysql:dbname=db_ibooks;host=localhost", "root", "root");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->exec("SET CHARACTER SET utf8");
            $dbh->pdo = $dbh;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    ?>
    <div id="page-wrapper">
        <?php
$dba = new Database();
if (isset($_POST['submit'])) {
    $id = $_POST['reading_id'];
    $reading = $_POST['reading'];
        if(isset($_POST['finished']) && $_POST['finished'] == 'Finished'){
            $reading = 'Finished';
        } else {
            $reading = $_POST['reading'];
        }
        date_default_timezone_set("Asia/Dhaka");
        $date = date('d F Y');
        if (!empty($id)) {
            // update data in tbl_books
            $readData = array(
                'reading' => $reading,
                'updated' => $date
            );
            $table = "tbl_books";
            $condition = array('id' => $id);
            $update = $dba->update($table, $readData, $condition);
            // update data in tbl_reading
            $table = "tbl_reading";
            if(isset($_POST['finished']) && $_POST['finished'] == 'Finished'){
            $reading = 'Finished';
            } else {
                $reading = $_POST['reading'];
            }
            $read = array(
                'book_id' => $id,
                'page' => $_POST['reading'],
                'date' => $date
            );
            $insert = $dba->insert($table, $read);
        }
        header("Location: index.php");
    }
?>
            <div class="modal fade" id="myReplyModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style="padding:35px 50px;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4>
                                <span class="glyphicon glyphicon-lock"></span> Update Reading Status : </h4>
                        </div>
                        <div class="modal-body" style="padding:40px 50px;">
                            <form role="form" action="" method="post">
                                <div class="form-group">
                                    <label for="reading">
                                        <span class="glyphicon glyphicon-user"></span>Current Page:
                                    </label>
                                    <span class="pull-right text-right">
                                        <b>Finished</b>
                                        <input type="radio" name="finished" id="finished" value="Finished">
                                    </span>
                                    <input class="form-control" name="reading" id="reading" value="">
                                </div>
                                <input type="hidden" name="reading_id" class="reading_id" value="">
                                <input type="submit" name="submit" class="btn btn-success btn-block" value="Update">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger btn-default pull-right" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove"></span> Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>কিনতে হবে ইনশাল্লাহ</b>
                            <small style="font-size:8px;color:red;font-width:bolder;" onMouseOver="this.style.fontSize='16px'" onMouseOut="this.style.fontSize='8px'"
                                class="pull-right text-right">
                                <?php _2boughtprice(); ?> টাকা</small>
                        </div>
                        <div class="panel-body" style="height:300px;overflow: scroll;">
                            <?php
                        $table = "tbl_books";
                        $query = "SELECT * FROM `".$table."` WHERE `tbl_books`.`buy_priority` = 1";
                        $stmt = $dbh->prepare($query);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) { 
                        $result = $stmt->fetchAll();
                            foreach( $result as $data ) {
                                $price = $data['discount'];
                        ?>
                                <a href="book_details.php?id=<?php echo $data['id']; ?>">
                                    <h4>
                                        <?php echo $data['name']; ?>
                                        <small>(
                                            <?php echo $data['price']; ?> টাকা)</small>
                                    </h4>
                                </a>
                                <hr>
                                <?php } } ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>নতুন সংগৃহীত বইসমুহ</b>
                            <small style="font-size:8px;color:red;font-width:bolder;" onMouseOver="this.style.fontSize='16px'" onMouseOut="this.style.fontSize='8px'"
                                class="pull-right text-right">
                                <?php boughtprice(); ?> টাকা /
                                <?php totalprice(); ?> টাকা</small>
                        </div>
                        <div class="panel-body" style="height:300px;overflow: scroll;">
                            <?php
                        $table = "tbl_books";
                        $query = "SELECT * FROM `".$table."` WHERE `tbl_books`.`buy_priority` = 2";
                        $stmt = $dbh->prepare($query);
                        //$stmt->bindValue(':search', '%' . $author . '%');
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) { 
                        $result = $stmt->fetchAll();
                            foreach( $result as $data ) {
                        ?>
                                <a href="book_details.php?id=<?php echo $data['id']; ?>">
                                    <h4>
                                        <?php echo $data['name']; ?>
                                        <small>(
                                            <?php echo $data['discount']; ?> টাকা)</small>
                                    </h4>
                                </a>
                                <hr>
                                <?php } } ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>চলমান অবস্থায় আছে</b>
                        </div>
                        <div class="panel-body" style="height:300px;overflow: scroll;">
                            <?php
                        $query = "SELECT * FROM `tbl_books` WHERE `tbl_books`.`reading` >= 1 AND `tbl_books`.`reading` != 'Finished'";
                        $stmt = $dbh->prepare($query);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) { 
                        $result = $stmt->fetchAll();
                            foreach( $result as $data ) {
                        ?>
                                <a rel='<?php echo $data['id']; ?>' class='reply_comment_link' href='javascript:void(0)'>
                                    <h4>
                                        <?php echo $data['name']; ?>
                                        <small class="pull-right text-right">(
                                            <?php echo BanglaConverter::en2bn($data['reading']); ?> পৃষ্ঠা)</small>
                                    </h4>
                                </a>
                                <hr>
                                <?php } } ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>সাম্প্রতিক শেষ করা</b>
                        </div>
                        <div class="panel-body" style="height:300px;overflow: scroll;">
                            <?php
                        $query = "SELECT * FROM `tbl_books` WHERE `tbl_books`.`reading` = 'Finished'";
                        $stmt = $dbh->prepare($query);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) { 
                        $result = $stmt->fetchAll();
                            foreach( $result as $data ) {
                                $price = $data['discount'];
                        ?>
                                <a href="book_details.php?id=<?php echo $data['id']; ?>">
                                    <h4>
                                        <?php echo $data['name']; ?>
                                        <small class="pull-right">(
                                            <?php echo BanglaConverter::en2bn($data['updated']); ?>)</small>
                                    </h4>
                                </a>
                                <hr>
                                <?php } } ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>সাম্প্রতিক যুক্ত করা</b>
                        </div>
                        <div class="panel-body" style="height:300px;overflow: scroll;">
                            <?php
                        $query = "SELECT * FROM `tbl_books` ORDER BY id DESC LIMIT 5";
                        $stmt = $dbh->prepare($query);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) { 
                        $result = $stmt->fetchAll();
                            foreach( $result as $data ) {
                                $price = $data['price'];
                        ?>
                                <a href="book_details.php?id=<?php echo $data['id']; ?>">
                                    <h4>
                                        <small>
                                            <?php echo $data['id']; ?>. </small>
                                        <?php echo $data['name']; ?>
                                        <small class="pull-right">(
                                            <?php echo BanglaConverter::en2bn($data['price']); ?>)</small>
                                    </h4>
                                </a>
                                <hr>
                                <?php } } ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>সাম্প্রতিক যুক্ত করা</b>
                        </div>
                        <div class="panel-body" style="height:300px;overflow: scroll;">
                            <?php
                        $query = "SELECT * FROM `tbl_books` ORDER BY id DESC LIMIT 5";
                        $stmt = $dbh->prepare($query);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) { 
                        $result = $stmt->fetchAll();
                            foreach( $result as $data ) {
                                $price = $data['price'];
                        ?>
                                <a href="book_details.php?id=<?php echo $data['id']; ?>">
                                    <h4>
                                        <small>
                                            <?php echo $data['id']; ?>. </small>
                                        <?php echo $data['name']; ?>
                                        <small class="pull-right">(
                                            <?php echo BanglaConverter::en2bn($data['price']); ?>)</small>
                                    </h4>
                                </a>
                                <hr>
                                <?php } } ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- row -->
    </div>
    <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <?php include "./inc/footer.php"; ?>
    <script>
        $(document).ready(function () {
            $(".reply_comment_link").on('click', function () {
                var id = $(this).attr("rel");
                $(".reading_id").attr("value", id);
                $("#myReplyModal").modal('show');
            });
        });
    </script>