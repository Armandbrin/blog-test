<?php
session_start();
require_once("config/config.php");
$bdd = new bdd;
$bdd->connect();

if (isset($_POST['inscription'])) {

    $nom = htmlspecialchars($_POST['i-nom']);
    $prenom = htmlspecialchars($_POST['i-prenom']);
    $email = htmlspecialchars($_POST['i-email']);
    $mdp = htmlspecialchars($_POST['i-mdp']);
    $age = htmlspecialchars($_POST['i-age']);

    $newUser = new Users();
    $newUser->setNom($nom);
    $newUser->setPrenom($prenom);
    $newUser->setEmail($email);
    $newUser->setMdp(password_hash($mdp, PASSWORD_ARGON2ID));
    $newUser->setAge($age);
    $newUser->setStatut("user");

    $bdd->addUser($newUser);
}

$bdd->Disconnect();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Connexion</title>
</head>

<body>
    <header class="bg-red-900">
        <nav class="flex justify-center items-center gap-10 h-24">
            <a class="underline text-white text-lg" href="index.php">Accueil</a>
            <?php if (isset($_SESSION["user"])) { ?>
                <a class="border-2 border-black rounded-lg bg-white underline p-2" href="logout.php">Déconnexion</a>
            <?php } ?>
        </nav>
    </header>
    <main class="flex items-center flex-col mt-24">
        <h1 class="text-2xl mb-2">Connexion:</h1>
        <form class="flex flex-col gap-5 border-2 border-black p-5 rounded-lg w-[20vw]" action="index.php" method="post">
            <input class="border-2 border-black p-1 rounded-lg" type="email" name="c-email" id="" placeholder="Email">
            <input class="border-2 border-black p-1 rounded-lg" type="password" name="c-mdp" id="" placeholder="Mot-de-passe">
            <button class="border-2 border-black p-1 bg-red-900 text-white rounded-lg" type="submit" name="connexion">Envoyer</button>
            <a class="underline" href="inscription.php">Je n'ai pas de compte</a>
        </form>
        <?php if (isset($message)) {
            print $message;
        } ?>
    </main>
</body>

</html>