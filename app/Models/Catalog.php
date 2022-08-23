<?php

namespace App\Models;

use App\Models\Resources\Event;

class Catalog {

    public function getEvents(){
       return Event::all();
    }

    
}