<?php
/* 
 * arquivo com métodos relacionados aos usuários do sistema
 */

class Login{
    private $pdo;

    public function	__construct(PDO	$pdo)
    {
        $this->pdo = $pdo;
    }

    public function index(){
        // Monta a query
        $sql = "SELECT * FROM users";

        // Realiza a consulta
        $result = $this->pdo->query($sql);
        $users = [];

        foreach($result as $user){
            $users[] = $user;
        }

        return $users;

    }

    public function login($email, $password){
        // Reset da variável global
        $_SESSION['user-data'] = " ";

        // Monta a query
        $sql = "SELECT * FROM users WHERE email = :email AND senha = :senha";

        //Prepara
        $query = $this->pdo->prepare($sql);

        // Executa a query:
        $query->execute([
            'email' => $email,
            'senha' => $password
        ]);

        // Realiza a consulta
        $result = $query->fetch();
        
        if($result > 0){
            $_SESSION['user-data'] = $result;
            header("Location: ../dashboard.php");
            exit;

        }else {
            header("Location: ../401.php");
            exit;
        }
    }

    public function logout(){
        $_SESSION['user-data'] = " ";
        header("Location: ../index.php");
        exit;
    }

    public function create($cnpj, $email,  $password, $user, $companyName){
        // Monta a query
        $sql = 	"INSERT	INTO users (`cnpj`, `email`, `senha`, `user`, `gym_name`)
        VALUES (:cnpj,	:email,	:pass,	:userName,	:companyName)";

        //Prepara
        $query = $this->pdo->prepare($sql);

        // Executa a query:
        $result = $query->execute([
            'cnpj' => $cnpj,
            'email' => $email,
            'pass' => $password,
            'userName' => $user,
            'companyName' => $companyName
        ]);

    
        $_SESSION['user'] = $result;
        header("Location: ../index.php");
        exit;
    }
}   