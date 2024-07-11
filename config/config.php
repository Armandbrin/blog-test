<?php
require_once("class/users.php");
require_once("class/posts.php");


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
        try {
            $sql = "SELECT * FROM users";
            $done = $this->bdd->query($sql);
            return $done->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }

    public function getAllPosts($param = null)
    {
        try {
            if (is_null($param)) {
                $sql = $this->bdd->prepare("SELECT * FROM posts");
            } else {
                $sql = $this->bdd->prepare("SELECT * FROM posts WHERE titre LIKE %$param%");
            }
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }

    public function addPost(posts $posts): void
    {
        try {
            $titre = $posts->getTitre();
            $post = $posts->getContenu();

            $sql = $this->bdd->prepare("INSERT INTO posts (titre, post) VALUES (:titre, :post)");
            $sql->bindParam(":titre", $titre);
            $sql->bindParam(":post", $post);
            $sql->execute();
        } catch (PDOException $e) {
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }

    public function addUser(users $user): void
    {
        try {
            $nom = $user->getNom();
            $prenom = $user->getPrenom();
            $email = $user->getEmail();
            $mdp = $user->getMdp();
            $age = $user->getAge();
            $statut = $user->getStatut();

            $sql = $this->bdd->prepare("INSERT INTO users (nom, prenom, email, mdp, age, statut) VALUES (:nom, :prenom, :email, :mdp, :age, :statut)");
            $sql->bindParam(":nom", $nom);
            $sql->bindParam(":prenom", $prenom);
            $sql->bindParam(":email", $email);
            $sql->bindParam(":mdp", $mdp);
            $sql->bindParam(":age", $age);
            $sql->bindParam(":statut", $statut);
            $sql->execute();
        } catch (PDOException $e) {
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }

    public function modif(posts $post){

            $id = $post->getId();
            $titre = $post->getTitre();
            $contenu = $post->getContenu();

            $sql = $this->bdd->prepare("UPDATE posts SET titre = :titre, post = :contenu WHERE id = :id");
            $sql->bindParam(":titre", $titre);
            $sql->bindParam(":contenu", $contenu);
            $sql->bindParam(":id", $id);
            $sql->execute();
 
    }

    public function sup(posts $post){

            $id = $post->getId();

            $sql = $this->bdd->prepare("DELETE FROM posts WHERE id = :id");
            $sql->bindParam(":id", $id);
            $sql->execute();
 
    }

    public function connexion($param = [])
    {
        try {
            $users = $this->getAllUsers();
            foreach ($users as $user) {
                if ($param["user"] == $user["email"] && password_verify($param['pass'], $user["mdp"])) {
                    return $user;
                }
            }
        } catch (PDOException $e) {
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }

    public function Disconnect()
    {
        $this->bdd = NULL;
    }
}
