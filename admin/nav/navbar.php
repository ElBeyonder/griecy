

    <div class="nk-header nk-header-fixed is-light">
        <input type="hidden" class="d-none" value="<?php echo $link_general; ?>" id="link_general">
        <div class="container-fluid">
            <div class="nk-header-wrap">
                <div class="nk-menu-trigger d-xl-none ms-n1">
                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                 </div>
                <div class="nk-header-brand d-xl-none">
                    <a href="<?php echo $link_general; ?>" class="logo-link">
                        <img class="logo-light logo-img" src="<?php echo $logo_only; ?>" srcset="<?php echo $logo_only; ?> 2x" alt="logo">
                        <img class="logo-dark logo-img" src="<?php echo $logo_only; ?>" srcset="<?php echo $logo_only; ?> 2x"  alt="logo-dark">
                    </a>
                </div><!-- .nk-header-brand -->
                <div class="nk-header-search ms-3 ms-xl-0">
                    <div class="form-control-wrap">
                        <div class="input-group">
                            <div class="input-group-prepend"><button type="button" class="btn btn-primary"><i class="fas fa-search"></i></button></div>
                            <input type="text" class="form-control" id="search" placeholder="Buscar...">
                        </div>
                    </div>
                </div>
                <div class="nk-header-tools">
                    <ul class="nk-quick-nav" id="nav_tools">
                        <li id="li_button_agregar"><button id="button_default_add" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_agregar_item">Agregar</button></li>
                        <li class="dropdown user-dropdown">
                            <a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
                                <div class="user-toggle">
                                    <div class="user-avatar sm"><em class="icon ni ni-user-alt"></em></div>
                                    <div class="user-info d-none d-xl-block">
                                        <div class="user-name dropdown-indicator">Andres Chantre</div>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
                                <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                    <div class="user-card">
                                        <div class="user-avatar"><span>AB</span></div>
                                        <div class="user-info">
                                            <span class="lead-text">Andres Felipe Chantre</span>
                                            <span class="sub-text">ceo@jeloda.com</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-inner">
                                    <ul class="link-list">
                                        <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                    </ul>
                                </div>
                                <div class="dropdown-inner">
                                    <ul class="link-list">
                                        <li><a id="salir" href="#"><em class="icon ni ni-signout"></em><span>Salir</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- .nk-header-wrap -->
        </div><!-- .container-fliud -->
    </div>








