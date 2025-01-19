<?php
    session_start();
    $errors = [];
    if(isset($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="../index.php" class="text-2xl font-bold text-blue-600">Youdemy</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="login.php" class="text-gray-600 hover:text-blue-600">Connexion</a>
                    <a href="register.php" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Inscription</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-md">
            
            <?php if(!empty($errors)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <?php foreach($errors as $error): ?>
                        <p class="mb-2"><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Créer un compte
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Ou
                    <a href="login.php" class="font-medium text-blue-600 hover:text-blue-500">
                        connectez-vous à votre compte existant
                    </a>
                </p>
            </div>
            <form class="mt-8 space-y-6" action="../actions/register_action.php" method="POST">
                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                        <input id="name" name="name" type="text" required 
                            class="appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Adresse email</label>
                        <input id="email" name="email" type="email" required 
                            class="appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                        <input id="password" name="password" type="password" required 
                            class="appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm">
                    </div>
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Rôle</label>
                        <select id="role" name="role" required 
                            class="appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm">
                            <option value="">Sélectionnez un rôle</option>
                            <option value="ETUDIANT">Étudiant</option>
                            <option value="ENSEIGNANT">Enseignant</option>
                        </select>
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        S'inscrire
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 