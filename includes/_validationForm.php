<?php 


        if (empty($title)) {
            $errors['title'] = "Un titre est requis";
        } elseif ((strlen($title) < 5) || ((strlen($title) > 50))) {
            $errors['title'] = "Le titre est trop court ou trop long";
        }
        if (empty($image_url)) {
            $errors['url'] = "L'URL de l'image est requise";
            // validation de l'url
        } elseif (! filter_var($image_url, FILTER_VALIDATE_URL)) {
            $errors['url'] = "L'URL fournie n'est pas valide";
        }
        if (empty($price)) {
            $errors['price'] = "Le prix est requis";
        } elseif ((int) $price <= 0) {
            $errors['price'] = "Le prix doit être un entier positif";
        }
        if (empty($location)) {
            $errors['location'] = "Une ville est requis";
        } elseif ((strlen($location) < 2) || ((strlen($location) > 50))) {
            $errors['location'] = "l'entrée n'est pas valide";
        }

        if (empty($description)) {
            $errors['description'] = "Une description est requis";
        } elseif (strlen($description) < 5) {
            $errors['description'] = "la description n'est pas conforme";
        }
        if (empty($property_type)) {
            $errors['property_type'] = "selectionner un type";
        }
        if (empty($transaction_type)) {
            $errors['transaction_type'] = "selectionner un type";
        }
    
?>