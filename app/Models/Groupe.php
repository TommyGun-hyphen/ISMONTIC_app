<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Module;
use App\Models\Affectation;
class Groupe extends Model
{
    use HasFactory;
    protected $fillable = ['nom_groupe', 'nom_filiere', 'annee'];
    public function users(){
        return $this->hasMany(User::class);
    }
    public function affectations(){
        return $this->hasMany(Affectation::class);
    }
    public function modules(){
        return $this->hasManyThrough(Affectation::class, Module::class);
    }
}
