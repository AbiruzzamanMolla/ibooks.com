<?php include "./database/Session.php"; ?>
<?php include "./database/Database.php"; ?>
<?php include "./lib/function.php"; ?>
<?php include "./inc/header.php"; ?>
<div id="page-wrapper">
    <br>
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
        <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>কিনতে হবে ইনশাল্লাহ</b>
                        <small style="font-size:8px;color:red;font-width:bolder;" onMouseOver="this.style.fontSize='16px'"
                            onMouseOut="this.style.fontSize='8px'" class="pull-right text-right">
                            <?php _2boughtprice(); ?> টাকা</small>
                    </div>
                    <div class="panel-body" style="height:300px;overflow: scroll;">
                        <?php
                        $table = "tbl_books";
                        $query = "SELECT * FROM `".$table."` WHERE `tbl_books`.`buy_priority` = 1";
                        $stmt = $dbh->prepare($query);
                        //$stmt->bindValue(':search', '%' . $author . '%');
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) { 
                        $result = $stmt->fetchAll();
                            foreach( $result as $data ) {
                                $price = $data['discount'];
                        ?>
                            <a href="book_details.php?id=<?php echo $data['id']; ?>">
                            <h4>
                            <?php echo $data['name']; ?>
                                <small>(<?php echo $data['price']; ?> টাকা)</small>
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
                        <small style="font-size:8px;color:red;font-width:bolder;" onMouseOver="this.style.fontSize='16px'"
                            onMouseOut="this.style.fontSize='8px'" class="pull-right text-right">
                            <?php boughtprice(); ?> টাকা / <?php totalprice(); ?> টাকা</small>
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
                                <small>(<?php echo $data['discount']; ?> টাকা)</small>
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
                        <h4>ম্র্যতু থেকে কিয়ামত
                            <small>২০০ টাকা</small>
                        </h4>
                        <hr>
                        <h4>ম্র্যতু থেকে কিয়ামত
                            <small>২০০ টাকা</small>
                        </h4>
                        <hr>
                        <h4>ম্র্যতু থেকে কিয়ামত
                            <small>২০০ টাকা</small>
                        </h4>
                        <hr>
                        <h4>ম্র্যতু থেকে কিয়ামত
                            <small>২০০ টাকা</small>
                        </h4>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php include "./inc/footer.php"; ?>