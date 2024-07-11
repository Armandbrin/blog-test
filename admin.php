<?php
require_once("config/config.php");
session_start();

$bdd = new Bdd;
$bdd->connect();

$newPost = new posts();

if (isset($_POST['ajouter'])) {

    $titre = htmlspecialchars($_POST['titre']);
    $post = htmlspecialchars($_POST['post']);

    $newPost->setTitre($titre);
    $newPost->setContenu($post);

    $bdd->addPost($newPost);
}

if (isset($_POST['modifie'])) {

    $titre = htmlspecialchars($_POST['titre2']);
    $contenu = htmlspecialchars($_POST['contenu2']);
    $id = $_POST['modifie'];

    $modifPost = new posts();
    $modifPost->setTitre($titre);
    $modifPost->setId($id);
    $modifPost->setContenu($contenu);
    $bdd->modif($modifPost);
}

if (isset($_POST['supprime'])) {

    $id = $_POST['supprime'];

    $modifPost = new posts();
    $modifPost->setId($id);
    $bdd->sup($modifPost);
}

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
            <textarea class="border-2 border-black p-1 rounded resize-none overflow-y-scroll w-[50vw] h-28" name="post" id="" placeholder="Text"></textarea>
            <button class="border-2 border-black p-1 bg-red-900 text-white rounded-lg h-10" type="submit" name="ajouter">Ajouter</button>
        </form>
        <form class="flex mb-2 gap-2" action="" method="post">
            <input class="border-2 border-black rounded-lg p-1" type="search" name="recherche" id="" placeholder="Recherche">
            <button class="border-2 border-black rounded-lg p-1 bg-red-900 text-white" type="submit" name="rechercher">Rechercher</button>
        </form>
        <table class="border-collapse border border-slate-400 w-[70vw] mb-24">

            <thead>
                <tr>
                    <th class="border-2 border-black p-1 w-[10vw]">Titre</th>
                    <th class="border-2 border-black p-1 w-[50vw]">Post</th>
                    <th class="border-2 border-black p-1 w-[1vw]">Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($bdd->getAllPosts() as $post) { ?>
                    <tr>
                        <form action="" method="post">
                            <td class="border-2 border-black p-1"><textarea class="border-2 border-black p-1 rounded resize-none w-full h-[15vh]" name="titre2" id=""><?php print $post["titre"]; ?></textarea></td>
                            <td class="border-2 border-black p-1"><textarea class="border-2 border-black p-1 rounded resize-none overflow-y-scroll w-full h-[15vh]" name="contenu2" id=""><?php print $post["post"]; ?></textarea></td>
                            <td class="border-2 border-black p-1">

                                <button action="modif.php" class="border-2 border-black p-1 bg-red-900 rounded-lg text-white w-24 mb-1" type="submit" name="modifie" value="<?php print $post["id"]; ?>">Modifier</button>

                                <button class="border-2 border-black p-1 bg-red-900 rounded-lg text-white w-24" type="submit" name="supprime" value="<?php print $post["id"]; ?>">Supprimer</button>

                            </td>
                        </form>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>

</html>