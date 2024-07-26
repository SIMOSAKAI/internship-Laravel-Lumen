<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StagiaireController {
    public function lister(Request $request){
        //return view('stagiaires/lister');
        //$stagiaires = DB::table('stagiaires')->get();
        /*$stagiaires = DB::table('stagiaires')
            ->join('niveaux', 'stagiaires.idniveau', '=', 'niveaux.id')
            ->select('stagiaires.*', 'niveaux.niveau')
            ->get();*/
        $query = $request->input('query');
        $stagiaires = DB::table('stagiaires')
            ->join('niveaux', 'stagiaires.idniveau', '=', 'niveaux.id')
            ->join('demandes', 'stagiaires.id', '=', 'demandes.idStagiaire')
            ->where('demandes.idStatut', '=', 1)
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where(function ($subQuery) use ($query) {
                    $subQuery->where('stagiaires.cin', 'like', "%$query%")
                        ->orWhere('stagiaires.nom', 'like', "%$query%")
                        ->orWhere('stagiaires.prenom', 'like', "%$query%");
                });
            })
            ->select('stagiaires.*', 'niveaux.niveau')
            //->get();
            ->paginate(2);
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
    public function delete($stagiaireId)
{
    try {
        DB::table('stagiaires')->where('id', $stagiaireId)->delete();
        return redirect()->route('stagiaires.lister')->with('success', 'Stagiaire deleted successfully.');
    } catch (\Throwable $e) {
        return redirect()->route('stagiaires.lister')->with('error', 'Failed to delete stagiaire.');
    }
}
    
}