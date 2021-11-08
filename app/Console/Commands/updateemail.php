<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
class updateemail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
echo 'teste';die;
        $alunos = DB::table('aluno')->get();
        echo $alunos;die;

        foreach($alunos as $aluno)
        {
            $nome = explode(' ',$aluno->name);
            $email = $nome[0] .".". $nome[1];

            $alunoupdate = Aluno::find($aluno->id);
            $alunoupdate->email = $email."@".$dominio;
            $alunoupdate->password = $email."@".$dominio;
            $alunoupdate->save();

            $users = User::where('name', '=', $aluno->name);
            foreach($users as $user){
                $userupdate = User::find($user->id);
                $userupdate->email = $email."@".$dominio;
                $userupdate->password = $email."@".$dominio;
                $userupdate->save();
            }
        }
    }
}
