<?php

class EnvLoader {
    static function load() {
        $file = IS_LOCAL
            ? 'dev'
            : 'prod';

        $filePath = APP_ROOT . '/' . $file . '.env';
        if (!file_exists($filePath)) {
            throw new Exception("{$file}.env could not be found");
        }
        
        $data = parse_ini_file($filePath, true, INI_SCANNER_TYPED);
        foreach ($data as $key => $val) {
            $_ENV[$key] = $val;
        }
    }
}