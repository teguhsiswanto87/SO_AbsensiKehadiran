<?php
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    header("location:index.php?error=8");
} else {
    $session = session_id();
    ?>
    <div class="container-fluid">

        <!-- Brand -->
<!--        <a class="navbar-brand waves-effect" href="https://mdbootstrap.com/docs/jquery/" target="_blank">-->
<!--            <strong class="blue-text">-->
<!--                MDB-->
<!--            </strong>-->
<!--        </a>-->

        <!-- Collapse -->
<!--        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"-->
<!--                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">-->
<!--            <span class="navbar-toggler-icon"></span>-->
<!--        </button>-->

        <!-- Links -->
<!--        <div class="collapse navbar-collapse" id="navbarSupportedContent">-->

            <!-- Left -->
            <ul class="navbar-nav mr-auto">
                <!--<li class="nav-item active">
                    <a class="nav-link waves-effect" href="#">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect" href="https://mdbootstrap.com/docs/jquery/" target="_blank">About
                        MDB</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect"
                       href="https://mdbootstrap.com/docs/jquery/getting-started/download/"
                       target="_blank">Free
                        download</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect" href="https://mdbootstrap.com/education/bootstrap/"
                       target="_blank">Free
                        tutorials</a>
                </li>-->
            </ul>

            <!-- Right -->
            <ul class="navbar-nav nav-flex-icons">
                <li class="nav-item">
                    <a href="https://github.com/mdbootstrap/bootstrap-material-design"
                       class="nav-link border border-light rounded waves-effect"
                       target="_blank">
                        <img class="fab mr-2 rounded-circle" src="<?php echo $_SESSION['photo']; ?>"
                             style="width: 1.75rem">
                        </i><?php echo $_SESSION['nama']; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link waves-effect" onclick="return confirm(`Keluar Dari Sistem Administrator Absensi ?`)">
                        Logout
                    </a>
                </li>
            </ul>

        </div>

    </div>
<?php } ?>