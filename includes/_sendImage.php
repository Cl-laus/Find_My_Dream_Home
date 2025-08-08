  <?php
  
  $dest = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $fileTmp = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];
        $fileName = $_FILES['image']['name'];

        $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png'];
        $maxFileSize = 5 * 1024 * 1024;

        if (!in_array($fileType, $allowedTypes)) {
            $errors['image'] = "Type de fichier interdit";
        }
        if ($fileSize > $maxFileSize) {
            $errors['image'] = "Taille de fichier trop volumineuse";
        }

        if (empty($errors['image'])) {
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $newFileName = uniqid('file_', true) . '.' . $fileExtension;
            $dest = 'upload/' . $newFileName;

            if (!is_dir('upload/')) {
                mkdir('upload/', 0755, true);
            }

            if (!move_uploaded_file($fileTmp, $dest)) {
                $errors['image'] = "Erreur lors du déplacement du fichier";
            }
        }
    } else {
        $errors['image'] = "Veuillez uploader une image";
    }