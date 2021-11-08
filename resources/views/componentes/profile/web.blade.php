<div class="menu-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class="header-right-info">
        <ul class="nav navbar-nav mai-top-nav header-right-menu">
            <li class="nav-item">
                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                <img src="<?= (Auth::user()->url_foto != "") ? '../../' . Auth::user()->url_foto :''?>" alt="" />
                <span class="admin-name">{{ Auth::user()->name }} </span>
                <!-- <i class="fa fa-angle-down edu-icon edu-down-arrow"></i> -->
                </a>
                <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                    <?php $routes = $permissao_usuario == 'aluno' ? 'alunoedit' : ($permissao_usuario == 'professor' ? 'professoredit': 'usersedit')  ?>
                    <li><a href="<?= route($routes, [Auth::user()->id]);?>"><span class="edu-icon edu-home-admin author-log-ic"></span>Minha Conta</a>
                    </li>
                    <!-- <li><a href="#"><span class="edu-icon edu-user-rounded author-log-ic"></span>My Profile</a>
                    </li>
                    <li><a href="#"><span class="edu-icon edu-money author-log-ic"></span>User Billing</a>
                    </li>
                    <li><a href="#"><span class="edu-icon edu-settings author-log-ic"></span>Settings</a>
                    </li> -->
                    <li> <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Sair') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>