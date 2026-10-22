<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\checkout;
use App\Models\product;
use App\Models\cart_item;

foreach (User::all() as $u) {
    echo "USER {$u->id} | {$u->email} | admin=" . var_export($u->is_admin, true) . PHP_EOL;
}

echo 'products=' . product::count() . ' cart_items=' . cart_item::count() . ' orders=' . checkout::count() . PHP_EOL;
