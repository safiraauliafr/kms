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
        <header class="header black-bg">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
            <!--logo start-->
            <a href="<?= base_url('index.php/user/dashboard', '') ?>" class="logo"><img
                    src="<?= base_url('assets/img/icon.png', '') ?>" class="img-circle" width="50"><b> KMS -
                    <span>Syarfi
                    </span></b></a>
            <!--logo end-->
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="<?php echo base_url() ?>index.php/user/dashboard/logout">Logout </a>
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
                <?php
                foreach ($data as $row) {
                    ?>
                <!-- page start-->
                <div class="chat-room mt">
                    <aside class="mid-side">
                        <div class="chat-room-head">
                            <h3><?php echo $row['id_notulensi']; ?></h3>
                            <?php
                            }
                            ?>
                        </div>
                        <?php
                            foreach ($data as $row)
                                $status_not = $row['status_notulensi'];
                            if ($status_not == "1") {

                                ?>

                        <div class="group-rom">
                            <div class="first-part"><?php echo $row['nama_user']; ?></div>
                            <div class="second-part"><?php echo $row['isi_notulensi']; ?></div>
                            <div class="third-part"><?php echo $row['tgl_notulensi']; ?></div>
                            <div class="first-part"></div>
                            <div class="second-part"></div>
                            <div class="third-part"><?php echo $row['waktu']; ?></div>
                            <div class="first-part"></div>
                            <div class="second-part"></div>
                            <div class="third-part"><?php echo $row['tempat']; ?></div>
                        </div>
                </div>

                <aside class="right-side">
                    <div class="user-head">
                    </div>
                    <div class="invite-row">
                        <h4 class="pull-left">Aksi</h4>
                        <a
                            href=" <?php echo base_url(); ?>index.php/user/notulen/cetak/<?php echo $row['id_notulensi']; ?>">
                            <button type="button" class="btn btn-sm btn-default pull-right"><i
                                    class="fa fa-arrow-circle-down"></i>
                                Download</button>
                        </a>
                    </div>
                </aside>

                <?php
                    // $status_not = $row['status_notulensi'];
                }
                // if ($status_not == "1") { } 

                else {
                    ($status_not == "0")

                    ?>

                <div class="group-rom">
                    <div class="first-part"><?php echo $row['nama_user']; ?></div>
                    <div class="second-part"><?php echo $row['isi_notulensi']; ?></div>
                    <div class="third-part"><?php echo $row['tgl_notulensi']; ?></div>
                    <div class="first-part"></div>
                    <div class="second-part"></div>
                    <div class="third-part"><?php echo $row['waktu']; ?></div>
                    <div class="first-part"></div>
                    <div class="second-part"></div>
                    <div class="third-part"><?php echo $row['tempat']; ?></div>
                </div>
                </div>

                <?php
                        if ($jabatan == "CIBO" || $jabatan == "CFRO") {
                            ?>

                <aside class="right-side">
                    <div class="user-head">
                    </div>

                    <div class="invite-row">
                        <h4 class="pull-left">Status Notulensi</h4>
                        <a
                            href=" <?php echo base_url(); ?>index.php/user/notulensi/validasi/<?php echo $row['id_notulensi']; ?>">
                            <button type="button" class="btn btn-sm btn-success pull-right"><i class="fa fa-check"></i>
                                Validasi</button>
                        </a>
                    </div>
                </aside>

                <?php
                    }
                }
                ?>

                </div>
                </aside>

                </div>
                <!-- page end-->
            </section>
            <!-- /wrapper -->
        </section>
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
    <script src="<?= base_url('assets/lib/jquery/jquery.min.js', '') ?>"></script>

    <script src="<?= base_url('assets/lib/bootstrap/js/bootstrap.min.js', '') ?>"></script>
    <script class="include" type="text/javascript" src="<?= base_url('assets/lib/jquery.dcjqaccordion.2.7.js', '') ?>">
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