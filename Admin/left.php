<?php if (!isset($_SESSION)) {
    session_start();
} ?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title></title>
    <style>
        @import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');

        @media(min-width:768px) {
            body {
                margin-top: 50px;
            }

            html,
            body,
            #wrapper,
            #page-wrapper {
                height: 100%;
                overflow-x: hidden;
                overflow-y: visible;
                padding-bottom: 40px;
            }
        }

        * {
            overflow: hidden;
        }

        #wrapper {
            padding-left: 0;
        }

        #page-wrapper {
            width: 100%;
            padding: 0;
            background-color: #fff;
        }

        @media(min-width:768px) {
            #wrapper {
                padding-left: 225px;
            }

            #page-wrapper {
                padding: 22px 10px;
            }
        }


        /* Top Navigation */

        .top-nav {
            padding: 0 15px;
        }

        .top-nav>li {
            display: block;
            float: left;
        }

        .top-nav>li>a {
            padding-top: 20px;
            padding-bottom: 20px;
            line-height: 20px;
            color: #fff;
        }

        .top-nav>li>a:hover,
        .top-nav>li>a:focus,
        .top-nav>.open>a,
        .top-nav>.open>a:hover,
        .top-nav>.open>a:focus {
            color: #fff;
            background-color: #1a242f;
        }

        .top-nav>.open>.dropdown-menu {
            float: left;
            position: absolute;
            margin-top: 0;
            /*border: 1px solid rgba(0,0,0,.15);*/
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            background-color: #fff;
            -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
            box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
        }

        .top-nav>.open>.dropdown-menu>li>a {
            white-space: normal;
        }

        /* Side Navigation */

        @media(min-width:768px) {
            .side-nav {
                position: fixed;
                top: 60px;
                left: 225px;
                width: 225px;
                margin-left: -225px;
                border: none;
                border-radius: 0;
                border-top: 1px rgba(0, 0, 0, .5) solid;
                overflow-y: auto;
                background-color: #222;
                /*background-color: #5A6B7D;*/
                bottom: 0;
                overflow-x: hidden;
                padding-bottom: 40px;
            }

            .side-nav>li>a {
                width: 225px;
                border-bottom: 1px rgba(0, 0, 0, .3) solid;
            }

            .side-nav li a:hover,
            .side-nav li a:focus {
                outline: none;
                background-color: #1a242f !important;
            }
        }

        .side-nav>li>ul {
            padding: 0;
            border-bottom: 1px rgba(0, 0, 0, .3) solid;
        }

        .side-nav>li>ul>li>a {
            display: block;
            padding: 10px 15px 10px 38px;
            text-decoration: none;
            /*color: #999;*/
            color: #fff;
        }

        .side-nav>li>ul>li>a:hover {
            color: #fff;
        }

        .navbar .nav>li>a>.label {
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            position: absolute;
            top: 14px;
            right: 6px;
            font-size: 10px;
            font-weight: normal;
            min-width: 15px;
            min-height: 15px;
            line-height: 1.0em;
            text-align: center;
            padding: 2px;
        }

        .navbar .nav>li>a:hover>.label {
            top: 10px;
        }

        .navbar-brand {
            padding: 5px 15px;
        }
    </style>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
            $(".side-nav .collapse").on("hide.bs.collapse", function() {
                $(this).prev().find(".fa").eq(1).removeClass("fa-angle-right").addClass("fa-angle-down");
            });
        })
    </script>
</head>

<body>
    <div id="throbber" style="display:none; min-height:120px;"></div>
    <div id="noty-holder"></div>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" style="padding-left: 70px;
    padding-top: 10px;">
                    <img src="../images/logos/2.jpg" style="width:70px ; height:40px; border-radius: 20%;" alt="LOGO">
                </a>
            </div>
            <ul class="nav navbar-right top-nav">
                <li><a href="index.php" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Stats"><i class="fa fa-bar-chart-o"></i>
                    </a>
                </li>
                <li><a href="updateuser.php"><i class="fa fa-fw fa-user"></i> Edit Profile</a></li>
                <li><a href="updateuser.php"><i class="fa fa-fw fa-cog"></i> Change Password</a></li>
                <li class="divider"></li>
                <li><a href="../index.php"><i class="fa fa-fw fa-power-off"></i> Logout</a></li>
            </ul>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <?php if ($_SESSION["usertype"] == "Admin") { ?>
                        <li>
                            <a href="adduser.php" data-toggle="collapse" data-target="#submenu-1"><i class="fa fa-fw fa-user-plus"></i> Add User</a>
                        </li>
                        <li>
                            <a href="updateuser.php" data-toggle="collapse" data-target="#submenu-1"><i class="fa fa-fw fa-user-plus"></i> Update User</a>
                        </li>
                        <li>
                            <a href="deleteuser.php" data-toggle="collapse" data-target="#submenu-1"><i class="fa fa-fw fa-user-plus"></i> Delete User</a>
                        </li>
                    <?php } ?>

                    <li>
                        <a href="addcategory.php" data-toggle="collapse" data-target="#submenu-2"><i class="fa fa-fw fa-star"></i> Add Category</a>
                    </li>
                    <?php if ($_SESSION["usertype"] == "Admin") { ?>

                        <li>
                            <a href="updatecategory.php" data-toggle="collapse" data-target="#submenu-2"><i class="fa fa-fw fa-star"></i> Update Category</a>
                        </li>
                        <li>
                            <a href="deletecategory.php" data-toggle="collapse" data-target="#submenu-2"><i class="fa fa-fw fa-star"></i> Delete Category</a>
                        </li>
                    <?php } ?>

                    <li>
                        <a href="viewcategory.php"><i class="fa fa-fw fa-user-plus"></i> View Category</a>
                    </li>
                    <li>
                        <a href="addsubcategory.php"><i class="fa fa-fw fa-user-plus"></i> Add Subcategory</a>
                    </li>
                    <?php if ($_SESSION["usertype"] == "Admin") { ?>
                        <li>
                            <a href="updatesubcategory.php"><i class="fa fa-fw fa-user-plus"></i> Update Subcategory</a>
                        </li>
                        <li>
                            <a href="deletesubcategory.php"><i class="fa fa-fw fa-user-plus"></i> Delete Subcategory</a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="viewsubcategory.php"><i class="fa fa-fw fa-user-plus"></i> View Subcategory</a>
                    </li>
                    <li>
                        <a href="addpackage.php"><i class="fa fa-fw fa-user-plus"></i> Add Package</a>
                    </li>
                    <?php if ($_SESSION["usertype"] == "Admin") { ?>
                        <li>
                            <a href="updatepackage.php"><i class="fa fa-fw fa-user-plus"></i> Update Package</a>
                        </li>
                        <li>
                            <a href="deletepackage.php"><i class="fa fa-fw fa-user-plus"></i> Delete Package</a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="viewpackage.php"><i class="fa fa-fw fa-paper-plane-o"></i> View Package</a>
                    </li>
                    <li>
                        <a href="viewenquiry.php"><i class="fa fa-fw fa fa-question-circle"></i> View Enquiry</a>
                    </li>
                </ul>
            </div>
        </nav>

</body>

</html>