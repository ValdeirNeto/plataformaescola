<div class="content">
</div>


<nav role="navigation">
    <div id="menuToggle" >
        <input type="checkbox" />
        <span></span>
        <span></span>
        <span></span>

        <ul id="menu" style="    margin-top: 7.5%;position:fixed">
            <div>
                @include('componentes.profile.mobile')  
            </div>
            <div style="height: 450px;overflow-y: auto;margin-top:-50px">
                <div style="padding: 60px; background-color: #fff;" id='sub_menu'>
                    <li class="menu-style"><a href="#">Inicio</a></li><hr>
                    <?php if(isset($menu) && count($menu) > 0 ): ?>
                        <?php foreach ($menu as $key => $value): ?>



                            <?php
                            $descricao = $value['titulo'];
                            ?>
                            <?php if (count($value['submenu']) == 0): ?>
                                <li class="menu-style">
                                    <a class="" href="<?=($value['route'] !== 'aula') ? route($value['route']) : route($value['route'], [Auth::user()->id] ) ?>" aria-expanded="false">
                                        <?=$descricao; ?><hr>
                                    </a>
                                </li>
                                <?php else: ?>
                                <li class="menu-style"><a id = 'nav_mobile' href="#"><?=$descricao; ?>    </a><i id='seta' class="fa fa-angle-down"></i>
                                    <ul id = 'sub_menu_mobile' style= "display: none">
                                        <?php foreach ($value['submenu'] as $submenu): ?>
                                            <?php
                                            $descricao2 = $submenu['titulo'];
                                            ?>
                                            <li class="menu-style2">
                                                <a href="<?=($value['route'] !== 'aula') ? route($submenu['route']) : route($submenu['route'], [Auth::user()->id] ) ?>" class="dropdown-item"><?= $descricao2; ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li><hr>
                            <?php endif;?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div style="padding: 60px; background-color: #fff;height: 1000px;display:none" id='sub_menu_profile'>
                    <?php $routes = $permissao_usuario == 'aluno' ? 'alunoedit' : ($permissao_usuario == 'professor' ? 'professoredit': 'usersedit')  ?>
                    <li class="menu-style"><a href="<?= route($routes, [Auth::user()->id]);?>"><span class="edu-icon edu-home-admin author-log-ic"></span>Minha Conta</a>
                    </li><hr>
                    <li class="menu-style"> <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Sair') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </div>
            </div>

            
            <li class="nav-item">
                <a href="{{ route('home') }}"><h4 style= "padding-left: 55px; padding-top: 15px; color: white;" >SAPERE</h4></a>
            </li>
        
        </ul>
        
    </div>
</nav>
