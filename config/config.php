<?php
require_once("config/users.php");
require_once("config/posts.php");


class Bdd
{

    private $bdd;

    public function connect()
    {

        try {

            $this->bdd = new PDO("mysql:host=localhost;dbname=bdd-test", 'root', '');
            return $this->bdd;
        } catch (PDOException $e) {

            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        $done = $this->bdd->query($sql);
        return $done->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllPosts()
    {
        $sql = "SELECT * FROM posts";
        $done = $this->bdd->query($sql);
        return $done->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPost(posts $posts) : void{

        $titre = $posts->getTitre();
        $post = $posts->getPost();

        $sql = $this->bdd->prepare("INSERT INTO posts (titre, post) VALUES (:titre, :post)");
        $sql->bindParam(":titre", $titre);
        $sql->bindParam(":post", $post);
        $sql->execute();

    }

    public function addUser(users $user): void
    {
        $nom = $user->getNom();
        $prenom = $user->getPrenom();
        $email = $user->getEmail();
        $mdp = $user->getMdp();
        $age = $user->getAge();

        $sql = $this->bdd->prepare("INSERT INTO users (nom, prenom, email, mdp, age) VALUES (:nom, :prenom, :email, :mdp, :age)");
        $sql->bindParam(":nom", $nom);
        $sql->bindParam(":prenom", $prenom);
        $sql->bindParam(":email", $email);
        $sql->bindParam(":mdp", $mdp);
        $sql->bindParam(":age", $age);
        $sql->execute();
    }

    public function connexion($param = [])
    {

        $users = $this->getAllUsers();
        foreach ($users as $user) {
            if ($param["user"] == $user["email"] && password_verify($param['pass'], $user["mdp"])) {
                return $user;
            }
        }
    }

    public function Disconnect()
    {
        $this->bdd = NULL;
    }
}
