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
            <a href="<?= base_url('index.php/user/dashboard', '') ?>" class="logo"><img
                    src="<?= base_url('assets/img/icon.png', '') ?>" class="img-circle" width="50"><b> KMS -
                    <span>Syarfi
                    </span></b></a>
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
        <?php
        echo validation_errors('<div class="alert alert-danger">', '</div>');
        @print($this->session->flashdata('error'));

        ?>
        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-center">Data User</h2>
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama User</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>No. Handphone</th>
                                <th>Email</th>
                                <th>Jabatan</th>
                                <th>Alamat</th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($user as $row) : ?>

                            <tr>
                                <td><?= $no++ . "." ?></td>
                                <td><?= $row->nip ?></td>
                                <td><?= $row->nama_user ?></td>
                                <td><?= $row->jenis_kelamin ?></td>
                                <td><?= $row->tempat_lahir ?></td>
                                <td><?= $row->tgl_lahir ?></td>
                                <td><?= $row->no_hp ?></td>
                                <td><?= $row->email ?></td>
                                <td><?= $row->jabatan ?></td>
                                <td><?= $row->alamat ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
                </div>
                <!-- /row -->
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