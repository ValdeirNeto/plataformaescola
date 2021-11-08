<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');
    //------------------------------usuario---------------------------------------------
    Route::get('/users', 'UserController@index')->name('users');
    Route::get('/users/add', 'UserController@formAdd')->name('usersadd');
    Route::post('/users/add', 'UserController@create')->name('usersaddpost');
    Route::get('/users/edit/{id}', 'UserController@formEdit')->name('usersedit');
    Route::post('/users/edit', 'UserController@edit')->name('userseditpost');
    Route::get('/users/delete/{id}', 'UserController@delete')->name('usersdelete');
    //----------------------------------------------------------------------------------
    //------------------------------professor---------------------------------------------
    Route::get('/professor', 'ProfessorController@index')->name('professor');
    Route::get('/professor/add', 'ProfessorController@formAdd')->name('professoradd');
    Route::post('/professor/add', 'ProfessorController@create')->name('professoraddpost');
    Route::get('/professor/edit/{id}', 'ProfessorController@formEdit')->name('professoredit');
    Route::post('/professor/edit', 'ProfessorController@edit')->name('professoreditpost');
    Route::get('/professor/delete/{id}', 'ProfessorController@delete')->name('professordelete');
    Route::get('/professor/upload', 'ProfessorController@getupload')->name('professorupload');
    Route::post('/professor/upload', 'ProfessorController@postupload')->name('professoruploadpost');
    //----------------------------------------------------------------------------------
    //------------------------------aluno---------------------------------------------
    Route::get('/aluno', 'AlunoController@index')->name('aluno');
    Route::get('/aluno/add', 'AlunoController@formAdd')->name('alunoadd');
    Route::post('/aluno/add', 'AlunoController@create')->name('alunoaddpost');
    Route::get('/aluno/edit/{id}', 'AlunoController@formEdit')->name('alunoedit');
    Route::post('/aluno/edit', 'AlunoController@edit')->name('alunoeditpost');
    Route::get('/aluno/delete/{id}', 'AlunoController@delete')->name('alunodelete');
    Route::get('/aluno/upload', 'AlunoController@getupload')->name('alunoupload');
    Route::post('/aluno/upload', 'AlunoController@postupload')->name('alunouploadpost');
    //----------------------------------------------------------------------------------
    //------------------------------turma---------------------------------------------
    Route::get('/turma', 'TurmaController@index')->name('turma');
    Route::get('/turma/add', 'TurmaController@formAdd')->name('turmaadd');
    Route::post('/turma/add', 'TurmaController@create')->name('turmaaddpost');
    Route::get('/turma/edit/{id}', 'TurmaController@formEdit')->name('turmaedit');
    Route::post('/turma/edit', 'TurmaController@edit')->name('turmaeditpost');
    Route::get('/turma/delete/{id}', 'TurmaController@delete')->name('turmadelete');
    Route::get('/alunoporturma/{id}', 'TurmaController@alunoporturma')->name('alunoporturma');
    Route::post('/alunoporturma', 'TurmaController@alunoporturmacreate')->name('alunoturmaaddpost');
    //----------------------------------------------------------------------------------
    //------------------------------chamada eletronica----------------------------------
    Route::get('/chamada_eletronica', 'ChamadaEletronicaController@index')->name('chamadaeletronica');
    Route::get('/chamada_eletronica/realizar/{id}', 'ChamadaEletronicaController@formchamada')->name('chamadaform');
    Route::post('/chamada_eletronica/realizar', 'ChamadaEletronicaController@chamadaadd')->name('chamadaadd');
    Route::get('/chamada_eletronica/visualizar/{id}', 'ChamadaEletronicaController@visualizarchamada')->name('visualizarchamada');
    Route::post('/chamada_eletronica/visualizar/{id}', 'ChamadaEletronicaController@visualizarchamadapost')->name('visualizarchamadapost');
    //----------------------------------------------------------------------------------
    //------------------------------atividade----------------------------------
    Route::get('/atividade', 'AtividadeController@index')->name('atividade');
    Route::get('/atividade/add', 'AtividadeController@add')->name('atividadeAdd');
    Route::post('/atividade/add', 'AtividadeController@create')->name('atividadeCreate');
    //  Route::get('/atividade/edit/{id}', 'AtividadeController@edit')->name('atividadeEdit');
    Route::post('/atividade/edit', 'AtividadeController@save')->name('atividadeSave');
    Route::get('/atividade/delete/{id}', 'AtividadeController@delete')->name('atividadeDelete');
    Route::get('/atividade/{id}', 'AtividadeController@viewatividade')->name('viewatividade');
    Route::get('/atividade/edit/{id}', 'AtividadeController@editatividade')->name('atividadeEdit');
    Route::post('/atividade/enviar', 'RespostasAtividadesController@save')->name('enviaratividade');
    Route::get('/atividadecorrecao/{retorno}', 'RespostasAtividadesController@correcao')->name('atividadecorrecao');
    //----------------------------------------------------------------------------------
    Route::get('/aula/{id}', 'AulaController@aula')->name('aula');
    /**
    * Rotas referente a escola
    */
    Route::prefix('escola')->group(function () {
        Route::get('index', 'EscolaController@index')->name('schoolIndex');
        Route::get('add', 'EscolaController@add')->name('schoolAdd');
        Route::get('edit/{id}', 'EscolaController@edit')->name('schoolEdit');
        Route::post('edit/', 'EscolaController@save')->name('schoolSave');
        Route::post('create/', 'EscolaController@create')->name('schoolCreate');
        Route::get('delete/{id}', 'EscolaController@delete')->name('schoolDelete');        
    });    
    Route::get('/comunicado', 'ComunicadoController@index')->name('comunicado');
    Route::get('/comunicado/add', 'ComunicadoController@formAdd')->name('comunicadoadd');
    Route::post('/comunicado/add', 'ComunicadoController@create')->name('comunicadoaddpost');
    Route::get('/comunicado/edit/{id}', 'ComunicadoController@formEdit')->name('comunicadoedit');
    Route::post('/comunicado/edit', 'ComunicadoController@edit')->name('comunicadoeditpost');
    Route::get('/comunicado/delete/{id}', 'ComunicadoController@delete')->name('comunicadodelete');
    /*
     * Rotas referente a log
     */
    Route::get('/log', 'LogController@index')->name('log');
});