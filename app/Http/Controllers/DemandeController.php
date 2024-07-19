<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Josantonius\Session\Facades\Session;


class DemandeController extends Controller
{

    public function __construct(private Factory $validatorFactory)
    {
    }
    public function postuler(Request $request)
    {
        try {
            $niveaux = DB::select('select * from niveaux');
            $entites = DB::select('select * from entite');

            return view('demandes.postuler', [
                'niveaux' => $niveaux,
                'entites' => $entites,
                'errors' => $request->attributes->get('errors')
            ]);
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }

    public function sauvegarder(Request $request)
    {
        try {
            $validator = $this->validatorFactory->make(array_merge($request->all(), ['cv_input' => $request->file('cv_input')]), [
                'cin' => 'required|string|unique:stagiaires,cin',
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'idniveau' => 'required|exists:niveaux,id',
                'sexe' => 'required|in:Male,Female',
                'etablissement' => 'required|string',
                'cv_input' => 'required|file|mimes:pdf,doc,docx',
                'dateDebut' => 'required|date',
                'dateFin' => 'required|date|after_or_equal:dateDebut',
                'objet' => 'required|string',
                'detail' => 'required|string',
                'idEntite' => 'required|exists:entite,id',
            ]);

            $attributes = $validator->validate();

            try {
                // Insert into stagiaires table
                $stagiaireId = DB::table('stagiaires')->insertGetId([
                    'cin' => $attributes['cin'],
                    'nom' => $attributes['nom'],
                    'prenom' => $attributes['prenom'],
                    'idniveau' => $attributes['idniveau'],
                    'sexe' => $attributes['sexe'],
                    'etablissement' => $attributes['etablissement'],
                ]);

                // Insert into demandes table
                $demandeId = DB::table('demandes')->insertGetId([
                    'dateDemande' => Carbon::now(),
                    'dateDebut' => $attributes['dateDebut'],
                    'dateFin' => $attributes['dateFin'],
                    'idStatut' => 1, // Replace with actual statut ID
                    'objet' => $attributes['objet'],
                    'detail' => $attributes['detail'],
                    'idEntite' => $attributes['idEntite'],
                    'idstagiaire' => $stagiaireId,
                ]);

                // Handle file upload for CV
                if ($request->hasFile('cv_input')) {
                    $cvFile = $request->file('cv_input');
                    $cvFileName = time() . '_' . $cvFile->getClientOriginalName();
                    $cvFile->move(base_path('public/uploads/cv'), $cvFileName);

                    // Insert CV file path into documents table
                    DB::table('documents')->insertGetId([
                        'filepath' => 'uploads/cv/' . $cvFileName,
                        'idDemande' => $demandeId,
                    ]);
                }

                // Redirect or return response
                return redirect()->route('demande.postuler');
            } catch (\Exception $e) {
                // Rollback transaction on error
                //DB::rollback();
                dd($e);
            }
        } catch (ValidationException $e) {
            Session::set('errors', $e->errors());
            return redirect(route('demande.postuler'));
        }
    }
    public function accepter(Request $request)
    {
        $demandeId = $request->input('demande_id');
        try {
            DB::table('demandes')->where('id', $demandeId)->update(['idStatut' => 2]); // Statut "Validé"
            return redirect()->route('stagiaire');
        } catch (\Exception $e) {
            Session::set('error', 'Erreur lors de l\'acceptation de la demande');
            return redirect()->back();
        }
    }

    /*public function stagiairesAcceptees()
    {
        $stagiaires = DB::table('stagiaires')
            ->join('demandes', 'stagiaires.id', '=', 'demandes.idStagiaire')
            ->where('demandes.idStatut', 2) // Statut "Validé"
            ->select('stagiaires.*')
            ->get();

        return view('stagiaires.acceptees', ['stagiaires' => $stagiaires]);
    }*/
    public function stagiairesAcceptees()
    {
        $stagiaires = DB::table('stagiaires')
            ->join('demandes', 'stagiaires.id', '=', 'demandes.idstagiaire')
            ->join('niveaux', 'stagiaires.idniveau', '=', 'niveaux.id')
            ->where('demandes.idstatut', 2) // Statut "Validé"
            ->select('stagiaires.*', 'niveaux.niveau as niveau')
            ->get();

        return view('stagiaires.acceptees', ['stagiaires' => $stagiaires]);
    }

    public function refuser(Request $request)
    {
        $demandeId = $request->input('demande_id');
        try {
            DB::table('demandes')->where('id', $demandeId)->update(['idStatut' => 3]); // Statut "Validé"
            return redirect()->route('stagiaire');
        } catch (\Exception $e) {
            Session::set('error', 'Erreur lors de l\'acceptation de la demande');
            return redirect()->back();
        }
    }

    public function stagiairesRefuses()
    {
        $stagiaires = DB::table('stagiaires')
            ->join('demandes', 'stagiaires.id', '=', 'demandes.idstagiaire')
            ->join('niveaux', 'stagiaires.idniveau', '=', 'niveaux.id')
            ->where('demandes.idstatut', 3) // Statut "Refusé"
            ->select('stagiaires.*', 'niveaux.niveau as niveau')
            ->get();

        return view('stagiaires.refuses', ['stagiaires' => $stagiaires]);
    }

    public function deconnexion()
    {
        Session::remove('adminauth'); 

         
        return redirect()->route('home'); 
    }

    public function detaille(Request $request)
    {
        $demandeId = $request->input('demande_id');
        $stagiaires = DB::table('stagiaires')
            ->join('demandes', 'stagiaires.id', '=', 'demandes.idStagiaire')
            ->join('niveaux', 'stagiaires.idniveau', '=', 'niveaux.id')
            ->where('demandes.id', $demandeId)
            ->select('stagiaires.*', 'niveaux.niveau as niveau')
            ->get();

        return view('stagiaires.details', ['stagiaires' => $stagiaires]);
    }
}
