<nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>

    <ul class="nav">

        <?php if($user['ROLEID'] == 1) { ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="../../dashboard/profile.php" role="button">
                <span class="avatar avatar-sm mt-2">
                    <img src="<?php echo $program['PROFILE'];?>" alt="..." class="avatar-img rounded-circle">
                </span>
            </a>
        </li>
        <?php } ?>
    </ul>
</nav>