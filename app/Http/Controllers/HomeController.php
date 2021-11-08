<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{User, Turma, Atividade, Comunicado};

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $alunos = User::where('permissao', 'aluno')->count();
        $professores = User::where('permissao', 'professor')->count();
        $turma = Turma::query()->count();
        $atividades = Atividade::all();
        $comunicados = Comunicado::where('data_validade', '>=', date("d-m-Y"))->get();
        return view('home', compact('atividades','alunos', 'professores','turma', 'comunicados'));
    }
}
