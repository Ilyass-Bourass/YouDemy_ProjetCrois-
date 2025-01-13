

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Plateforme de cours en ligne</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="index.php" class="text-2xl font-bold text-blue-600">Youdemy</a>
                </div>
                
                <!-- Ajout du nom de l'étudiant au milieu -->
                <?php if(isset($_SESSION['is_login']) && $_SESSION['role']=="ETUDIANT"): ?>
                <div class="flex items-center bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-2 rounded-full border border-blue-200 shadow-sm">
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-blue-700 font-medium">
                            Notre étudiant : <span class="font-semibold text-indigo-700"><?php echo htmlspecialchars($_SESSION['name']); ?></span>
                        </span>
                    </div>
                </div>
                <?php endif; ?>

                <div class="flex items-center space-x-4">
                    <?php if(isset($_SESSION['is_login']) && $_SESSION['role']=="ETUDIANT"):?>
                        <a href="pages/Dashbord/dashbordEtudaint.php" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 whitespace-nowrap">
                            Mon Espace
                        </a>
                        <a href="actions/logout.php" class="block px-4 py-2 text-center text-white bg-red-600 rounded-md hover:bg-red-700">
                            Déconnexion
                        </a>
                    <?php else :?>
                        <a href="pages/login.php" class="text-gray-600 hover:text-blue-600">Connexion</a>
                        <a href="pages/register.php" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Inscription</a>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">Apprenez en ligne avec Youdemy</h1>
                    <p class="text-xl mb-8">Découvrez des milliers de cours enseignés par des experts.</p>
                    <div class="flex space-x-4">
                        <a href="#Cours" class="bg-white text-blue-600 px-6 py-3 rounded-md hover:bg-gray-100">Voir les cours</a>
                        <a href="/register.php" class="border-2 border-white text-white px-6 py-3 rounded-md hover:bg-white hover:text-blue-600">Commencer</a>
                    </div>
                </div>
                <div class="hidden md:block">
                    <img src="https://placehold.co/600x400" alt="Education en ligne" class="w-full">
                </div>
            </div>
        </div>
    </div>

    <!-- Barre de recherche -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-center">
            <div class="w-full max-w-2xl">
                <form class="flex gap-2">
                    <input type="text" placeholder="Rechercher un cours..." class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
                        Rechercher
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Filtres de recherche avancée -->
    <div class="max-w-7xl mx-auto px-4 mb-8">
        <div class="bg-white p-4 rounded-md shadow">
            <h3 class="text-lg font-semibold mb-4">Recherche avancée</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <select class="border rounded-md p-2">
                    <option value="">Catégorie</option>
                    <!-- Options à remplir dynamiquement -->
                </select>
                <select class="border rounded-md p-2">
                    <option value="">Tags</option>
                    <!-- Options à remplir dynamiquement -->
                </select>
                <select class="border rounded-md p-2">
                    <option value="">Auteur</option>
                    <!-- Options à remplir dynamiquement -->
                </select>
            </div>
        </div>
    </div>

    <!-- Section des cours populaires -->
    <div id="Cours" class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Cours populaires</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Carte de cours 1 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="https://placehold.co/600x400/blue/white" alt="Cours de programmation" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-center  mb-2">
                        <div class="flex items-center">
                            <img src="https://placehold.co/32x32" alt="Avatar" class="w-8 h-8 rounded-full mr-2">
                            <span class="text-gray-700">Par Jean Dupont</span>
                        </div>
                        
                        <span class="text-blue-600 text-sm font-semibold">Programmation</span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-2">Introduction au développement web</h3>
                    <p class="text-gray-600 mt-2">Apprenez les bases du développement web avec HTML, CSS et JavaScript.</p>
                    <div class="flex flex-wrap gap-2 mt-3">
                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-sm">#html</span>
                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-sm">#css</span>
                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-sm">#javascript</span>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-gray-800 font-bold">49.99 €</span>
                        <span class="text-sm text-gray-600">⭐ 4.8 (128 avis)</span>
                    </div>
                    <a href="#" class="mt-4 block text-center bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                        Voir le cours
                    </a>
                </div>
            </div>

            <!-- Carte de cours 2 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="https://placehold.co/600x400/purple/white" alt="Cours de design" class="w-full h-48 object-cover">
                <div class="p-6">
                <div class="flex justify-between items-center  mb-2">
                        <div class="flex items-center">
                            <img src="https://placehold.co/32x32" alt="Avatar" class="w-8 h-8 rounded-full mr-2">
                            <span class="text-gray-700">Victor sanchez</span>
                        </div>
                        
                        <span class="text-blue-600 text-sm font-semibold">Design</span>
                </div>
                    <h3 class="text-xl font-bold text-gray-800 mt-2">UI/UX Design Moderne</h3>
                    <p class="text-gray-600 mt-2">Maîtrisez les principes du design d'interface et de l'expérience utilisateur.</p>
                    <div class="flex flex-wrap gap-2 mt-3">
                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-sm">#design</span>
                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-sm">#ui</span>
                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-sm">#ux</span>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-gray-800 font-bold">59.99 €</span>
                        <span class="text-sm text-gray-600">⭐ 4.9 (95 avis)</span>
                    </div>
                    <a href="#" class="mt-4 block text-center bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                        Voir le cours
                    </a>
                </div>
            </div>

            <!-- Carte de cours 3 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="https://placehold.co/600x400/green/white" alt="Cours de marketing" class="w-full h-48 object-cover">
                <div class="p-6">
                <div class="flex justify-between items-center  mb-2">
                        <div class="flex items-center">
                            <img src="https://placehold.co/32x32" alt="Avatar" class="w-8 h-8 rounded-full mr-2">
                            <span class="text-gray-700">Par Sophie Bernard</span>
                        </div>
                        
                        <span class="text-blue-600 text-sm font-semibold">Marketing</span>
                </div>
                    <h3 class="text-xl font-bold text-gray-800 mt-2">Marketing Digital</h3>
                    <p class="text-gray-600 mt-2">Développez votre présence en ligne et maîtrisez les stratégies digitales.</p>
                    <div class="flex flex-wrap gap-2 mt-3">
                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-sm">#marketing</span>
                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-sm">#digital</span>
                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-sm">#seo</span>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-gray-800 font-bold">39.99 €</span>
                        <span class="text-sm text-gray-600">⭐ 4.7 (156 avis)</span>
                    </div>
                    <a href="#" class="mt-4 block text-center bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                        Voir le cours
                    </a>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center items-center space-x-2 mt-12">
            <a href="#" class="px-4 py-2 border rounded-md hover:bg-gray-50">Précédent</a>
            <a href="#" class="px-4 py-2 border rounded-md hover:bg-gray-50 bg-blue-600 text-white">1</a>
            <a href="#" class="px-4 py-2 border rounded-md hover:bg-gray-50">2</a>
            <a href="#" class="px-4 py-2 border rounded-md hover:bg-gray-50">3</a>
            <a href="#" class="px-4 py-2 border rounded-md hover:bg-gray-50">4</a>
            <a href="#" class="px-4 py-2 border rounded-md hover:bg-gray-50">5</a>
            <a href="#" class="px-4 py-2 border rounded-md hover:bg-gray-50">Suivant</a>
        </div>
    </div>
</body>
</html>
