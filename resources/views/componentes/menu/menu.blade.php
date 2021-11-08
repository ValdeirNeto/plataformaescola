<div class="menu-lg-7 col-md-7 col-sm-7 col-xs-12">
    <div class="header-top-menu tabl-d-n" style="
    display: table;
    margin: auto;">
        <ul class="nav navbar-nav mai-top-nav">
            <li class="nav-item">
                <a class="" href="{{ route('home') }}">
                    <span class="nav-link">Inicio</span>
                </a>
            </li>
            <?php if(isset($menu) && count($menu) > 0 ): ?>
                <?php foreach ($menu as $key => $value): ?>

                    <?php
                    $descricao = $value['titulo'];
                    ?>

                    <?php if (count($value['submenu']) == 0): ?>
                        <li class="nav-item">
                            <a class="" href="<?=($value['route'] !== 'aula') ? route($value['route']) : route($value['route'], [Auth::user()->id] ) ?>"
                            <?=($value['route'] === 'aula') ? 'target = "blank"': '' ?> aria-expanded="false">
                                <span class="nav-link"><?= $descricao; ?></span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><?= $descricao; ?> <span class="angle-down-topmenu"><i class="fa fa-angle-down"></i></span></a>
                        <div role="menu" class="dropdown-menu animated zoomIn">
                            
                            <ul class="nav nav-second-level">
                                <?php foreach ($value['submenu'] as $submenu): ?>
                                    <?php
                                    $descricao2 = $submenu['titulo'];
                                    ?>
                                    <a href="<?=($submenu['route'] !== 'aula') ? route($submenu['route']) : route($submenu['route'], [Auth::user()->id] ) ?>" class="dropdown-item"><?= $descricao2; ?></a>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>



