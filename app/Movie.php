<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

		public $timestamps = false;

		// Seeding nije radio sa ovim !!!
    // public function getGenresAttribute($value)
    // {
    // 	return json_decode($value);
    // }

    // public function setGenresAttribute($value)
    // {
    // 	return json_encode($value);
    // }

    // Moze i ovako, ovo je skracena verzija za accessore i mutatore (i sa ovim radi seeding): (https://laravel.com/docs/5.4/eloquent-mutators#array-and-json-casting)
			
		protected $casts = [
      'genres' => 'array'
    ];
    
}
