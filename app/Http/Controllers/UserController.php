<?php

namespace App\Http\Controllers;

use App\User;
use App\Helpers\{Funcoes, LoggerHelper};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserFormRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $isMobile = Funcoes::isMobile();
        return view('users.listusers', compact('users','isMobile'));
    }

    public function formAdd()
    {
        $local = 'Incluir';
        return view('users.formusers', compact('local'));
    }

    public function formEdit($id)
    {
        $local = 'Editar';
        $user = User::where('id', $id)->get()->toArray();
        $user[0]['password'] = '';
        return view('users.formusers', compact('local','user'));
    }

    public function create(UserFormRequest $request)
    {
        $user = new User;
        $user->name      = $request->name;
        $user->email     = $request->email;
        $user->password  = Hash::make($request->password); 
        $user->permissao = $request->permissao;
        $user->status    = $request->status;
        $user->save();
        return redirect('users')->with('mensagem', 'Usuário cadastrada com sucesso!')->with('icon', 'success'); 
    } 

    public function edit(UserFormRequest $request)
    {
        $user = User::find($request->id);
        $user->name      = $request->name;
        $user->email     = $request->email;
        if($request->password !== null){
            $user->password = Hash::make($request->password);
        }
        $user->permissao = $request->permissao;
        $user->status    = $request->status;
        $user->save();
        return redirect('users')->with('mensagem', 'Usuário editado com sucesso!')->with('icon', 'success'); 
    } 

    public function delete($id)
    {
        User::where('id', $id)->delete();
        return redirect('users')->with('mensagem', 'Usuário excluido com sucesso!')->with('icon', 'success'); 
    }
}
