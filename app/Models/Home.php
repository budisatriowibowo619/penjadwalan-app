<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home
{
    private static $test_variable = [
        [
            "title"     =>  "Title 2",
            "author"    =>  "Budi Satrio Wibowo",
            "body"      =>  "Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat ab iste corporis accusantium vitae nemo quos doloribus sapiente debitis eligendi commodi suscipit harum aut, quae alias? Expedita quo laudantium repudiandae!"
        ],
        [
            "title"     =>  "Title 2",
            "author"    =>  "Satrio Wibowo Budi ",
            "body"      =>  "Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat ab iste corporis accusantium vitae nemo quos doloribus sapiente debitis eligendi commodi suscipit harum aut, quae alias? Expedita quo laudantium repudiandae!"
        ]
    ];

    public static function all()
    {
       return self::$test_variable; 
    }
}
