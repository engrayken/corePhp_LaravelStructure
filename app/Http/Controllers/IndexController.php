<?php

namespace App\Http\Controllers;

use Core\Database;

class IndexController
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];

            $db = new Database();
            $query = 'INSERT INTO users (username) VALUES (:username)';
            $stmt = $db->getPDO()->prepare($query);
            $stmt->execute([':username' => $username]);

            echo "User Registered Successfully!";
        }

        require_once __DIR__ . '/../../../resources/views/register.php';
    }
}
