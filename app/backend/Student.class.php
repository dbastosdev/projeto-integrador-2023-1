<?php
/* 
 * arquivo com métodos relacionados aos usuários do sistema
 */

class Student{
    private $pdo;

    public function	__construct(PDO	$pdo)
    {
        $this->pdo = $pdo;
    }

    public function index(){
        // Monta a query
        $sql = "SELECT * FROM students";

        // Realiza a consulta
        $result = $this->pdo->query($sql);
        $students = [];

        foreach($result as $user){
            $students[] = $user;
        }

        return $students;
    }
}   