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
            <a href="<?= base_url('index.php/admin/dashboard', '') ?>" class="logo"><img
                    src="<?= base_url('assets/img/icon.png', '') ?>" class="img-circle" width="50"><b> KMS -
                    <span>Syarfi
                    </span></b></a>
            <!--logo end-->

            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="<?php echo base_url() ?>index.php/admin/dashboard/logout">Logout </a>
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
            <div id="sidebar" class="nav-collapse ">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu" id="nav-accordion">
                    <p class="centered"><img src="<?= base_url('assets/img/' . $this->session->userdata('foto'));  ?>"
                            class="img-circle" width="80"></p>
                    <h5 class="centered"><?php echo $this->session->userdata("user_nama") ?></h5>
                    <h5 class="centered"><?php echo $this->session->userdata("jabatan") ?></h5>
                    <li class="mt">
                        <a class="active" href="<?= base_url('index.php/admin/dashboard', '') ?>">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('index.php/admin/profil', '') ?>">
                            <i class="fa fa-user"></i>
                            <span>Edit Profil</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('index.php/admin/user', '') ?>">
                            <i class="fa fa-users"></i>
                            <span>Data User</span>
                        </a>
                    </li>
                    </li>
                    <li>
                        <a href="<?= base_url('index.php/admin/knowledge', '') ?>">
                            <i class="fa fa-book"></i>
                            <span>Knowledge</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('index.php/admin/dokumen', '') ?>">
                            <i class="fa fa-paste"></i>
                            <span>Dokumen</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= base_url('index.php/admin/forum', '') ?>">
                            <i class="fa fa-comments"></i>
                            <span>Forum Diskusi</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('index.php/admin/notulensi', '') ?>">
                            <i class="fa fa-book"></i>
                            <span>Notulensi</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('index.php/admin/log', '') ?>">
                            <i class="fa fa-inbox"></i>
                            <span>Log Aktivitas</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('index.php/admin/nilai', '') ?>">
                            <i class="fa fa-trophy"></i>
                            <span>Nilai Aktivitas</span>
                        </a>
                    </li>
                    <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <h1 class="text-center">Tambah Dokumen</h1>
                <div class="row">
                    <div class="col-sm-9 col-sm-offset-1">
                        <?php
                        echo validation_errors('<div class="alert alert-danger">', '</div>');
                        ?>
                        <?= form_open('admin/dokumen/add', ['class' => 'form-horizontal']) ?>
                        <div class="form-group">
                            <label for="id_dokumen" class="col-sm-3 control-label">ID Dokumen</label>
                            <div class="col-sm-9">
                                <input type="text" maxlength="64" class="form-control" id="id_dokumen" name="id_dokumen"
                                    value="<?php echo $id_dokumen ?>" placeholder="ID Dokumen" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nip" class="col-sm-3 control-label">NIP</label>
                            <div class="col-sm-9">
                                <input type="text" maxlength="64" class="form-control" id="nip" name="nip"
                                    value="<?php echo $nip ?>" placeholder="NIP" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_user" class="col-sm-3 control-label">Nama User</label>
                            <div class="col-sm-9">
                                <input type="text" maxlength="64" class="form-control" id="nama_user" name="nama_user"
                                    value="<?php echo $user_nama ?>" placeholder="Nama User" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status_dokumen" class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-9">
                                <input type="text" maxlength="64" class="form-control" id="status_dokumen"
                                    name="status_dokumen" value="Request" placeholder="Status Dokumen" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi" class="col-sm-3 control-label">Deskripsi Dokumen</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                    value="<?= set_value('deskripsi') ?>" placeholder="Deskripsi Dokumen" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_dokumen" class="col-sm-3 control-label">Nama Dokumen</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen"
                                    value="<?= set_value('nama_dokumen') ?>" placeholder="Nama Dokumen" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kategori" class="col-sm-3 control-label">Kategori Dokumen</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kategori" name="kategori"
                                    value="<?= set_value('kategori') ?>" placeholder="Kategori Dokumen" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kategori" class="col-sm-3 control-label">*)Kategori Dokumen: MoU, SOP, dan
                                Umum</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tanggal Dokumen</label>
                            <div class="col-sm-9">
                                <input type="text" name="tgl_dokumen" class="form-control"
                                    value="<?php echo gmdate("d F Y", time() + 60 * 60 * 7); ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
                <br>
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