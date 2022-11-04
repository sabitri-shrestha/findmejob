<?php
namespace App\Models;

class Listing{
    public static function all(){
        return [
            ['id'=>'1',
            'title'=>"listing 1",
            'description'=>'lorem epsum jksdks khasdksdkhsdk'
            ],
            ['id'=>'2',
            'title'=>"listing 2",
            'description'=>'lorem epsum jksdks khasdksdkhsdk'
            ],
            ['id'=>'3',
                'title'=>"listing 3i",
                'description'=>'lorem epsum jksdks khasdksdkhsdk'
            ]


        ];
    }

}
