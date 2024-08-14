<?php
namespace App\Traits;

trait ImageTraits{


    public function getImageUrl($file, $path){
        $file_path = null;

        if ($file && $file !== 'null') {
            $file_name = date('Ymd-his') . '.' . $file->getClientOriginalName();
            $destinationPath = public_path($path);
            $file->move($destinationPath, $file_name);
            $file_path = $path . $file_name;
        }

        return $file_path ?? null;
    }

}
?>
