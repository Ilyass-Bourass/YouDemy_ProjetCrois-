<?php
session_start();

require_once '../../config/dataBase.php';
require_once '../../classes/CourVideo.php';
require_once '../../classes/CourDocument.php';
require_once '../../classes/Etudiant.php';
require_once '../../classes/Admin.php';

if (!isset($_SESSION['is_login']) || $_SESSION['role'] !== 'ETUDIANT') {
    header('Location: ../../pages/login.php');
    exit();
}

//var_dump($_SESSION);
$db = new Database();
$connex = $db->getConnection();

$id_etudiant=$_SESSION['user_id'];

$admin = new Admin($connex);

$newCourdocument=new CourDocument($connex,1,"","","",1,50);
//$courDocument=$newCourdocument->afficherCour(2);


echo '</br>';
$newCourVideo=new CourVideo($connex,1,"","","",1,50);
//$courVideo=$newCourVideo->afficherCour(4);

//var_dump("contentvideo",$courVideo);

$id_etudaint=$_SESSION['user_id'];

$newEtudiant=new Etudiant($connex);
$coursEtudiant=$newEtudiant->getAllcourEtudiant($id_etudaint);
var_dump($coursEtudiant);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Étudiant - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        
        <div class="w-64 bg-emerald-800 text-white flex flex-col">
            <div class="p-4 flex-grow">
                <div class="text-2xl font-bold mb-4">Youdemy</div>
                <div class="text-xl mb-8">Dashboard Étudiant</div>
                <nav class="space-y-2">
                    <a href="#" class="nav-link block px-4 py-2 rounded-md hover:bg-emerald-600 cursor-pointer" data-target="mes-cours">
                        📖 Mes Cours
                    </a>
                </nav>
            </div>
            
            <div class="p-4 border-t border-emerald-700">
                <div class="flex items-center mb-4">
                    <span class="text-gray-300">👤 <?php echo htmlspecialchars($_SESSION['name']); ?></span>
                </div>
                <a href="../../index.php" class="block w-full px-4 py-2 text-center bg-blue-600 rounded-md hover:bg-red-700">
                    Page d'acceuil
                </a>
                <br>
                <a href="../../actions/logout.php" class="block w-full px-4 py-2 text-center bg-red-600 rounded-md hover:bg-red-700">
                    Déconnexion
                </a>
            </div>
        </div>

 
        <div class="flex-1 p-8">

            <div id="mes-cours" class="dashboard-section">
                <h2 class="text-2xl font-bold mb-6">Mes Cours</h2>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Titre du cours</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Enseignant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date d'inscription</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type-Document</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Content</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach($coursEtudiant as $courEtudiant):?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= $courEtudiant['titre']?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= $courEtudiant['nameEnseignant']?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= $courEtudiant['date_inscription']?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= $courEtudiant['cour_type']?></td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if($courEtudiant['cour_type']==="VIDEO"):?>
                                            <button onclick="window.location.href='../detailsVideo.php?id_cour=<?= $courEtudiant['id_cour']?>'" class="bg-emerald-500 text-white px-4 py-2 rounded hover:bg-emerald-600">
                                                Voir-Cour
                                            </button>
                                        <?php else:?>
                                            <button onclick="window.location.href='../detailsDocument.php?id_cour=<?= $courEtudiant['id_cour']?>'" class="bg-emerald-500 text-white px-4 py-2 rounded hover:bg-emerald-600">
                                                Voir-Cour
                                            </button>
                                        <?php endif;?>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>   
                </div>
                <?php if($admin->isBan($id_etudiant)):?>
                    <p class="text-red-500 font-bold">
                                Vous êtes banni. Vous n'avez pas la possibilité d'ajouter un cours. Veuillez contacter l'administrateur.
                    </p>
                <?php endif;?>
            </div>
        </div>
    </div>
   
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('mes-cours').classList.remove('hidden');
        });
    </script>
</body>
</html>