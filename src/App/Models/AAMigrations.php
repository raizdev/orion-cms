<?php
namespace KPN\App\Models;

use MinasORM\Database;

class AAMigrations extends Database {

    protected $table = 'aamigrations';

    protected $fillables = [
        'id', 'batchnr', 'dslam', 'old_aa', 'new_aa', 'plandate', 'mig_type'
    ];

}