<?php
require_once("config/config.php");
$bdd = new bdd();
$bdd->connect();

$bdd->Disconnect();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Inscription</title>
</head>

<body>
    <header class="bg-red-900">
        <nav class="flex justify-center items-center gap-10 h-24">
            <a class="underline text-white text-lg" href="index.php">Accueil</a>
        </nav>
    </header>
    <main class="flex items-center flex-col mt-24">
        <h1 class="text-2xl mb-2">Inscription:</h1>
        <form class="flex flex-col gap-5 border-2 border-black p-5 rounded-lg w-[20vw]" action="connexion.php" method="post">
            <input class="border-2 border-black p-1 rounded-lg" type="text" name="i-nom" id="" placeholder="Nom">
            <input class="border-2 border-black p-1 rounded-lg" type="text" name="i-prenom" id="" placeholder="Prénom">
            <input class="border-2 border-black p-1 rounded-lg" type="email" name="i-email" id="" placeholder="Email*">
            <input class="border-2 border-black p-1 rounded-lg" type="password" name="i-mdp" id="" placeholder="Mot-de-passe*">
            <input class="border-2 border-black p-1 rounded-lg" type="number" name="i-age" id="" placeholder="Age">
            <button class="border-2 border-black p-1 bg-red-900 text-white rounded-lg w-full" type="submit" name="inscription">Envoyer</button>
        </form>
    </main>
</body>

</html>