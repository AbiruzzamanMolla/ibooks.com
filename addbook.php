<?php include "./inc/header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    নতুন বই যুক্ত করুন
                </div>
                <div class="panel-body">
                    <div class="row">
                        <form role="form" action="lib/add_book.php" method="post" enctype="multipart/form-data">
                            <div class="col-lg-6">
                                <div class="form-group has-success">
                                    <label class="control-label" for="name">বইয়ের নাম</label>
                                    <input type="text" name="name" class="form-control" id="name" value="" placeholder="বইয়ের নাম লিখুন" required>
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label" for="author">লেখকের নাম</label>
                                    <input type="text" name="author" class="form-control" id="author" value="" placeholder="লেখকের নাম লিখুন" required>
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label" for="publisher">প্রকাশনী </label>
                                    <input type="text" name="publisher" class="form-control" id="publisher" value="" placeholder="প্রকাশনী নাম লিখুন" required>
                                </div>
                                <div class="form-group">
                                    <label>প্রকাশ সন</label>
                                    <input type="text" class="form-control" name="year" placeholder="প্রকাশ সন লিখুন" value="">
                                </div>
                                <div class="form-group">
                                    <label>বিক্রয় মূল্য</label>
                                    <input type="text" class="form-control" name="price" value="" placeholder="বিক্রয় মূল্য লিখুন" required>
                                </div>
                                <div class="form-group">
                                    <label>ছাড়ে মূল্য</label>
                                    <input type="text" name="discount" class="form-control" placeholder="ছাড়ে বিক্রয় মূল্য লিখুন" value="">
                                </div>
                                <div class="form-group">
                                    <label for="status">ক্রমিক গতি</label>
                                        <select class="form-control" name="process">
                                            <option value="0">অবস্থা উল্ল্যেখ করুন</option>
                                            <option value="1">পড়তে চাই</option>
                                            <option value="2">পড়তেছি</option>
                                            <option value="3">পড়া শেষ</option>
                                        </select>
                                </div>
                                <input type="hidden" value="add">
                                <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                            <div class="col-lg-6">
                                <div class="form-group has-error">
                                <label>রিভিউ লিখুন</label>
                                    <div class="form-group">
                                        <textarea class="form-control" name="review" rows="9" id="review"></textarea>
                                    </div>
                                </div>
                                <div class="form-group has-info">
                                    <label>বিষয় সমূহ</label>
                                    <input type="text" name="tags" class="form-control" placeholder="বিষয় সমূহ লিখুন" value="">
                                </div>
                                <div class="form-group has-info">
                                    <label>পেইজ নাম্বার</label>
                                    <input type="text" name="page" class="form-control" placeholder="পেইজ নম্বর কতো?" value="">
                                </div>
                                <div class="form-group has-error">
                                    <h2><label for="preview">কভার সংযুক্ত করুন</label></h2>
                                    <div class="form-group has-error">
                                        <input type="file" class="custom-file-input" name="preview" id="preview">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h2><label for="status">সংগ্রহে আছে কি?</label></h2>
                                            <label class="checkbox-inline">
                                                <input type="radio" name="status" value="1" id="status">হ্যাঁ।
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="radio" name="status" value="0" id="status" checked>না।
                                            </label>
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </form>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
<?php include "./inc/footer.php"; ?>