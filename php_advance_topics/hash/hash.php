<?php
$password =  password_hash('testing', PASSWORD_BCRYPT);
echo "{$password}\n";

if(password_needs_rehash('testing', PASSWORD_BCRYPT, ['cost' => 12])) {

    $newHash = password_hash('testing', PASSWORD_BCRYPT, ['cost' => 12]);

    echo "{$newHash}\n";

}

print_r(password_get_info($newHash));