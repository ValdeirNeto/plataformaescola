<div class="container-educa">
    @if($permissao_usuario == 'aluno')
        @include('componentes.dashboards.aluno')
    @elseif($permissao_usuario == 'professor')
        @include('componentes.dashboards.professor', [$permissao_usuario])
    @else
        @include('componentes.dashboards.diretor', [$permissao_usuario])
    @endif
</div>