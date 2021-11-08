<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list single-page-breadcome">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                {{$view}}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                </div>
                                <div class="button-style-two btn-mg-b-10" align="right" style="margin-right: 5%">
                                    @if(isset($rotanovo))
                                    <a type="button" href="<?= route($rotanovo); ?>" class="btn btn-custon-rounded-two btn-success"><span style="color: #FFF">Novo</span></a>
                                    @endif
                                    <?php if(Auth::user()->permissao == 'admin' and isset($rotacarregaupload)):?>
                                        <a type="button" href="<?= route($rotacarregaupload); ?>" class="btn btn-custon-rounded-two btn-success"><span style="color: #FFF">Upload</span></a>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>