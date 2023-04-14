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

    public function create($name, $email, $paymentDate, $paymentStatus, $sport){
        // Monta a query
        $sql = 	"INSERT	INTO students (`name`, `email`, `start`, `payment-status`, `sport`)
        VALUES (:studentName, :email, :paymentDate, :paymentStatus,	:sport)";

        //Prepara
        $query = $this->pdo->prepare($sql);

        // Executa a query:
        $result = $query->execute([
            'studentName' => $name,
            'email' => $email,
            'paymentDate' => $paymentDate,
            'paymentStatus' => $paymentStatus,
            'sport' => $sport
        ]);

        // Volta para página com a lista dos alunos
        header("Location: ../students.php");
        exit;
    }

    public function edit($id){

        $_SESSION['student-data'] = " ";

        // Monta a query
        $sql = "SELECT * FROM students WHERE id = :id";

        //Prepara
        $query = $this->pdo->prepare($sql);

        // Executa a query:
       $query->execute([
            'id' => $id
        ]);

        // Realiza a consulta
        $result = $query->fetch();

    
        $_SESSION['student-data'] = $result;
        header("Location: ../students-edit.php");
        exit;
    }

    public function update($name, $email, $paymentDate, $paymentStatus, $sport, $id){
        // Monta a query
        // Atenção ao campo payment-status da tabela. O nome composto exige descrição especial no update.
        $sql = 	"UPDATE	students SET name=:studentName, email=:email, start=:paymentDate, `payment-status`=:paymentStatus, 
        sport=:sport WHERE id=:id";

        //Prepara
        $query = $this->pdo->prepare($sql);

        // Executa a query:
        $result = $query->execute([
            'studentName' => $name,
            'email' => $email,
            'paymentDate' => $paymentDate,
            'paymentStatus' => $paymentStatus,
            'sport' => $sport,
            'id'=> $id
        ]);

        // Volta para página com a lista dos alunos
        header("Location: ../students.php");
        exit;
    }

    public function delete($id){
        // Monta a query
        $sql = 	"DELETE FROM students WHERE id=:id";

        //Prepara
        $query = $this->pdo->prepare($sql);

        // Executa a query:
        $query->execute([
            'id'=> $id
        ]);

        // Volta para página com a lista dos alunos
        header("Location: ../students.php");
        exit;
    }
}   