<?php


namespace App\Models;


use Illuminate\Support\Facades\File;

class Post
{

    public static function find($slug){

        $path = resource_path()."/posts/{$slug}.html";
        if(!file_exists($path)){
            //  dd('file doesnt exist');
            //  return redirect('/');
            abort('404');
        }else{
            return file_get_contents($path);
        }
    }

    public static function all()
    {
        $files = File::files(resource_path()."/posts/");
        return array_map(function ($file){
            return $file->getContents();
        }, $files);

    }

}
