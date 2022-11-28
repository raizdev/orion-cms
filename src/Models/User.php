<?php
namespace Orion\Models;

use Orion\Framework\Database\DatabaseModel;

class User extends DatabaseModel {

    protected $table = 'users';

    protected $fillables = [
        'id', 'username', 'password', 'mail', 'account_created', 'last_login', 'online', 'last_online', 'motto', 'look', 'gender', 'rank', 'credits', 'auth_ticket', 'avatar_bg'
    ];

}