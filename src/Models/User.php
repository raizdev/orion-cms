<?php
namespace KPN\App\Models;

use MinasORM\Database;

class User extends Database {

    protected $table = 'user';

    protected $fillables = [
        'id', 'username', 'password', 'mail', 'account_created', 'last_login', 'online', 'last_online', 'motto', 'look', 'gender', 'rank', 'credits', 'auth_ticket', 'avatar_bg'
    ];

}