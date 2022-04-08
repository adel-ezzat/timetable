<nav class="sidebar sidebar-offcanvas" id="sidebar">
    
    <ul class="nav">

        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>
        <?php if(auth()->guard('admin')->check()): ?>
        <li class="nav-item menu-items <?php if( request()->segment(1) === 'dashboard'): ?>  active <?php endif; ?>">
            <a class="nav-link" href="<?php echo e(route('dashboard.index')); ?>">
                <span class="menu-icon">
                    <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Roles And Permissions')): ?>    
        <li class="nav-item menu-items <?php if( request()->segment(1) === 'role'): ?>  active <?php endif; ?>">
            <a class="nav-link" href="<?php echo e(route('role.index')); ?>">
                <span class="menu-icon">
                    <i class="mdi mdi-security"></i>
                </span>
                <span class="menu-title">Roles And Permissions</span>
            </a>
        </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Managers')): ?>
        <li class="nav-item menu-items <?php if( request()->segment(1) === 'admin'): ?>  active <?php endif; ?>">
            <a class="nav-link" href="<?php echo e(route('admin.index')); ?>">
                <span class="menu-icon">
                    <i class="mdi mdi-account-star"></i>
                </span>
                <span class="menu-title">Managers</span>
            </a>
        </li>
        <?php endif; ?>
        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Users')): ?>
        <li class="nav-item menu-items <?php if( request()->segment(1) === 'user'): ?>  active <?php endif; ?>">
            <a class="nav-link" href="<?php echo e(route('user.index')); ?>">
                <span class="menu-icon">
                    <i class="mdi mdi-account-multiple"></i>
                </span>
                <span class="menu-title">Users</span>
            </a>
        </li>
        <?php endif; ?>
        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Pharmacies')): ?>
        <li class="nav-item menu-items <?php if( request()->segment(1) === 'pharmacy'): ?>  active <?php endif; ?>">
            <a class="nav-link" href="<?php echo e(route('pharmacy.index')); ?>">
                <span class="menu-icon">
                    <i class="mdi mdi-pill"></i>
                </span>
                <span class="menu-title">Pharamcies</span>
            </a>
        </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Add Timetables')): ?>
        <li class="nav-item menu-items <?php if( request()->segment(1) === 'timetable'): ?>  active <?php endif; ?>">
            <a class="nav-link" href="<?php echo e(route('timetable.index')); ?>">
                <span class="menu-icon">
                    <i class="mdi mdi-calendar-clock"></i>
                </span>
                <span class="menu-title">Timetable</span>
            </a>
        </li>
        <?php endif; ?>
        <?php endif; ?>

        <?php if(auth()->guard('web')->check()): ?>
        <li class="nav-item menu-items <?php if( request()->segment(1) === 'home'): ?>  active <?php endif; ?>">
            <a class="nav-link" href="<?php echo e(route('home.index')); ?>">
                <span class="menu-icon">
                    <i class="mdi mdi-calendar-clock"></i>
                </span>
                <span class="menu-title">Timetable</span>
            </a>
        </li>
        <?php endif; ?>
        
    </ul>
</nav>
<?php /**PATH /Users/a/Desktop/timetable/resources/views/dashboard/partials/side-menu.blade.php ENDPATH**/ ?>