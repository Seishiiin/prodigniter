<?php

    namespace App\Models;

    use Config\Database;
    use Illuminate\Database\Eloquent\Model;

    class User extends Model {
        public $timestamps = false;

        public function isAdmin($nom,$pwd): int {
            $db = Database::connect();
            $builder = $db -> table('users');
            $query = $builder -> getWhere(['nom' => $nom, 'password' => $pwd, 'role' => 'admin']);
            return count($query -> getResult());
        }

    }

?>