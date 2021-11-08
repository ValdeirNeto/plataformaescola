<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Aluno;
use App\User;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $dominio = "sapere.lutecia.com.br";
        $alunos = Aluno::all();

        foreach($alunos as $aluno)
        {
            $nome = explode(' ',$aluno->nome);
            $email = $nome[0] .".". $nome[1];
            

            $email = preg_replace(
                        array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),
                        explode(" ","a A e E i I o O u U n N c C"),$email);
               
            $email = strtolower($email);

            $alunoupdate = Aluno::find($aluno->id);
            // $alunoupdate->email = $email."@".$dominio;
            $alunoupdate->save();

            $users = User::where('name', '=', $aluno->nome)->get();
            foreach($users as $user){
                $userupdate = User::find($user->id);
                $userupdate->email = $email."@".$dominio;
                $userupdate->password = Hash::make($email."@".$dominio);
             
                $userupdate->save();
            }
        }
        // $schedule->command('updateemail:update')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
