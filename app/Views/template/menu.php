<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <?php echo img('public/img/logo.png',true, 'alt="logo" class="logo"')?>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item"><?php echo anchor('/admin/home', '<i class="fa-solid fa-cubes"></i> Stock', 'class="nav-link"')?></li>
            <li class="nav-item"><?php echo anchor('/admin/prod', '<i class="fa-solid fa-guitar"></i> Produits', 'class="nav-link"')?></li>
            <li class="nav-item"><?php echo anchor('/admin/categ', '<i class="fa-solid fa-table-list"></i> Catégories', 'class="nav-link"')?></li>
            <li class="nav-item"><?php echo anchor('/admin/logout', '<i class="fa-solid fa-power-off"></i> Déconnexion', 'class="nav-link"')?></li>
        </ul>
    </div>
</nav>