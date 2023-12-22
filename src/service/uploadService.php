<?php

namespace App\Service;

//permet d'uploader une image
class UploadService{

    public function upload(array $file, ?string $deleteOldFile = null): string|bool{

        //recuperer l'extension du fichier
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        //verifier si l'extension est autorisée et si le poids ne depasse pas un maximum
        if($file['size'] <= (2 * 1024* 1024) && 
            in_array($extension, ['png','jpg','jpeg' ,'webp' ])){
                //generer un nouveau nom pour l'image
                $newName = md5(uniqid('', true)) . '.' . $extension;

            // Si un ancien nom de fichier est fourni, on le supprime
            if ($deleteOldFile !== null) {
                unlink($_ENV['FOLDER_PROJECT'] . $deleteOldFile);
            }

                //upload le fichier
                move_uploaded_file(
                    $file ['tmp_name'],
                    $_ENV['FOLDER_PROJECT'] . $newName
                );
                //retourne le nouveau nom du fichier
                return $newName;
        }
        return false;

    }
}