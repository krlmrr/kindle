<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('telescope:prune')->daily();

// This runs every minute, but only keeps the last hour of data.
// Schedule::command('telescope:prune --hours=1')->everyMinute();
