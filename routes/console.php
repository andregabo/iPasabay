<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');
Artisan::command('iloveyou', function(){
	$danyel = rand(1,2);

	switch ($danyel) {
		case 1:
			$this->comment("i don't love you");
			break;
		
		case 2:
			$this->comment("i love you too");
			break;
		default:
			# code...
			break;
	}
	
});