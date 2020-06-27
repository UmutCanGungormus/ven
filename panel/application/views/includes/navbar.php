<?php $settings = get_settings(); ?>
<?php $user = get_active_user(); ?>
<!-- Top Navbar -->
<nav class="navbar navbar-expand-xl navbar-dark fixed-top hk-navbar">
    <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><i class="fa fa-list"></i></a>
    <a class="navbar-brand" href="<?=base_url()?>">
        <img class="brand-img d-inline-block" width="160" src="https://mutfakyapim.com/images/mutfak/logo.png?v=1" alt="Mutfak Yapım" />
    </a>
    <ul class="navbar-nav hk-navbar-content">
        <li class="nav-item dropdown dropdown-notifications">
            <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge-wrap"><span class="badge badge-primary badge-indicator badge-indicator-sm badge-pill pulse"></span></span></a>
            <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                <h6 class="dropdown-header">Notifications <a href="javascript:void(0);" class="">View all</a></h6>
                <div class="notifications-nicescroll-bar">
                    <a href="javascript:void(0);" class="dropdown-item">
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar avatar-sm">
                                    <img src="" alt="user" class="avatar-img rounded-circle">
                                </div>
                            </div>
                            <div class="media-body">
                                <div>
                                    <div class="notifications-text"><span class="text-dark text-capitalize">Evie Ono</span> accepted your invitation to join the team</div>
                                    <div class="notifications-time">12m</div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="javascript:void(0);" class="dropdown-item">
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar avatar-sm">
                                    <img src="#" alt="user" class="avatar-img rounded-circle">
                                </div>
                            </div>
                            <div class="media-body">
                                <div>
                                    <div class="notifications-text">New message received from <span class="text-dark text-capitalize">Misuko Heid</span></div>
                                    <div class="notifications-time">1h</div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="javascript:void(0);" class="dropdown-item">
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar avatar-sm">
                                    <span class="avatar-text avatar-text-primary rounded-circle">
                                        <span class="initial-wrap"><span><i class="fas fa-user font-18"></i></span></span>
                                    </span>
                                </div>
                            </div>
                            <div class="media-body">
                                <div>
                                    <div class="notifications-text">You have a follow up with<span class="text-dark text-capitalize"> Pinkman head</span> on <span class="text-dark text-capitalize">friday, dec 19</span> at <span class="text-dark">10.00 am</span></div>
                                    <div class="notifications-time">2d</div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="javascript:void(0);" class="dropdown-item">
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar avatar-sm">
                                    <span class="avatar-text avatar-text-success rounded-circle">
                                        <span class="initial-wrap"><span>A</span></span>
                                    </span>
                                </div>
                            </div>
                            <div class="media-body">
                                <div>
                                    <div class="notifications-text">Application of <span class="text-dark text-capitalize">Sarah Williams</span> is waiting for your approval</div>
                                    <div class="notifications-time">1w</div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="javascript:void(0);" class="dropdown-item">
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar avatar-sm">
                                    <span class="avatar-text avatar-text-warning rounded-circle">
                                        <span class="initial-wrap"><span><i class="fa fa-bell font-18"></i></span></span>
                                    </span>
                                </div>
                            </div>
                            <div class="media-body">
                                <div>
                                    <div class="notifications-text">Last 2 days left for the project</div>
                                    <div class="notifications-time">15d</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item dropdown dropdown-authentication">
            <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media">
                    <div class="media-img-wrap">
                        <div class="avatar">
                            <img src="<?=base_url("assets/img/avatar12.jpg")?>" alt="<?= $user->full_name; ?>" class="avatar-img rounded-circle">
                        </div>
                        <span class="badge badge-success badge-indicator"></span>
                    </div>
                    <div class="media-body">
                        <span><?= $user->full_name; ?><i class="fa fa-chevron-down"></i></span>
                    </div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                <a class="dropdown-item" href="<?= base_url("users/update_form/$user->id"); ?>"><i class="dropdown-icon fa fa-user"></i><span>Profilim</span></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url("logout"); ?>"><i class="dropdown-icon fa fa-power-off"></i><span>Çıkış Yap</span></a>
            </div>
        </li>
    </ul>
</nav>