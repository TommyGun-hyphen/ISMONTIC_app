<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Module;
use App\Models\Groupe;
use App\Models\Formateur;
use App\Models\User;
use App\Models\Affectation;

class ModuleController extends Controller
{
    public function getModules(Request $request){
        $user = Auth::user();
        $groupe = $user->groupe()->first();
        $affectations = $groupe->affectations()->get();
        $modules = [];
        foreach($affectations as $affectation ){
            $modules[] = [
                "formateur" => $affectation->formateur()->first(),
                "module" => $affectation->module()->first(),
                "mhr" => $affectation->mhr
            ];
        }
        return response()->json($modules);
    }
}
