<div id="sidebar" class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">
        <p class="centered"><img src="<?= base_url('assets/img/' . $this->session->userdata('foto'));  ?>"
                class="img-circle" width="120"></p>
        <h5 class="centered"><?php echo $this->session->userdata("user_nama") ?></h5>
        <h5 class="centered"><?php echo $this->session->userdata("jabatan") ?></h5>
        <li class="mt">
            <a class="active" href="<?= base_url('index.php/user/dashboard', '') ?>">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url('index.php/user/profil', '') ?>">
                <i class="fa fa-user"></i>
                <span>Edit Profil</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url('index.php/user/user', '') ?>">
                <i class="fa fa-users"></i>
                <span>Data User</span>
            </a>
        </li>
        </li>
        <li>
            <a href="<?= base_url('index.php/user/knowledge', '') ?>">
                <i class="fa fa-book"></i>
                <span>Knowledge</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url('index.php/user/dokumen', '') ?>">
                <i class="fa fa-paste"></i>
                <span>Dokumen</span>
            </a>
        </li>

        <li>
            <a href="<?= base_url('index.php/user/forum', '') ?>">
                <i class="fa fa-bullhorn"></i>
                <span>Forum Diskusi</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url('index.php/user/notulensi', '') ?>">
                <i class="fa fa-paste"></i>
                <span>Notulensi</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url('index.php/user/log', '') ?>">
                <i class="fa fa-inbox"></i>
                <span>Log Aktivitas</span>
            </a>
        </li>
</div>