<?php

require_once '../../config/dataBase.php';
require_once '../../classes/Admin.php';
require_once '../../classes/Enseignant.php';
require_once '../../classes/Categorie.php';
require_once '../../classes/Tag.php';

session_start();

if (!isset($_SESSION['is_login']) || $_SESSION['role'] !== 'ADMIN') {
    header('Location: ../../pages/login.php');
    exit();
}

    $db = new Database();
    $connex = $db->getConnection();

    $admin = new Admin($connex);
    $Enseignant=new Enseignant($connex);

    $users=$admin->getAllUsers();

    $newEnseignants=$admin->listNewTeachers();

    $newCategorie=new Categorie($connex);

    $categories=$newCategorie->getALLCategorie();

    $newTag=new Tag($connex);
    $Tags=$newTag->getALLtags();

    $ALLcours=$admin->getAllCoursAdmin();
    //var_dump($ALLcours);

    if($admin->isBan(5)){
       // echo "enseignnat is ban";
    }else{
        //echo "is not ban";
    }

    $TotalEtudiant=$admin->getTotalEtudiant()['total_Etudiant'];
    $totalEnseigant=$admin->getTotalEnseignant()['total_Enseignant'];
    $totalUtilsateur=$totalEnseigant+$TotalEtudiant;
    $totalCours=$admin->getTotalCours()['total_Cours'];

    $CourPlusPopulaire=$admin->getCourPopulaire();

    $topTroisEnseignnat=$admin->getTopTroisEnseignant();

    
     //var_dump($topTroisEnseignnat[0]['id_enseignant']);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">

        <div class="w-64 bg-indigo-900 text-white flex flex-col">
            <div class="p-4 flex-grow">
                <div class="text-2xl font-bold mb-4 text-indigo-300">Youdemy</div>
                <div class="text-xl mb-8 text-indigo-100">Dashboard Admin</div>
                <nav class="space-y-2">
                    <a href="#" class="nav-link block px-4 py-2 rounded-md hover:bg-blue-600 cursor-pointer" data-target="statistiques">
                        📊 Statistiques Globales
                    </a>
                    <a href="#" class="nav-link block px-4 py-2 rounded-md hover:bg-blue-600 cursor-pointer" data-target="validation-enseignants">
                        ✅ Validation Enseignants
                    </a>
                    <a href="#" class="nav-link block px-4 py-2 rounded-md hover:bg-blue-600 cursor-pointer" data-target="gestion-utilisateurs">
                        👥 Gestion Utilisateurs
                    </a>
                    <a href="#" class="nav-link block px-4 py-2 rounded-md hover:bg-blue-600 cursor-pointer" data-target="gestion-cours">
                        📚 Gestion Cours
                    </a>
                    <a href="#" class="nav-link block px-4 py-2 rounded-md hover:bg-blue-600 cursor-pointer" data-target="gestion-categories">
                        🏷️ Catégories & Tags
                    </a>
                </nav>
            </div>

            <div class="p-4 border-t border-indigo-800">
                <div class="flex items-center mb-4">
                    <span class="text-gray-300">👤 <?php echo htmlspecialchars($_SESSION['name']); ?></span>
                </div>
                <a href="../../actions/logout.php" class="block w-full px-4 py-2 text-center bg-red-600 rounded-md hover:bg-red-700">
                    Déconnexion
                </a>
            </div>
        </div>


        <div class="flex-1 p-8">

            <div id="statistiques" class="dashboard-section">
                <h2 class="text-2xl font-bold mb-6">Statistiques Globales</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-gray-700">Total Cours</h3>
                        <p class="text-3xl font-bold text-blue-600"><?= $totalCours?></p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-gray-700">Total Utilisateurs</h3>
                        <p class="text-3xl font-bold text-green-600"><?= $totalUtilsateur?></p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-gray-700">Total Enseignants</h3>
                        <p class="text-3xl font-bold text-purple-600"><?= $totalEnseigant?></p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-gray-700">Total Étudiants</h3>
                        <p class="text-3xl font-bold text-yellow-600"><?= $TotalEtudiant?></p>
                    </div>
                </div>


                <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                    <h3 class="text-xl font-semibold mb-4">Top 3 Enseignants</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="border rounded-lg p-4">
                            <div class="text-lg font-bold">🥇 <?= $topTroisEnseignnat[0]['name']?></div>
                            <!-- <div class="text-gray-600">5 cours</div> -->
                            <div class="text-blue-600"><?=$topTroisEnseignnat[0]['nombreEtudiant'] ?> étudiants</div>
                        </div>
                        <div class="border rounded-lg p-4">
                            <div class="text-lg font-bold">🥈 <?= $topTroisEnseignnat[1]['name']?></div>
                            <!-- <div class="text-gray-600">3 cours</div> -->
                            <div class="text-blue-600"><?=$topTroisEnseignnat[1]['nombreEtudiant'] ?>  étudiants</div>
                        </div>
                        <div class="border rounded-lg p-4">
                            <div class="text-lg font-bold">🥉 <?= $topTroisEnseignnat[2]['name']?></div>
                            <!-- <div class="text-gray-600">2 cours</div> -->
                            <div class="text-blue-600"><?=$topTroisEnseignnat[2]['nombreEtudiant'] ?> étudiants</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Cour le Plus Populaire</h3>
                    <div class="border rounded-lg p-4">
                        <div class="text-lg font-bold"><?= $CourPlusPopulaire['titre_cours']?></div>
                        <div class="text-gray-600">Par : <?= $CourPlusPopulaire['enseignant']?></div>
                        <div class="text-blue-600"><?= $CourPlusPopulaire['nombreInscription']?> étudiants inscrits</div>
                    </div>
                </div>
            </div>


            <div id="validation-enseignants" class="dashboard-section hidden">
                <h2 class="text-2xl font-bold mb-6">Validation des Enseignants</h2>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date d'inscription</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach($newEnseignants as $newEnseignant):?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= $newEnseignant['name']?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= $newEnseignant['email']?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= $newEnseignant['date_inscription']?></td>
                                    <form method="POST" action="../../actions/gestionUsers.php">
                                        <input type="hidden" name="id_user" value="<?php echo $newEnseignant['id_user'] ?>">
                                        <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                            <button name='Valider' class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">
                                                ✅ Valider
                                            </button>
                                            <button name='Refuser' class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                                ❌ Refuser
                                            </button>
                                        </td>
                                    </form>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>


            <div id="gestion-utilisateurs" class="dashboard-section hidden">
                <h2 class="text-2xl font-bold mb-6">Gestion des Utilisateurs</h2>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rôle</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach($users as $user):?>
                                <?php if($user['role']!=="ADMIN"):?>
                                
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap"><?= $user['name']?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?= $user['role']?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    <?= $user['status']?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                <form method="POST" action="../../actions/gestionUsers.php">
                                    <input type="hidden" name="id_user" value="<?php echo $user['id_user'] ?>">
                                    <?php if($user['status']!=="suspendu"):?>
                                    <button name="Suspendre" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded">
                                        🔒 Suspendre
                                    </button>
                                    <?php else :?>
                                        <button name="Activer" class="bg-green-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded">
                                         🔓Activer
                                        </button>
                                    <?php endif?>
                                    <button name="Supprimer" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                        🗑️ Supprimer
                                    </button>
                                </form>
                                </td>
                            </tr>
                            <?php endif?>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>


            <div id="gestion-cours" class="dashboard-section hidden">
                <h2 class="text-2xl font-bold mb-6">Gestion des Cours</h2>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Titre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Enseignant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Catégorie</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach($ALLcours as $cour):?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= $cour['titre']?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= $cour['name']?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= $cour['name_categorie']?></td>
                                    <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                        <button onclick="window.location.href='../modifier_cours.php?id_cour=<?= $cour['id_cour']?>'" 
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
                                            ✏️ Modifier
                                        </button>
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                            🗑️ Supprimer
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>


            <div id="gestion-categories" class="dashboard-section hidden">
                <h2 class="text-2xl font-bold mb-6">Gestion des Catégories & Tags</h2>
                
  
                <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                    <h3 class="text-xl font-semibold mb-4">Catégories</h3>
                    <div class="flex gap-4 mb-4">
                        <form Method='POST' action="../../actions/AjouterCategorie.php">
                            <input name="categorie_name" type="text" placeholder="Nouvelle catégorie" class="flex-1 rounded-md border-gray-300">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Ajouter
                            </button>
                        </form>
                    </div>
                    <div class="space-y-2">
                        <form method='POST' action="../../actions/deleteCategorie.php">
                            <?php foreach($categories as $categorie):?>
                                <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                                    <span><?= $categorie['name_categorie']?></span>
                                    <button name='id_categorie' value='<?= $categorie['id_categorie']?>' class="text-red-600 hover:text-red-800">🗑️</button>
                                </div>
                            <?php endforeach;?>
                        </form>
                    </div>
                </div>


                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Tags</h3>
                    <div class="mb-4">
                        <form method='POST' action="../../actions/AjouterTags.php">
                            <textarea name='tags_name' placeholder="Entrez plusieurs tags séparés par des virgules" 
                                    class="w-full h-32 rounded-md border-gray-300 mb-2"></textarea>
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                                Ajouter en masse
                            </button>
                        </form>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <?php foreach($Tags as $tag):?>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full flex items-center">
                                <?= $tag['tag_name']?>
                                <form method="POST" action="../../actions/deleteTag.php">
                                    <button name='id_tag' value='<?= $tag['id_tag']?>' class="ml-2 text-blue-600 hover:text-blue-800">×</button>
                                </form>
                            </span>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('data-target');
                    
                    document.querySelectorAll('.dashboard-section').forEach(section => {
                        section.classList.add('hidden');
                    });
                    
                    document.getElementById(targetId).classList.remove('hidden');
                    
                    navLinks.forEach(link => link.classList.remove('bg-blue-600'));
                    this.classList.add('bg-blue-600');
                });
            });

            document.getElementById('statistiques').classList.remove('hidden');
            document.querySelector('[data-target="statistiques"]').classList.add('bg-blue-600');
        });
    </script>
</body>
</html>