<?php
session_start();

if (!isset($_SESSION['is_login']) || $_SESSION['role'] !== 'ADMIN') {
    header('Location: ../../pages/login.php');
    exit();
}
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
        <!-- Sidebar -->
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
            <!-- Section utilisateur et déconnexion en bas -->
            <div class="p-4 border-t border-indigo-800">
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
                <h2 class="text-2xl font-bold mb-6">Statistiques Globales</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-gray-700">Total Cours</h3>
                        <p class="text-3xl font-bold text-blue-600">150</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-gray-700">Total Utilisateurs</h3>
                        <p class="text-3xl font-bold text-green-600">1200</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-gray-700">Total Enseignants</h3>
                        <p class="text-3xl font-bold text-purple-600">45</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-gray-700">Total Étudiants</h3>
                        <p class="text-3xl font-bold text-yellow-600">1155</p>
                    </div>
                </div>

                <!-- Top 3 Enseignants -->
                <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                    <h3 class="text-xl font-semibold mb-4">Top 3 Enseignants</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="border rounded-lg p-4">
                            <div class="text-lg font-bold">🥇 Jean Dupont</div>
                            <div class="text-gray-600">15 cours</div>
                            <div class="text-blue-600">450 étudiants</div>
                        </div>
                        <div class="border rounded-lg p-4">
                            <div class="text-lg font-bold">🥈 Marie Martin</div>
                            <div class="text-gray-600">12 cours</div>
                            <div class="text-blue-600">380 étudiants</div>
                        </div>
                        <div class="border rounded-lg p-4">
                            <div class="text-lg font-bold">🥉 Paul Bernard</div>
                            <div class="text-gray-600">10 cours</div>
                            <div class="text-blue-600">320 étudiants</div>
                        </div>
                    </div>
                </div>

                <!-- Cours le plus populaire -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Cours le Plus Populaire</h3>
                    <div class="border rounded-lg p-4">
                        <div class="text-lg font-bold">Introduction au JavaScript</div>
                        <div class="text-gray-600">Par Jean Dupont</div>
                        <div class="text-blue-600">250 étudiants inscrits</div>
                    </div>
                </div>
            </div>

            <!-- Section Validation Enseignants -->
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
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Pierre Martin</td>
                                <td class="px-6 py-4 whitespace-nowrap">pierre@example.com</td>
                                <td class="px-6 py-4 whitespace-nowrap">01/03/2024</td>
                                <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">
                                        ✅ Valider
                                    </button>
                                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                        ❌ Refuser
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Section Gestion Utilisateurs -->
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
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Marie Dubois</td>
                                <td class="px-6 py-4 whitespace-nowrap">Enseignant</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Actif
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                    <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded">
                                        🔒 Suspendre
                                    </button>
                                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                        🗑️ Supprimer
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Section Gestion Cours -->
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
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Introduction PHP</td>
                                <td class="px-6 py-4 whitespace-nowrap">Jean Dupont</td>
                                <td class="px-6 py-4 whitespace-nowrap">Développement Web</td>
                                <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
                                        ✏️ Modifier
                                    </button>
                                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                        🗑️ Supprimer
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Section Catégories & Tags -->
            <div id="gestion-categories" class="dashboard-section hidden">
                <h2 class="text-2xl font-bold mb-6">Gestion des Catégories & Tags</h2>
                
                <!-- Gestion des catégories -->
                <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                    <h3 class="text-xl font-semibold mb-4">Catégories</h3>
                    <div class="flex gap-4 mb-4">
                        <input type="text" placeholder="Nouvelle catégorie" class="flex-1 rounded-md border-gray-300">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Ajouter
                        </button>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                            <span>Développement Web</span>
                            <button class="text-red-600 hover:text-red-800">🗑️</button>
                        </div>
                        <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                            <span>Design</span>
                            <button class="text-red-600 hover:text-red-800">🗑️</button>
                        </div>
                    </div>
                </div>

                <!-- Gestion des tags -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Tags</h3>
                    <div class="mb-4">
                        <textarea placeholder="Entrez plusieurs tags séparés par des virgules" 
                                  class="w-full h-32 rounded-md border-gray-300 mb-2"></textarea>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                            Ajouter en masse
                        </button>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full flex items-center">
                            PHP
                            <button class="ml-2 text-blue-600 hover:text-blue-800">×</button>
                        </span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full flex items-center">
                            JavaScript
                            <button class="ml-2 text-blue-600 hover:text-blue-800">×</button>
                        </span>
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

            // Afficher la section statistiques par défaut
            document.getElementById('statistiques').classList.remove('hidden');
            document.querySelector('[data-target="statistiques"]').classList.add('bg-blue-600');
        });
    </script>
</body>
</html>