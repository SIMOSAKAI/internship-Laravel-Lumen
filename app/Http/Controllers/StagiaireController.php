<?php 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StagiaireController {
    public function lister(){
        //return view('stagiaires/lister');
        //$stagiaires = DB::table('stagiaires')->get();
        /*$stagiaires = DB::table('stagiaires')
            ->join('niveaux', 'stagiaires.idniveau', '=', 'niveaux.id')
            ->select('stagiaires.*', 'niveaux.niveau')
            ->get();*/
        $stagiaires = DB::table('stagiaires')
            ->join('niveaux', 'stagiaires.idniveau', '=', 'niveaux.id')
            ->join('demandes', 'stagiaires.id', '=', 'demandes.idStagiaire')
            ->where('demandes.idStatut', '=', 1)
            ->select('stagiaires.*', 'niveaux.niveau')
            ->get();
        return view('stagiaires.lister', ['stagiaires' => $stagiaires]);
    }

    public function showDetails(string $stagiaireId) 
    {
        try {
            $stagiaire = DB::table('stagiaires')
            ->join('demandes','stagiaires.id','=','demandes.idStagiaire')
            ->join('niveaux','stagiaires.idniveau','=','niveaux.id')
            ->join('entite','entite.id','=','demandes.idEntite')
            ->where('stagiaires.id', '=', $stagiaireId)
            ->select('stagiaires.*', 'demandes.*', 'niveaux.niveau', 'entite.nom as entiteName')
            ->first();
            

            

            return view('stagiaires.details', [
                'stagiaire' => $stagiaire
            ]);
        } catch(\Throwable $e) {
            dd($e);
        }
        

       
    }
    
}