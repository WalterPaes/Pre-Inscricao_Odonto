<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 28/01/2019
 * Time: 17:28
 */

namespace Model;

use Database\Database;

class QuestionarioModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}