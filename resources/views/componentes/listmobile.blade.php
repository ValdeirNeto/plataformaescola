    <div class="single-review-st-item res-mg-t-30 table-mg-t-pro-n">
        @if(isset($valores) && count($valores) > 0)
            @foreach($valores as $valor)
            <div class="single-review-st-text">
                <div class="review-ctn-hf">
                    <?php if(isset($campos)):?>
                        <?php for($i=0; $i < count($campos); $i++):?>
                            <?php if($campos[$i] == 'id'):?>
                                <h3><b><?= str_pad($valor[$campos[$i]], 4, "0", STR_PAD_LEFT); ?></b></h3>
                            <?php else:?>
                                <p><?= $valor[$campos[$i]]?></p>
                            <?php endif;?>
                        <?php endfor;?>
                    <?php endif;?>
                </div>
                <div class="review-item-rating" style="width: 80px;">
                    <?php $id = isset($valor->id) ? $valor->id : $valor['id'];?>
                    <a type="button" href="<?= route($rotaedit, [$id]);?>"><i class="" aria-hidden="true"></i>Editar</a>
                    <?php if(isset($rotaalunoporturma)):?>
                        <a type="button"  href="<?= route($rotaalunoporturma, [$id]);?>"><i class="" aria-hidden="true"></i>Aluno por turma</a>
                    <?php endif;?>
                    @if(isset($rotaatividade))
                    <a type="button"  href="<?= route($rotaatividade, [$id]);?>"><i class="" aria-hidden="true"></i>Atividade</a>
                    @endif
                    <a type="button" href="<?= route($rotadelete, [$id]);?>" style="color: red"><i class="" aria-hidden="true"></i>Delete</a>
                </div>
            </div>
            <hr>
            @endforeach
        @endif
    </div>