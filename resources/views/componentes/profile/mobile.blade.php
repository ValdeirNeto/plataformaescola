<div class="header-top-area" style="border: none; ">
    <div class="row">
        <div class="header-right-info">
            <ul style="padding-bottom: 0px;"class="nav navbar-nav mai-top-nav header-right-menu">
                <li class="nav-item">
                    <a style="padding-top: 25px;">
                        <img src="<?= (Auth::user()->url_foto != "") ? '../../' . Auth::user()->url_foto :''?>" alt="" style="width: 50px; height: 50px;"/>
                        <h5 class="admin-name" style="margin-left:15px;">{{ Auth::user()->name }} </h5><br><br>
                    </a>
                    
                </li>
            </ul>
        </div>
    </div><hr><a id='nav_profile' href="#">
    <i id='seta_profile' class="fa fa-angle-down" style="margin-left: 50%;
    color: #fff;
    font-size: 20px;    width: 50%"></i></a>
</div>