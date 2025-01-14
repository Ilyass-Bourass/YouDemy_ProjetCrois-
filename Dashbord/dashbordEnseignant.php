<?php
session_start();

if (!isset($_SESSION['is_login']) || $_SESSION['role'] !== 'ENSEIGNANT') {
    header('Location: ../../pages/login.php');
    exit();
}
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
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Titre du cours</label>
                            <input type="text" name="titre" required 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" rows="4" required 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Prix du cours (€)</label>
                            <input type="number" name="prix" step="0.01" min="0" required 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Image de présentation</label>
                            <input type="url" name="img_url" required 
                                placeholder="https://exemple.com/image.jpg"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Catégorie</label>
                            <select name="id_categorie" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Sélectionnez une catégorie</option>
                                <option value="1">Développement Web</option>
                                <option value="2">Développement Mobile</option>
                                <option value="3">Design</option>
                                <option value="4">Marketing Digital</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Créer le cours
                        </button>
                    </div>
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
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Introduction au PHP</td>
                                <td class="px-6 py-4 whitespace-nowrap">Développement Web</td>
                                <td class="px-6 py-4 whitespace-nowrap">25</td>
                                <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
                                        ✏️ Modifier
                                    </button>
                                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                        🗑️ Supprimer
                                    </button>
                                </td>
                            </tr>
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