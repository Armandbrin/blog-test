<?php
require_once("config/config.php");
session_start();
$bdd = new bdd;
$bdd->connect();

if (isset($_POST['ajouter'])) {

    $titre = htmlspecialchars($_POST['titre']);
    $post = htmlspecialchars($_POST['post']);

    $newPost = new posts();
    $newPost->setTitre($titre);
    $newPost->setPost($post);

    $bdd->addPost($newPost);
}

$bdd->Disconnect();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin</title>
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
    <main class="flex items-center flex-col mt-10">

        <h1 class="text-2xl mb-2">Ajouter post:</h1>
        <form class="flex items-center flex-col gap-5 border-2 border-black p-5 rounded-lg mb-10" action="" method="post">
            <input class="border-2 border-black p-1 rounded" type="text" name="titre" id="" placeholder="titre">
            <textarea class="border-2 border-black p-1 rounded resize-none overflow-y-scroll" name="post" id="" placeholder="Text"></textarea>
            <button class="border-2 border-black p-1 bg-red-900 text-white rounded-lg h-10" type="submit" name="ajouter">Ajouter</button>
        </form>

        <table class="border-collapse border border-slate-400 w-[50vw]">
            <input class="border-2 border-black rounded-lg mb-2 p-1" type="search" name="" id="" placeholder="Recherche">
            <thead>
                <tr>
                    <th class="border border-slate-300 p-1">Post</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bdd->getAllPosts() as $post) { ?>
                    <tr>
                        <td class="border border-slate-300 p-1"><?php print $post["post"]; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>

</html>