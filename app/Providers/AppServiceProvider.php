<?php

namespace App\Providers;

use DB;
use App\{User, Turma, Professor, Escola, Comunicado, Aluno};
use App\Observers\{UserObserver, ComunicadoObserver, TurmaObserver, ProfessorObserver, AlunoObserver, EscolaObserver};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    Public function boot()
    { 
        User::observe(UserObserver::class);
        Turma::observe(TurmaObserver::class);
        Professor::observe(ProfessorObserver::class);
        Escola::observe(EscolaObserver::class);
        Comunicado::observe(ComunicadoObserver::class);
        Aluno::observe(AlunoObserver::class);
        view()->composer('componentes.menu.*', function($view) {
            $menu = null;
            $permissao = '%'.\Auth::user()->permissao.'%';
            $menus = DB::select("select * from menu where permissao LIKE '$permissao'");

            foreach($menus as $mod){
                if(count($menus) > 1){
                    $menu[$mod->id] = [
                        "titulo" => $mod->titulo,
                        "topmenu" => $this->processaTopMenu($mod->modulo)
                    ];
                }else{
                    $menu = $this->processaTopMenu($mod->modulo);
                }
            }
            $view->with('menu', $menu);
        });
    }

    protected function processaTopMenu($modulos)
    {
        $menus = $this->processaMenu($modulos);

        foreach ($menus as $key => $value) {
            $menu[$value->id] = [
                "ordem" => $value->ordem,
                "titulo" => $value->titulo,
                "route" => $value->route,
                'filho' => [],
                'submenu' => $this->processaSubMenu($value->id, $modulos)
            ];
        }
        return $menu;
    }

    protected function processaMenu($role)
    {
        $permissao = '%'.\Auth::user()->permissao.'%';
        $modulo_menu = DB::select("select * from menu_$role where filho is NULL and permissao LIKE '$permissao'");
        return $modulo_menu;
    }

    protected function processaSubMenu($menu, $role)
    {
        $permissao = '%'.\Auth::user()->permissao.'%';
        $modulo_menu = DB::select("select * from menu_$role where filho is NOT NULL and filho = $menu and permissao LIKE '$permissao'");

        $r = [];
        if (count($modulo_menu) > 0) {
            foreach ($modulo_menu as $key => $value) {
                $r[$value->id] = [
                    "ordem" => $value->ordem,
                    "titulo" => $value->titulo,
                    "route" => $value->route,
                ];

                if (!is_null($value->route)) {
                    $r[$value->id]['submenu'] = $this->processaSubMenu($value->id, $role);
                }
            }
        }
        return $r;
    }
}
