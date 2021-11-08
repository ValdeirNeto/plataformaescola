<?php 
    function isMobile() {
        $is_mobile = false;

        //Se tiver em branco, não é mobile
        if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
            $is_mobile = false;

        //Senão, se encontrar alguma das expressões abaixo, será mobile
        } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
                $is_mobile = true;

        //Senão encontrar nada, não será mobile
        } else {
            $is_mobile = false;
        }
        return $is_mobile;
    }


?>


<?php $ismobile = isMobile();?>

<?php if(!$ismobile):?>
    @include('componentes.logo')
    @include('componentes.menu.menu', [$permissao_usuario]) 
    @include('componentes.profile.web') 
<?php else: ?>
    @include('componentes.menu.menumobile', [$permissao_usuario]) 
<?php endif; ?>