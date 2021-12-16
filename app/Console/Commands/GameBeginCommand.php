<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Validator;

class GameBeginCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:begin';

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
     * @return int
     */
    public function handle()
    {
        $flag_win = false;
        $this->info("Welcome, Let the game begin!");
        $team_A_arr = $this->ask('Enter Team A players');
        $team_B_arr = $this->ask('Enter Team B players');
        $input['team_A'] =  $team_A_arr = explode(",", str_replace(" ", "", $team_A_arr));
        $input['team_B'] = $team_B_arr = explode(",", str_replace(" ", "", $team_B_arr));
        $this->performValidations($input);

        $new_TeamA_arr = array();

        //1. Loop through Team B
        foreach($team_B_arr as $keyB=>$valueB)
        {
            #$val = countGreater($team_A_arr, $value);
            $filtered = collect($team_A_arr)->filter(function ($value, $key) use ($valueB) {
                return $value > $valueB;
            });

            $new_TeamA_arr[] = $var = $filtered->sort()->values()->first();
            if($var =='' or $var == NULL)
            {
                $this->line("Team A, you lose");
                $flag_win = false;
                break;
            }
            else
            {
                $flag_win = true;
                $keyA = array_search($var, $team_A_arr);
                unset($team_A_arr[$keyA]);
            }


            #$team_A_arr->forget(array_keys($team_A_arr, $filtered->sort()->first()));

        }
        if($flag_win == true)
        {
            $this->line("Congratulations Team A!!! You've won this game");
            $this->line("Team A ". var_dump($new_TeamA_arr));
        }


    }
    public function performValidations($input)
    {
        $rules = [
            'team_A' => 'required|array|size:5',
            'team_B' => 'required|array|size:5',
            'team_A.*' => 'numeric',
            'team_B.*' => 'numeric', // check each item in the array
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $this->info('See error messages below:');

            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }

    }


}
