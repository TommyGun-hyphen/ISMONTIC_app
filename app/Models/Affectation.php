<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Formateur;
use App\Models\Module;
use App\Models\Groupe;

class Affectation extends Model
{
    use HasFactory;
    public function formateur(){
        return $this->belongsTo(Formateur::class);
    }
    public function module(){
        return $this->belongsTo(Module::class);
    }
    public function groupe(){
        return $this->belongsTo(Groupe::class);
    }
}
