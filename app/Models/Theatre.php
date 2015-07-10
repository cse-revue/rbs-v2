<?php namespace rbs\Models;

use Illuminate\Database\Eloquent\Model;

class Theatre extends Model {
    public static function get_all_theatres() {
        $dir_handle = @opendir(base_path() . "/resources/assets/theatres") or die("Unable to open theatre directory");

        $theatres = array();

        while ($file = readdir($dir_handle)) {
            if ($file[0] == ".")
                continue;
            if (substr($file, -4) !== ".inc")
                continue;
            $theatres[] = substr($file, 0, -4);
        }

        closedir($dir_handle);
        return $theatres;
    }
}
