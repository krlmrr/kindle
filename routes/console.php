<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('telescope:prune')->daily();

// Schedule::command('telescope:prune --hours=48')->daily();
