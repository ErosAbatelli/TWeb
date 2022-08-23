<?php

namespace App\Models;

use App\Models\Resources\Faq;

class faqs {

    public function getFaq() {
       return Faq::all();
    }
   
    
}