<?php

require_once '../config/dataBase.php';
require_once '../classes/Cour.php';
require_once '../classes/Categorie.php';
require_once '../classes/Tag.php';
require_once '../classes/courTags.php';

if(isset($_GET['id_cour'])){

    $id_cour=$_GET['id_cour'];
    session_start();
    var_dump($_SESSION);

    $db = new Database();
    $connex = $db->getConnection();

    $newCour=new Cour($connex,2,"","","",2,50);
    $coursModifier=$newCour->getdetailsCour($id_cour);

    $newCategorie=new Categorie($connex);
    $categories=$newCategorie->getALLCategorie();

    $newTag=new Tag($connex);
    $Tags=$newTag->getALLtags();

    $newCourTag=new CourTag($connex);
    $tagsancienneCour=$newCourTag->getALLtagsCour($id_cour);
    //var_dump($tagsancienneCour);
}


//var_dump($Tags);
var_dump($coursModifier);


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le cours - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
   
    <nav class="bg-white shadow-lg mb-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                <a href="<?php echo ($_SESSION['role'] === 'ADMIN') ? 'Dashbord/dashboardAdmin.php' : 'Dashbord/dashbordEnseignant.php'; ?>" class="flex items-center text-gray-600 hover:text-gray-900">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Retour au tableau de bord
                    </a>
                </div>
                <div class="text-xl font-bold text-blue-600">Youdemy</div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <?php if(isset($_SESSION['errorModifierCour'])):?>
                <p class="bg-red-100 text-red-700 text-center font-bold border border-red-500 p-4 rounded shadow-md">
                    <?php echo $_SESSION['errorModifierCour']; ?>
                </p>
                <?php unset($_SESSION['errorModifierCour']); ?>
            <?php endif;?> 
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Modifier le cours</h1>

            <form action="../actions/modifierCourAction.php" method="POST" class="space-y-6">
                <input type="hidden" name='id_cour' value='<?php echo $id_cour ?>'>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Titre du cours</label>
                    <input type="text" name="titre" value='<?= $coursModifier['titre']?>' required 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

            
                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description"  rows="4"  required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"><?= $coursModifier['description']?></textarea>
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-700">Prix du cours (€)</label>
                    <input type="number" name="prix" value='<?= $coursModifier['prix']?>'  step="0.01" min="0"  required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-700">Image de présentation</label>
                    <input type="url" name="img_url" value='<?= $coursModifier['img_url']?>'  required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-700">Catégorie</label>
                    <select name="id_categorie"  required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <?php foreach($categories as $categorie):?>
                            <option <?= ($categorie['name_categorie']==$coursModifier['name_categorie'])? 'selected':'' ?> value="<?= $categorie['id_categorie']?>"><?= $categorie['name_categorie']?></option>
                        <?php endforeach;?>
                    </select>
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                    <div class="grid grid-cols-3 gap-4">
                    <?php foreach($Tags as $tag): ?>
                        <label class="inline-flex items-center">
                            <input 
                                type="checkbox" 
                                name="tags[]" 
                                value="<?= $tag['id_tag'] ?>" 
                                <?= (isset($tagsancienneCour) && in_array($tag['id_tag'], array_column($tagsancienneCour, 'id_tag'))) ? 'checked' : '' ?>
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <span class="ml-2"> <?= $tag['tag_name'] ?></span>
                        </label>
                    <?php endforeach; ?>

                    </div>
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-700">Type de contenu</label>
                    <select name="content_type" id="contentType" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" >
                        <option value="">Sélectionnez le type</option>
                        <option value="VIDEO">Vidéo</option>
                        <option value="DOCUMENT">Document</option>
                    </select>
                </div>


                <div id="videoFields" class="hidden space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">URL de la vidéo</label>
                        <input  type="url" name="video_url" 
                            <?= ($coursModifier['cour_type']=='VIDEO')? $coursModifier['content_video_url']:''?>
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Entrez l'URL de la vidéo">
                    </div>
                </div>


                <div id="documentFields" class="hidden space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Contenu du document</label>
                        <textarea name="document_content" rows="6"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Entrez le contenu du document"><?= ($coursModifier['cour_type']=='DOCUMENT')? $coursModifier['content_document']:''?>
                        </textarea>
                    </div>
                </div>


                <div class="flex justify-end space-x-3">
                    <a href="#" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Annuler
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.getElementById('contentType').addEventListener('change', function() {
        const videoFields = document.getElementById('videoFields');
        const documentFields = document.getElementById('documentFields');
        

        videoFields.classList.add('hidden');
        documentFields.classList.add('hidden');
        

        if (this.value === 'VIDEO') {
            videoFields.classList.remove('hidden');
        } else if (this.value === 'DOCUMENT') {
            documentFields.classList.remove('hidden');
        }
    });
    </script>
</body>
</html>