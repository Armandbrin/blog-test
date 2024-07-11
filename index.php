<?php
session_start();
require_once("config/config.php");
$bdd = new Bdd;
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
            <?php if (isset($_SESSION["user"])) {
                if ($_SESSION["user"]["statut"] == "admin") { ?>
                    <a class="underline text-white text-lg" href="admin.php">Admin</a>
                <?php } ?>
                <a class="border-2 border-black rounded-lg bg-white underline p-2" href="logout.php">Déconnexion</a>
            <?php } ?>
        </nav>
    </header>
    <main class="flex items-center flex-col mt-24">
        <?php foreach ($bdd->getAllPosts() as $post) { ?>
            <section class="flex flex-col gap-5 mb-5 rounded-lg border-2 border-black p-2 w-[50vw] h-auto">
                <p class="text-2xl underline text-center"><?php print $post["titre"]; ?></p>
                <p><?php print $post["post"]; ?></p>
            </section>
        <?php } ?>
    </main>
</body>

</html>