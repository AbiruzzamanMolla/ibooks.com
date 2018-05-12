<div class="navbar-default sidebar" role="navigation" style="margin-left: -250px; left: 250px; width: 250px;position: fixed;height: 100%;overflow-y: scroll;z-index: 1000;transition: all 0.4s ease 0s;">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> সকল বই সমূহ</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-book fa-fw"></i> লেখক সমূহ<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <?php include_once "authorlist.php"; ?>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-book fa-fw"></i> প্রকাশনী সমূহ<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <?php include_once "publisherlist.php"; ?>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-book fa-fw"></i> সংগ্রহ সমূহ<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="listbooks.php">নতুন যুক্ত করুন</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-book fa-fw"></i> সাল সমূহ<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <?php include_once "yearlist.php"; ?>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->