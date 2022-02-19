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
            <a href="<?= base_url('index.php/admin/dashboard', '') ?>" class="logo"><img
                    src="<?= base_url('assets/img/icon.png', '') ?>" class="img-circle" width="50"><b> KMS -
                    <span>Syarfi
                    </span></b></a>
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="<?php echo base_url() ?>index.php/admin/dashboard/logout">Logout</a>
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
                            <i class="fa fa-bullhorn"></i>
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
                <h1 class="text-center">Tambah User</h1>
                <div class="row">
                    <div class="col-sm-9 col-sm-offset-1">
                        <?php
                        echo validation_errors('<div class="alert alert-danger">', '</div>');
                        ?>
                        <?= form_open('admin/user/simpan', ['class' => 'form-horizontal']) ?>
                        <div class="form-group">
                            <label for="id" class="col-sm-3 control-label">ID</label>
                            <div class="col-sm-9">
                                <input type="text" maxlength="64" class="form-control" id="id" name="id"
                                    value="<?= set_value('id') ?>" placeholder="ID" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nip" class="col-sm-3 control-label">NIP</label>
                            <div class="col-sm-9">
                                <input type="text" maxlength="64" class="form-control" id="nip" name="nip"
                                    value="<?= set_value('nip') ?>" placeholder="nip" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-3 control-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" maxlength="64" class="form-control" id="username" name="username"
                                    value="<?= set_value('username') ?>" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_user" class="col-sm-3 control-label">Nama User</label>
                            <div class="col-sm-9">
                                <input type="text" maxlength="64" class="form-control" id="nama_user" name="nama_user"
                                    value="<?= set_value('nama_user') ?>" placeholder="Nama User">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" maxlength="64" class="form-control" id="email" name="email"
                                    value="<?= set_value('email') ?>" placeholder="user@email.com" required>
                                <span class="help-block">Alamat surel digunakan sebagai nama pengguna anda untuk masuk
                                    nanti</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kataSandi" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" maxlength="32" class="form-control" id="kataSandi"
                                    name="password" value="<?= set_value('password') ?>" required>
                                <span class="help-block">Setidaknya harus terdiri dari 6 karakter atau lebih</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir" class="col-sm-3 control-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" maxlength="64" class="form-control" id="tempat_lahir"
                                    name="tempat_lahir" value="<?= set_value('tempat_lahir') ?>"
                                    placeholder="Tempat Lahir" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir" class="col-sm-3 control-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="date" maxlength="64" class="form-control" id="tgllahir" name="tgllahir"
                                    value="<?= set_value('tgllahir') ?>" placeholder="Tempat Lahir" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin" class="col-sm-3 control-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                                    <option value="" disabled selected hidden>Pilih Gender</option>
                                    <option value="L" <?= set_select('jenis_kelamin', 'L') ?>>Laki-laki</option>
                                    <option value="P" <?= set_select('jenis_kelamin', 'P') ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_hp" class="col-sm-3 control-label">No Handphone.</label>
                            <div class="col-sm-9">
                                <input type="tel" maxlength="24" class="form-control" id="no_hp" name="no_hp"
                                    value="<?= set_value('no_hp') ?>" placeholder="+6281234567"
                                    pattern="^(\+|[0])[0-9]+$" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_ktp" class="col-sm-3 control-label">No. KTP</label>
                            <div class="col-sm-9">
                                <input type="text" maxlength="64" class="form-control" id="no_ktp" name="no_ktp"
                                    value="<?= set_value('no_ktp') ?>" placeholder="No. KTP" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="npwp" class="col-sm-3 control-label">NPWP</label>
                            <div class="col-sm-9">
                                <input type="text" maxlength="64" class="form-control" id="npwp" name="npwp"
                                    value="<?= set_value('npwp') ?>" placeholder="NPWP" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role" class="col-sm-3 control-label">Role</label>
                            <div class="col-sm-9">
                                <select name="role" class="form-control" id="role" required>
                                    <option value="" disabled selected hidden>Pilih Grup User </option>
                                    <option value="1" <?= set_select('grup', '1') ?>>Admin</option>
                                    <option value="2" <?= set_select('grup', '2') ?>>User</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jabatan" class="col-sm-3 control-label">Jabatan</label>
                            <div class="col-sm-9">
                                <input type="text" maxlength="64" class="form-control" id="jabatan" name="jabatan"
                                    value="<?= set_value('jabatan') ?>" placeholder="Jabatan" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nomorTelepon" class="col-sm-3 control-label">Alamat Lengkap</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="alamat" placeholder="Masukkan alamat lengkap anda"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input type="submit" class="btn btn-primary" value="Input">
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