<?php
session_start();
require_once("config/config.php");
$bdd = new bdd;
$bdd->connect();

$users = $bdd->getAllUsers();

if (isset($_POST['connexion'])) {

    $email = htmlspecialchars($_POST['c-email']);
    $mdp = htmlspecialchars($_POST['c-mdp']);

    if (!empty($_POST['c-email']) && !empty($_POST['c-mdp'])) {
        $user = $bdd->connexion(["user" => $email, "pass" => $mdp]);
        if ($user) {
            $_SESSION["user"] = $user;
        }
        $message = NULL;
    } else {
        $message = "Une case est vide";
    }
}

$bdd->Disconnect();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Accueil</title>
</head>

<body>
    <header class="bg-red-900">
        <nav class="flex justify-center items-center gap-10 h-24">
            <a class="underline text-white text-lg" href="connexion.php">Connexion</a>
            <?php if (isset($_SESSION["user"])) { ?>
                <a class="underline text-white text-lg" href="admin.php">Admin</a>
                <a class="border-2 border-black rounded-lg bg-white underline p-2" href="logout.php">Déconnexion</a>
            <?php } ?>
        </nav>
    </header>
    <main class="flex items-center flex-col mt-24">
       <section class="border-2 border-black p-5">
            <p>Info utilisateur</p>
       </section>
    </main>
</body>

</html>