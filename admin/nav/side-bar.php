
    <!-- sidebar @s -->
    <div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
        <div class="nk-sidebar-element nk-sidebar-head">
            <div class="nk-sidebar-brand">
                <a href="<?php echo $link_general; ?>" class="logo-link nk-sidebar-logo">
                    <img class="logo-light logo-img" src="<?php echo $logo_only; ?>" srcset="<?php echo $logo_only; ?> 2x" alt="logo">
                    <img class="logo-dark logo-img" src="<?php echo $logo_only; ?>" srcset="<?php echo $logo_only; ?> 2x" alt="logo-dark">
                    <img class="logo-small logo-img logo-img-small" src="<?php echo $logo_only; ?>" srcset="<?php echo $logo_only; ?> 2x" alt="logo-small">
                </a>
            </div>
            <div class="nk-menu-trigger me-n2">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
            </div>
        </div><!-- .nk-sidebar-element -->
        <div class="nk-sidebar-element">
            <div class="nk-sidebar-content">
                <div class="nk-sidebar-menu" data-simplebar>
                    <?php include 'menu-side-bar.php'; ?>
                </div><!-- .nk-sidebar-menu -->
            </div><!-- .nk-sidebar-content -->
        </div><!-- .nk-sidebar-element -->
    </div>
    <!-- sidebar @e -->






