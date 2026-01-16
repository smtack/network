<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a href="<?= base_url() ?>" class="navbar-brand">network</a>

        <button
            class="navbar-toggler border-0"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMain"
            aria-controls="navbarMain"
            aria-expanded="false"
            aria-label="Toggle Menu">
            <img src="<?= base_url('public/img/Menu.svg') ?>" alt="Toggle Menu">
        </button>

        <div class="collapse navbar-collapse w-100 responsive-menu" id="navbarMain">
            <div class="mx-auto order-lg-2 w-100 w-lg-auto my-2 my-lg-0">
                <form class="d-flex justify-content-center" action="<?= base_url('search') ?>" method="GET">
                    <input
                        class="form-control"
                        style="max-width:450px;"
                        type="text"
                        name="s"
                        placeholder="Search"
                        value="<?= isset($keywords) ? str_replace('%', '', $keywords) : '' ?>">
                </form>

                <ul class="navbar-nav d-lg-none mt-3 pt-3">
                    <?php if($user->isLoggedIn()): ?>
                        <li class="nav-item">
                            <a href="<?= base_url('explore') ?>" class="nav-link d-flex align-items-center py-3 text-white">
                                <img src="<?= base_url('public/img/Explore.svg') ?>" alt="Explore" class="icon me-3">
                                Explore
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('likes') ?>" class="nav-link d-flex align-items-center py-3 text-white">
                                <img src="<?= base_url('public/img/Like.svg') ?>" alt="Likes" class="icon me-3">
                                Likes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('friends') ?>" class="nav-link d-flex align-items-center py-3 text-white">
                                <img src="<?= base_url('public/img/Friends.svg') ?>" alt="Friends" class="icon me-3">
                                Friends
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('update') ?>" class="nav-link d-flex align-items-center py-3 text-white">
                                <img src="<?= base_url('public/img/Settings.svg') ?>" alt="Update" class="icon me-3">
                                Update
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('logout') ?>" class="nav-link d-flex align-items-center py-3 text-white">
                                <img src="<?= base_url('public/img/Logout.svg') ?>" alt="Log Out" class="icon me-3">
                                Log Out
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                href="<?= base_url('profile/' . escape($user_info->user_username)) ?>"
                                class="nav-link f-flex align-items-center py-3 text-white">
                                <img
                                    src="<?= base_url("uploads/profile-pictures/$user_info->user_profile_picture") ?>"
                                    alt="Your Profile"
                                    class="rounded-circle me-3"
                                    width="40"
                                    height="40">
                                    Your Profile
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="<?= base_url('login') ?>" class="nav-link d-flex align-items-center py-3 text-white">
                                <img src="<?= base_url('public/img/Login.svg') ?>" alt="Log In" class="icon me-3">
                                Log In
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <ul class="navbar-nav ms-auto flex-row d-none d-lg-flex align-items-center order-lg-3">
                <?php if($user->isLoggedIn()): ?>
                    <li class="nav-item me-1 mt-1">
                        <a href="<?= base_url('explore') ?>" class="nav-link"><img class="icon" src="<?= base_url('public/img/Explore.svg') ?>" alt="Explore"></a>
                    </li>
                    <li class="nav-item me-1 mt-1">
                        <a href="<?= base_url('likes') ?>" class="nav-link"><img class="icon" src="<?= base_url('public/img/Like.svg') ?>" alt="Likes"></a>
                    </li>
                    <li class="nav-item me-1 mt-1">
                        <a href="<?= base_url('friends') ?>" class="nav-link"><img class="icon" src="<?= base_url('public/img/Friends.svg') ?>" alt="Friends"></a>
                    </li>
                    <li class="nav-item me-1 mt-1">
                        <a href="<?= base_url('update') ?>" class="nav-link"><img class="icon" src="<?= base_url('public/img/Settings.svg') ?>" alt="Update Profile"></a>
                    </li>
                    <li class="nav-item me-1 mt-1">
                        <a href="<?= base_url('logout') ?>" class="nav-link"><img class="icon" src="<?= base_url('public/img/Logout.svg') ?>" alt="Log Out"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('profile/' . escape($user_info->user_username)) ?>">
                            <img class="rounded-circle" width="35" height="35" src="<?= base_url("uploads/profile-pictures/$user_info->user_profile_picture") ?>" alt="Your Profile">
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item me-1 mt-1">
                        <a href="<?= base_url('login') ?>" class="nav-link"><img class="icon" src="<?= base_url('public/img/Login.svg') ?>" alt="Log In"></a>
                    </li>
                <?php endif; ?>
            </ul>
        </div><!-- Collapse -->
    </div>
</nav>