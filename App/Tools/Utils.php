<?php

namespace App\Tools;

class Utils
{
    /**
     * Méthode pour nettoyer les entrées utilisateurs
     * @param string $str chaine de caractères à nettoyer
     * @return string $cleanStr chaine de caractères néttoyée
     */
    public static function sanitize(string $str): string
    {
        $cleanStr = trim($str);
        $cleanStr = strip_tags($cleanStr);
        $cleanStr = htmlspecialchars($cleanStr, ENT_NOQUOTES);

        return $cleanStr;
    }

    /**
     * Méthode qui nettoie un tableau de chaine de caractères
     * @param array $data tableau de données à nettoyer
     * @return array $data tableau avec les données nettoyées
     */
    public static function sanitizeArray(array $data): array
    {
        foreach ($data as $key => $value) {

            if (gettype($value) == "string") {
                $data[$key] = self::sanitize($value);
            }

            if (gettype($value) == "array") {
                //nettoyage du sous tableau
                foreach ($value as $subKey => $subValue) {
                    $data[$key][$subKey] = self::sanitize($subValue);
                }
            }
        }

        return $data;
    }

    /**
     * Méthode pour récupérer l'extension d'un fichier
     * @param string $file nom du fichier
     * @return string extraction de l'extension du nom du fichier
     */
    public static function getFileExtension($file): string
    {
        return substr(strrchr($file, '.'), 1);
    }
}
