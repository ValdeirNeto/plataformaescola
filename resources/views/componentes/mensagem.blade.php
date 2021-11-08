<script>
    window.onload = function()
    {
        document.getElementById("btnmodal").click();
        setTimeout(() => {
            document.getElementById("fechamodal").click();
        }, 3000);
    }
    </script>
<button class="Primary mg-b-10" href="#" id="btnmodal"  data-toggle="modal" data-target="#modalalerta" style='display: none'>sscanf</button>
<div id="modalalerta" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog" style="margin-left: 80%;width: 17%;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="margin-left: -69%;margin-top: -9%;margin-right: -15%;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group-inner">
                        <div class="alert alert-success alert-st-one" role="alert">
                            <i class="fa fa-check edu-checked-pro admin-check-pro" aria-hidden="true"></i>
                            <p class="message-mg-rt"><?=session('mensagem')?></p>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    <a data-dismiss="modal" id="fechamodal" href="#" style="background: #284364" style="'display: none'"></a>
    </div>
</div>