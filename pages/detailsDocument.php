<?php
require_once '../config/dataBase.php';
require_once '../classes/CourDocument.php';

session_start();
if (!isset($_SESSION['is_login']) || $_SESSION['role'] !== 'ETUDIANT') {
    header('Location: ../../pages/login.php');
    exit();
}
if(isset($_GET['id_cour'])){
    $id_cour=$_GET['id_cour'];
    $db = new Database();
    $connex = $db->getConnection();
    
    $newCouVideo=new CourDocument($connex,2,"","","",2,50);
    $DetailsCour=$newCouVideo->afficherCour($id_cour);
    var_dump($DetailsCour);
    
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du cours document - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
       
        <div class="w-64 bg-emerald-800 text-white flex flex-col">
            <div class="p-4 flex-grow">
                <div class="text-2xl font-bold mb-4">Youdemy</div>
                <div class="text-xl mb-8">Détails du cours</div>
                <nav class="space-y-2">
                    <a href="Dashbord/dashbordEtudaint.php" class="block px-4 py-2 rounded-md hover:bg-emerald-600">
                        ← Retour aux cours
                    </a>
                </nav>
            </div>

            <div class="p-4 border-t border-emerald-700">
                <div class="mb-4">
                    <h3 class="font-bold text-lg">Informations</h3>
                    <p class="text-sm">Enseignant: <?= $DetailsCour['name']?></p>
                    <p class="text-sm">Catégorie: <?= $DetailsCour['name_categorie']?></p>
                </div>
                <a href="../../index.php" class="block w-full px-4 py-2 text-center bg-blue-600 rounded-md hover:bg-blue-700">
                    Page d'accueil
                </a>
            </div>
        </div>

        
        <div class="flex-1 p-8">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-3xl font-bold mb-6"><?= $DetailsCour['titre']?></h1>
                
                
                <div class="bg-white p-8 rounded-lg shadow-md mb-8">
                    <div class="prose max-w-none">
                        <h2 class="text-2xl font-bold mb-4">Contenu du cours</h2>
                        <div class="text-green-500 leading-relaxed italic">
                            <?= $DetailsCour['content_document'] ?>
                        </div>
                    </div>
                </div>

                
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-4">Description du cours</h2>
                    <p class="text-gray-600">
                        <?= $DetailsCour['description']?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>