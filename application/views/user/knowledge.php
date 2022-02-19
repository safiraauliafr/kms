<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>KMS Syarfi</title>
    <link rel="shortcut icon" href="<?= base_url('assets/img/icon.png', '') ?>" />

    <!-- Favicons -->
    <link href="<?= base_url('assets/backend/img/favicon.png', '') ?>" rel="icon">
    <link href="<?= base_url('assets/backend/img/apple-touch-icon.png', '') ?>" rel="apple-touch-icon">

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('assets/lib/bootstrap/css/bootstrap.min.css', '') ?>" rel="stylesheet">
    <!--external css-->
    <link href="<?= base_url('assets/lib/font-awesome/css/font-awesome.css', '') ?>" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/zabuto_calendar.css', '') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/lib/gritter/css/jquery.gritter.css', '') ?>" />
    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/css/style.css', '') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css', '') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/lib/chart-master/Chart.js', '') ?>"></script>

    <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
    <section id="container">
        <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
        <!--header start-->
        <section id="container">
            <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
            <!--header start-->
            <header class="header black-bg">
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation">
                    </div>
                </div>
                <!--logo start-->
                <a href="<?= base_url('index.php/user/dashboard', '') ?>" class="logo"><img
                        src="<?= base_url('assets/img/icon.png', '') ?>" class="img-circle" width="50"><b> KMS -
                        <span>Syarfi
                        </span></b></a>
                <!--logo end-->
                <div class="top-menu">
                    <ul class="nav pull-right top-menu">
                        <li><a class="logout" href="<?php echo base_url() ?>index.php/user/dashboard/logout">Logout</a>
                        </li>
                    </ul>
                </div>
            </header>
            <!--header end-->
            <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
            <!--sidebar start-->
            <aside>
                <?php
                if ($this->session->userdata('jabatan') == "CEO") {
                    echo $sidebar_ceo;
                } else {
                    echo $sidebar;
                }
                ?>
            </aside>
            <!--sidebar end-->
            <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper site-min-height">
                    <div class="row">
                    </div>

                    <?php $no = 1;
                    foreach ($knowledge as $row)
                        if ($row['jenis'] == 1) {
                            $jenis_k = "Agenda";

                            ?>

                    <div class="col-md-12">
                        <div class="custom-box">
                            <div class="servicetitle">
                                <h4><?php echo $jenis_k; ?></h4>
                                <hr>
                            </div>

                            <p class="centered"><img src="<?= base_url('assets/img/agenda.png', '') ?>"
                                    class="img-circle" width="80"></p>


                            <a class="btn btn-theme02 btn-xs"
                                href="<?= base_url(); ?>index.php/user/knowledge/read_knowledge/<?php echo $row['id_knowledge']; ?>">Read
                                More</a>

                        </div>
                        <!-- end custombox -->
                    </div>
                    <?php
                    } elseif ($row['jenis'] == 2) {
                        $jenis_k = "Web";

                        ?>
                    <!-- end col-4 -->
                    <div class="col-md-12">
                        <div class="custom-box">
                            <div class="servicetitle">
                                <h4><?php echo $jenis_k; ?></h4>
                                <hr>
                            </div>

                            <p class="centered"><img src="<?= base_url('assets/img/icon.png', '') ?>" class="img-circle"
                                    width="80"></p>
                            <p class="centered">Official Website PT. Syarfi Teknologi Finansial</p>

                            <a class="btn btn-theme btn-xs" href="https://www.syarfi.id">Go to web</a>

                        </div>
                        <!-- end custombox -->
                    </div>
                    <!-- end col-4 -->
                    <?php
                    } elseif ($row['jenis'] == 3) {
                        $jenis_k = "Daftar Investor";

                        ?>
                    <div class="col-md-12">
                        <div class="custom-box">
                            <div class="servicetitle">
                                <h4><?php echo $jenis_k; ?></h4>
                                <hr>
                            </div>

                            <p class="centered"><img src="<?= base_url('assets/img/investor.png', '') ?>"
                                    class="img-circle" width="80"></p>

                            <a class="btn btn-theme02 btn-xs"
                                href="<?= base_url(); ?>index.php/user/knowledge/read_knowledge/<?php echo $row['id_knowledge']; ?>">Read
                                More</a>

                        </div>
                        <!-- end custombox -->
                    </div>
                    <!-- end col-4 -->
                    <?php
                    } elseif ($row['jenis'] == 4) {
                        $jenis_k = "Kriteria Pengajuan Pembiayaan";

                        ?>
                    <div class="col-md-12">
                        <div class="custom-box">
                            <div class="servicetitle">
                                <h4><?php echo $jenis_k; ?></h4>
                                <hr>
                            </div>

                            <p class="centered"><img src="<?= base_url('assets/img/pembiayaan.jpg', '') ?>"
                                    class="img-circle" width="80"></p>


                            <a class="btn btn-theme02 btn-xs"
                                href="<?= base_url(); ?>index.php/user/knowledge/read_knowledge/<?php echo $row['id_knowledge']; ?>">Read
                                More</a>

                        </div>
                        <!-- end custombox -->
                    </div>
                    <?php
                    } elseif ($row['jenis'] == 5) {
                        $jenis_k = "Daftar Nasabah";

                        ?>
                    <div class="col-md-12">
                        <div class="custom-box">
                            <div class="servicetitle">
                                <h4><?php echo $jenis_k; ?></h4>
                                <hr>
                            </div>

                            <p class="centered"><img src="<?= base_url('assets/img/nasabah.png', '') ?>"
                                    class="img-circle" width="80"></p>

                            <a class="btn btn-theme02 btn-xs"
                                href="<?= base_url(); ?>index.php/user/knowledge/read_knowledge/<?php echo $row['id_knowledge']; ?>">Read
                                More</a>
                        </div>
                        <!-- end custombox -->
                    </div>
                    <?php
                    } elseif ($row['jenis'] == 6) {
                        $jenis_k = "Contoh SOP";

                        ?>
                    <div class="col-md-12">
                        <div class="custom-box">
                            <div class="servicetitle">
                                <h4><?php echo $jenis_k; ?></h4>
                                <hr>
                            </div>

                            <p class="centered"><img src="<?= base_url('assets/img/sop.png', '') ?>" class="img-circle"
                                    width="80"></p>

                            <a class="btn btn-theme02 btn-xs"
                                href="<?= base_url(); ?>index.php/user/knowledge/read_knowledge/<?php echo $row['id_knowledge']; ?>">Read
                                More</a>

                        </div>
                        <!-- end custombox -->
                    </div>
                    </div>
                    <!--  /col-lg-12 -->
                    <?php
                    }
                ?>
                    </div>
                    <!--  /row -->
                </section>
                <!-- /wrapper -->
                <footer class="site-footer">
                    <div class="text-center">
                        <p>
                            &copy; Copyright <strong>2019</strong>
                        </p>
                        <div class="credits">

                            <a href="https://syarfi.id/">PT. Syarfi Teknologi Finansial</a>
                        </div>
                        <a href="buttons.html#" class="go-top">
                            <i class="fa fa-angle-up"></i>
                        </a>
                    </div>
                </footer>
            </section>
            <!-- js placed at the end of the document so the pages load faster -->
            <script src="<?= base_url('assets/lib/jquery/jquery.min.js', '') ?>"></script>

            <script src="<?= base_url('assets/lib/bootstrap/js/bootstrap.min.js', '') ?>"></script>
            <script class="include" type="text/javascript"
                src="<?= base_url('assets/lib/jquery.dcjqaccordion.2.7.js', '') ?>">
            </script>
            <script src="<?= base_url('assets/lib/jquery.scrollTo.min.js', '') ?>"></script>
            <script src="<?= base_url('assets/lib/jquery.nicescroll.js', '') ?>" type="text/javascript"></script>
            <script src="<?= base_url('assets/lib/jquery.sparkline.js', '') ?>"></script>
            <!--common script for all pages-->
            <script src="<?= base_url('assets/lib/common-scripts.js', '') ?>"></script>
            <script type="text/javascript" src="<?= base_url('assets/lib/gritter/js/jquery.gritter.js', '') ?>">
            </script>
            <script type="text/javascript" src="<?= base_url('assets/lib/gritter-conf.js', '') ?>"></script>
            <!--script for this page-->
            <script src="<?= base_url('assets/lib/sparkline-chart.js', '') ?>"></script>
            <script src="<?= base_url('assets/lib/zabuto_calendar.js', '') ?>"></script>

</body>

</html>