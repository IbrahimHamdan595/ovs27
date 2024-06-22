<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="../../dashboard/analycis.php">
                <img src="../assets/img/poll-img.png" width="50px">
            </a>
        </div>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a class="nav-link pl-3" href="./analycis.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M20.25 10a1.25 1.25 0 1 0-2.5 0zm-14 0a1.25 1.25 0 1 0-2.5 0zm13.866 2.884a1.25 1.25 0 0 0 1.768-1.768zM12 3l.884-.884a1.25 1.25 0 0 0-1.768 0zm-9.884 8.116a1.25 1.25 0 0 0 1.768 1.768zM7 22.25h10v-2.5H7zM20.25 19v-9h-2.5v9zm-14 0v-9h-2.5v9zm15.634-7.884l-9-9l-1.768 1.768l9 9zm-10.768-9l-9 9l1.768 1.768l9-9zM17 22.25A3.25 3.25 0 0 0 20.25 19h-2.5a.75.75 0 0 1-.75.75zm-10-2.5a.75.75 0 0 1-.75-.75h-2.5A3.25 3.25 0 0 0 7 22.25z" />
                    </svg>
                    <span class="ml-3 item-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link pl-3" href="./monitor.php">
                    <svg width="1.5em" height="1.5em" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9 18V21M15 18V21M7 21H17M3 12H21M12 15H12.01M6.2 18H17.8C18.9201 18 19.4802 18 19.908 17.782C20.2843 17.5903 20.5903 17.2843 20.782 16.908C21 16.4802 21 15.9201 21 14.8V6.2C21 5.0799 21 4.51984 20.782 4.09202C20.5903 3.71569 20.2843 3.40973 19.908 3.21799C19.4802 3 18.9201 3 17.8 3H6.2C5.0799 3 4.51984 3 4.09202 3.21799C3.71569 3.40973 3.40973 3.71569 3.21799 4.09202C3 4.51984 3 5.07989 3 6.2V14.8C3 15.9201 3 16.4802 3.21799 16.908C3.40973 17.2843 3.71569 17.5903 4.09202 17.782C4.51984 18 5.07989 18 6.2 18Z"
                            stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="ml-3 item-text">Monitor</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link pl-3" href="./list.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M8 17q.425 0 .713-.288T9 16t-.288-.712T8 15t-.712.288T7 16t.288.713T8 17m0-4q.425 0 .713-.288T9 12t-.288-.712T8 11t-.712.288T7 12t.288.713T8 13m0-4q.425 0 .713-.288T9 8t-.288-.712T8 7t-.712.288T7 8t.288.713T8 9m3 8h6v-2h-6zm0-4h6v-2h-6zm0-4h6V7h-6zM5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h14q.825 0 1.413.588T21 5v14q0 .825-.587 1.413T19 21zm0-2h14V5H5zM5 5v14z" />
                    </svg>
                    <!-- candidates and admin -->
                    <span class="ml-3 item-text">Lists</span>
                </a>
            </li>
            <?php 
                 if ($user["ROLEID"] == 2) {
            ?>
            <li class="nav-item dropdown">
                <a class="nav-link pl-3" href="./candidate.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M15.71 12.71a6 6 0 1 0-7.42 0a10 10 0 0 0-6.22 8.18a1 1 0 0 0 2 .22a8 8 0 0 1 15.9 0a1 1 0 0 0 1 .89h.11a1 1 0 0 0 .88-1.1a10 10 0 0 0-6.25-8.19M12 12a4 4 0 1 1 4-4a4 4 0 0 1-4 4" />
                    </svg>
                    <!-- for admin -->
                    <span class="ml-3 item-text">candidates</span>
                </a>
            </li>

            <?php 
                 }
                 if ($user["ROLEID"] == 1) {
                 ?>

            <li class="nav-item dropdown">
                <a class="nav-link pl-3" href="./myArea.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 256 256">
                        <path fill="currentColor"
                            d="M108 80a20 20 0 1 1 20 20a20 20 0 0 1-20-20m-48 0a68 68 0 0 1 136 0c0 62.25-59.51 97-62.05 98.42a12 12 0 0 1-11.9 0C119.51 177 60 142.25 60 80m24 0c0 38.2 30.71 64.2 44 73.64c13.21-9.49 44-35.64 44-73.64a44 44 0 0 0-88 0m124.57 65.6a12 12 0 1 0-9.14 22.19C213.56 173.61 220 180.27 220 184c0 4-7.13 11.07-22.77 17.08c-18.3 7-42.89 10.92-69.23 10.92s-50.93-3.88-69.23-10.92C43.12 195.07 36 188 36 184c0-3.73 6.44-10.39 20.57-16.21a12 12 0 1 0-9.14-22.19C31.27 152.25 12 164.31 12 184c0 34.14 58.36 52 116 52c29.22 0 56.86-4.44 77.85-12.52C220.1 218 244 205.59 244 184c0-19.69-19.27-31.75-35.43-38.4" />
                    </svg>
                    <!-- voter of his area -->
                    <span class="ml-3 item-text">My Area</span>
                </a>
            </li>
            <?php
                 } 
                 if ($user["ROLEID"] == 2) {
            ?>
            <li class="nav-item dropdown">
                <a class="nav-link pl-3" href="./voter.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 16 16">
                        <path fill="currentColor"
                            d="M2 5.5a3.5 3.5 0 1 1 5.898 2.549a5.508 5.508 0 0 1 3.034 4.084a.75.75 0 1 1-1.482.235a4 4 0 0 0-7.9 0a.75.75 0 0 1-1.482-.236A5.507 5.507 0 0 1 3.102 8.05A3.493 3.493 0 0 1 2 5.5M11 4a3.001 3.001 0 0 1 2.22 5.018a5.01 5.01 0 0 1 2.56 3.012a.749.749 0 0 1-.885.954a.752.752 0 0 1-.549-.514a3.507 3.507 0 0 0-2.522-2.372a.75.75 0 0 1-.574-.73v-.352a.75.75 0 0 1 .416-.672A1.5 1.5 0 0 0 11 5.5A.75.75 0 0 1 11 4m-5.5-.5a2 2 0 1 0-.001 3.999A2 2 0 0 0 5.5 3.5" />
                    </svg>
                    <!-- for admin -->
                    <span class="ml-3 item-text">Voters</span>
                </a>
            </li>
            <?php 
                 }
                 ?>
            <li class="nav-item dropdown">
                <a class="nav-link pl-3" href="../Logic/auth/logout.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z" />
                    </svg>
                    <!-- for admin -->
                    <span class="ml-3 item-text">Logout</span>
                </a>
            </li>
        </ul>

    </nav>
</aside>