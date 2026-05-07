<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = App\Models\User::find(1);
if ($user) {
    $user->email = 'syedadeelabbas151@gmail.com';
    $user->password = bcrypt('Alimola1214');
    $user->save();
    echo "User updated successfully!\n";
} else {
    echo "User not found!\n";
}