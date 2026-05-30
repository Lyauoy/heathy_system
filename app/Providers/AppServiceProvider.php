<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- Make sure to add this import 

public function boot(): void
{
    if (app()->environment('production')) {
        URL::forceScheme('https');
    }
}
