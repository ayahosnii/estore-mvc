<?php
namespace estore\app\lib;

class Language {

    private $dictionary = [];

    public function load($path)
    {
        $defaultLanguage = APP_DEFAULT_LANGUAGE;
        if (isset($_SESSION['lang'])) {
            $defaultLanguage = $_SESSION['lang'];
        };
        $pathArray = explode('.', $path);
        $languageFileToLoad = LANGUAGE_PATH . $defaultLanguage . DS . $pathArray[0] . DS . $pathArray[1] . '.lang.php';
        if (file_exists($languageFileToLoad)) {
            require $languageFileToLoad;
            if (is_array($_) && !empty($_)) {
                foreach ($_ as $key => $value) {
                    $this->dictionary[$key] = $value;
                }
                return $this->dictionary;
            }
        } else {
            trigger_error('Sorry the language file ' . $path . 'Doesn\'t Exist');
        }
        $languageFileContent = file_get_contents($languageFileToLoad);
        var_dump($languageFileContent);
    }

    public function getDictionary()
    {
        return $this->dictionary;
    }
}