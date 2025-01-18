<?php

require_once '../../config/dataBase.php';
require_once '../../classes/Categorie.php';
require_once '../../classes/Tag.php';
require_once '../../classes/Enseignant.php';

session_start();

if (!isset($_SESSION['is_login']) || $_SESSION['role'] !== 'ENSEIGNANT') {
    header('Location: ../../pages/login.php');
    exit();
}

$db = new Database();
$connex = $db->getConnection();

$newCategorie=new Categorie($connex);
$categories=$newCategorie->getALLCategorie();

// var_dump($categories);

echo "<br>-------";

$newTag=new Tag($connex);
$Tags=$newTag->getALLtags();

$newEnseignant=new Enseignant($connex);
$coursEnseignant=$newEnseignant->getMesCours($_SESSION['user_id']);

 var_dump($coursEnseignant);



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Enseignant - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white flex flex-col">
            <div class="p-4 flex-grow">
                <div class="text-2xl font-bold mb-4">Youdemy</div>
                <div class="text-xl mb-8">Dashboard Enseignant</div>
                <nav class="space-y-2">
                    <a href="#" class="nav-link block px-4 py-2 rounded-md hover:bg-blue-600 cursor-pointer" data-target="statistiques">
                        📊 Statistiques
                    </a>
                    <a href="#" class="nav-link block px-4 py-2 rounded-md hover:bg-blue-600 cursor-pointer" data-target="nouveau-cours">
                        ➕ Nouveau Cours
                    </a>
                    <a href="#" class="nav-link block px-4 py-2 rounded-md hover:bg-blue-600 cursor-pointer" data-target="mes-cours">
                        📚 Mes Cours
                    </a>
                    <a href="#" class="nav-link block px-4 py-2 rounded-md hover:bg-blue-600 cursor-pointer" data-target="inscriptions">
                        👥 Inscriptions
                    </a>
                </nav>
            </div>
            <!-- Section utilisateur et déconnexion en bas -->
            <div class="p-4 border-t border-gray-700">
                <div class="flex items-center mb-4">
                    <span class="text-gray-300">👤 <?php echo htmlspecialchars($_SESSION['name']); ?></span>
                </div>
                <a href="../../actions/logout.php" class="block w-full px-4 py-2 text-center bg-red-600 rounded-md hover:bg-red-700">
                    Déconnexion
                </a>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="flex-1 p-8">
            <!-- Section Statistiques -->
            <div id="statistiques" class="dashboard-section">
                <h2 class="text-2xl font-bold mb-6">Statistiques</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-gray-700">Total Cours</h3>
                        <p class="text-3xl font-bold text-blue-600">12</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-gray-700">Total Étudiants</h3>
                        <p class="text-3xl font-bold text-green-600">150</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-gray-700">Moyenne Étudiants/Cours</h3>
                        <p class="text-3xl font-bold text-purple-600">12.5</p>
                    </div>
                </div>
            </div>

            <!-- Section Nouveau Cours -->
            <div id="nouveau-cours" class="dashboard-section hidden">
                <h2 class="text-2xl font-bold mb-6">Ajouter un nouveau cours</h2>
                <form class="bg-white p-6 rounded-lg shadow-md" action="../../actions/ajouter_course.php" method="POST">
                    <!-- Titre -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Titre du cours</label>
                        <input type="text" name="titre" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    </div>

                    <!-- Prix -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Prix du cours (€)</label>
                        <input type="number" name="prix" step="0.01" min="0" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Image URL -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Image de présentation</label>
                        <input type="url" name="img_url" required 
                            placeholder="https://exemple.com/image.jpg"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Catégorie -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Catégorie</label>
                        <select name="id_categorie" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Sélectionnez une catégorie</option>
                            <?php foreach($categories as $categorie):?>
                                <option value="<?= $categorie['id_categorie']?>"><?= $categorie['name_categorie']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <!-- Tags -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                        <div class="flex space-x-4">
                            <?php foreach($Tags as $tag):?>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="tags[]" value="<?= $tag['id_tag']?>" class="form-checkbox">
                                    <span class="ml-2">#<?= $tag['tag_name']?></span>
                                </label>
                            <?php endforeach;?>
                        </div>
                    </div>

                    <!-- Type de contenu -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Type de contenu</label>
                        <select name="content_type" id="contentType" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Sélectionnez le type</option>
                            <option value="video">Vidéo</option>
                            <option value="document">Document</option>
                        </select>
                    </div>

                    <!-- Contenu Vidéo -->
                    <div id="videoContent" class="mb-4 hidden">
                        <label class="block text-sm font-medium text-gray-700">URL de la vidéo</label>
                        <input type="url" name="video_url" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Contenu Document -->
                    <div id="documentContent" class="mb-4 hidden">
                        <label class="block text-sm font-medium text-gray-700">Contenu du document</label>
                        <textarea name="document_content" rows="4" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Créer le cours
                    </button>
                </form>
            </div>

            <!-- Section Mes Cours -->
            <div id="mes-cours" class="dashboard-section hidden">
                <h2 class="text-2xl font-bold mb-6">Mes Cours</h2>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Titre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Catégorie</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Étudiants</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach($coursEnseignant as $courEnseignant):?>
                                <tr>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= $courEnseignant['titre']?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= $courEnseignant['name_categorie']?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">25</td>
                                        <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                            
                                            <button  onclick="window.location.href='../modifier_cours.php?id_cour=<?= $courEnseignant['id_cour']?>'" 
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
                                                ✏️ Modifier
                                            </button>
                                            <form method="POST" action="../../actions/deleteCour.php">
                                            <button name='deleteCour' value="<?= $courEnseignant['id_cour']?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                                    🗑️ Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    
                                </tr>
                            <?php endforeach;?>
                            <!-- Ajoutez d'autres cours ici -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Section Inscriptions -->
            <div id="inscriptions" class="dashboard-section hidden">
                <h2 class="text-2xl font-bold mb-6">Gestion des Inscriptions</h2>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Étudiant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cours</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date d'inscription</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Progrès</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Jean Dupont</td>
                                <td class="px-6 py-4 whitespace-nowrap">Introduction au PHP</td>
                                <td class="px-6 py-4 whitespace-nowrap">01/03/2024</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: 75%"></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Modifier Cours -->
    <div id="modal-modifier-cours" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-4/5 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Modifier le cours</h3>
                <button onclick="closeModal()" class="text-gray-600 hover:text-gray-800">&times;</button>
            </div>
            
            <form class="space-y-4" action="../../actions/modifier_course.php" method="POST">
                <input type="hidden" name="id_cour" id="edit_id_cour">
                
                <!-- Titre -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Titre du cours</label>
                    <input type="text" name="titre" id="edit_titre" required 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="edit_description" rows="4" required 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                </div>

                <!-- Prix -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Prix du cours (€)</label>
                    <input type="number" name="prix" id="edit_prix" step="0.01" min="0" required 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Image URL -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Image de présentation</label>
                    <input type="url" name="img_url" id="edit_img_url" required 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Catégorie -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Catégorie</label>
                    <select name="id_categorie" id="edit_categorie" required 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <?php foreach($categories as $categorie):?>
                            <option value="<?= $categorie['id_categorie']?>"><?= $categorie['name_categorie']?></option>
                        <?php endforeach;?>
                    </select>
                </div>

                <!-- Tags -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                    <div class="flex space-x-4">
                        <?php foreach($Tags as $tag):?>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="tags[]" value="<?= $tag['id_tag']?>" class="form-checkbox">
                                <span class="ml-2"><?= $tag['tag_name']?></span>
                            </label>
                        <?php endforeach;?>
                    </div>
                </div>

                <!-- Type de contenu -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Type de contenu</label>
                    <select name="content_type" id="edit_content_type" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Sélectionnez le type</option>
                        <option value="video">Vidéo</option>
                        <option value="document">Document</option>
                    </select>
                </div>

                <!-- Contenu Vidéo -->
                <div id="edit_videoContent" class="hidden">
                    <label class="block text-sm font-medium text-gray-700">URL de la vidéo</label>
                    <input type="url" name="video_url" id="edit_video_url"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Contenu Document -->
                <div id="edit_documentContent" class="hidden">
                    <label class="block text-sm font-medium text-gray-700">Contenu du document</label>
                    <textarea name="document_content" id="edit_document_content" rows="4" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" 
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Annuler
                    </button>
                    <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
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

        // Script pour gérer l'affichage des champs de contenu
        document.getElementById('contentType').addEventListener('change', function() {
            const videoContent = document.getElementById('videoContent');
            const documentContent = document.getElementById('documentContent');
            
            if (this.value === 'video') {
                videoContent.classList.remove('hidden');
                documentContent.classList.add('hidden');
            } else if (this.value === 'document') {
                documentContent.classList.remove('hidden');
                videoContent.classList.add('hidden');
            } else {
                videoContent.classList.add('hidden');
                documentContent.classList.add('hidden');
            }
        });

        function openModal(courId) {
            document.getElementById('modal-modifier-cours').classList.remove('hidden');
            document.getElementById('edit_id_cour').value = courId;
            
            // Ici vous pourrez ajouter le code pour pré-remplir le formulaire
            // avec les données du cours sélectionné
        }

        function closeModal() {
            document.getElementById('modal-modifier-cours').classList.add('hidden');
        }

        // Gestionnaire pour le type de contenu dans le formulaire de modification
        document.getElementById('edit_content_type').addEventListener('change', function() {
            const videoContent = document.getElementById('edit_videoContent');
            const documentContent = document.getElementById('edit_documentContent');
            
            if (this.value === 'video') {
                videoContent.classList.remove('hidden');
                documentContent.classList.add('hidden');
            } else if (this.value === 'document') {
                documentContent.classList.remove('hidden');
                videoContent.classList.add('hidden');
            } else {
                videoContent.classList.add('hidden');
                documentContent.classList.add('hidden');
            }
        });

        
        document.querySelectorAll('button[name="modifierCour"]').forEach(button => {
            button.onclick = function(e) {
                e.preventDefault();
                openModal(this.value);
            }
        });
    </script>
</body>
</html>