<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$paths = view()->getFinder()->getHints();
if (isset($paths['filament-panels'])) {
    echo "filament-panels paths:\n";
    foreach ($paths['filament-panels'] as $p) {
        echo "  " . $p . "\n";
    }
} else {
    echo "filament-panels NOT registered\n";
}
