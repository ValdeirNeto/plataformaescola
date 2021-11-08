<?php
namespace App\Helpers;

use App\User;
use App\Http\Request;
use App\Helpers\Funcoes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class UserHelper
{
    public static function createUser($request, $permission)
    {
        $user = new User();
        $user->name      = $request->nome;
        $user->email     = $request->email;
        $user->password  = Hash::make($request->email);
        $user->permissao = $permission;
        $user->save();
    }

    public static function editUser($request)
    {
        $user = User::where('email', $request->email)->get();
        $user->name      = $request->nome;
        $user->email     = $request->email;
        $user->password  = Hash::make($request->email);
        $user->push();
    }

    public static function deleteUser($email)
    {
        User::where('email', $email)->delete();
    }    

    public static function getPasswordUser($email)
    {
        $user = User::where('email', $email)->get()->toArray();
        $password = Funcoes::decrypt($user[0]['password']);
        return $password;
    }

    public static function getLoggedUserData()
    {
        return [
            'name' => Auth::user()->name,
            'email' => Auth::user()->email
        ];
    }
}