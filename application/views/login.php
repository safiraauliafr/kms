<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KMS Syarfi</title>
    <link type="text/css" href="<?php echo base_url() . "assets/"; ?>login/bootstrap/css/bootstrap.min.css"
        rel="stylesheet">
    <link type="text/css" href="<?php echo base_url() . "assets/"; ?>login/bootstrap/css/bootstrap-responsive.min.css"
        rel="stylesheet">
    <link type="text/css" href="<?php echo base_url() . "assets/"; ?>login/css/theme.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url() . "assets/"; ?>login/images/icons/css/font-awesome.css"
        rel="stylesheet">
    <link type="text/css"
        href='<?php echo base_url() . "assets/"; ?>http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
        rel='stylesheet'>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css', '') ?>">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url('assets/img/icon.png', '') ?>" />
</head>

<body>

    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <i class="icon-reorder shaded"></i>
                </a>
                <a class="brand" href="#">
                    KMS - PT. Syarfi Teknologi Finansial
                </a>
            </div>
        </div>
    </div>

    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="module module-login span4 offset4">
                    <form action="<?php echo base_url() ?>index.php/login/masuk" method="post" class="form-vertical">
                        <div class="module-head">
                            <img src="<?= base_url('assets/img/bg2.png', '') ?>" class="center" width="300">
                            <h4> </h4>
                            <?php if (isset($error)) {
                                echo $error;
                            }; ?>
                        </div>
                        <div class="module-body">
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input class="span12" type="text" id="username" name="username"
                                        placeholder="Username" autofocus>
                                    <?php echo form_error('username'); ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input class="span12" type="password" id="password" name="password"
                                        placeholder="Password">
                                    <?php echo form_error('password'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="module-foot">
                            <div class="control-group">
                                <div class="controls clearfix">
                                    <button type="submit" class="btn btn-primary pull-right">Login</button>
                                </div>
                            </div>
                            <br />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br />
        <br />
        <br />
        <br />
    </div>

    <div class="footer">
        <div class="container">
            <b class="copyright">PT. Syarfi Teknologi Finansial </b> &copy; 2019
        </div>
    </div>
    <script src="<?php echo base_url() . "assets/"; ?>login/scripts/jquery-1.9.1.min.js" type="text/javascript">
    </script>
    <script src="<?php echo base_url() . "assets/"; ?>login/scripts/jquery-ui-1.10.1.custom.min.js"
        type="text/javascript">
    </script>
    <script src="<?php echo base_url() . "assets/"; ?>login/bootstrap/js/bootstrap.min.js" type="text/javascript">
    </script>
</body>

</html>