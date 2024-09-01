<?php

namespace App\Traits;

trait ImagesTrait
{
    public function moveImage($file)
    {
        $name = time().'_'.$this->section.'.png';
        $file->move(public_path('assets/images/'.$this->section),$name);
        return $name;
    }

    public function updateImage($file,string $oldname)
    {
        $this->deleteImage($oldname);
        return $this->moveImage($file);
    }

    public function deleteImage(string $name)
    {
        $path = public_path($name);
        if (file_exists($path)):
            return unlink($path);
        endif;
        return false;
    }


}
