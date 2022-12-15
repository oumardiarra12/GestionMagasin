<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reglementfournisseur;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\ReglementFournisseurResource;
use App\Http\Requests\ReglementFournisseur\StoreReglementFournisseurRequest;
use App\Http\Requests\ReglementFournisseur\UpdateReglementFournisseurRequest;

class ReglementFounisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/reglementfournisseurs",
     *      operationId="Affiche Reglement de Fournisseurs",
     *      tags={"Affiche Reglement de Fournisseur"},

     *      summary="Affiche la liste des Reglements de Fournisseurs",
     *      description="Retourner Touts les Reglement de Fournisseurs",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
    public function index()
    {
        $reglementfournisseurs = Reglementfournisseur::paginate(10);
        if ($reglementfournisseurs->isEmpty()) {
            return response()->json([
                "message" => "Aucun Reglement Fournisseur n'est pas trouve"
            ], 200);
        }
        return ReglementFournisseurResource::collection($reglementfournisseurs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Post(
     *      path="/reglementfournisseurs",
     *      operationId="Store Reglement Fournisseur",
     *      tags={"Ajouter Reglement Fournisseur"},

     *      summary="Ajoute Reglement Fournisseur",
     *      description="Ajouter  Reglement Fournisseur et Retourne les Valeurs Ajouter",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
    public function store(StoreReglementFournisseurRequest $request)
    {
        try {
            $reglementfournisseur = Reglementfournisseur::create($request->post());
            return new ReglementFournisseurResource($reglementfournisseur);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Creation de Reglement Fournisseur a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reglementfournisseur  $reglementfournisseur
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/reglementfournisseurs/{reglementfournisseur}",
     *      operationId="Show Reglement de Fournisseur",
     *      tags={"Affiche Reglement de Fournisseur par ID"},
     *      summary="Affiche leReglement de Fournisseur par ID",
     *      description="Retourner le Reglement de Fournisseur",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
    public function show(Reglementfournisseur $reglementfournisseur)
    {
        return new ReglementFournisseurResource($reglementfournisseur);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reglementfournisseur  $reglementfournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Reglementfournisseur $reglementfournisseur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reglementfournisseur  $reglementfournisseur
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\PUT(
     *      path="/reglementfournisseurs/{reglementfournisseur}",
     *      operationId="Modifier Reglement de Fournisseur",
     *      tags={"Mise en Jour Reglement de Fournisseur"},
     *      summary="Modifier Reglement de Fournisseur",
     *      description="Retourner Reglement de Fournisseur Modifier",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
    public function update(UpdateReglementFournisseurRequest $request, Reglementfournisseur $reglementfournisseur)
    {
        try {
            $reglementfournisseur->update($request->post());
            return new ReglementFournisseurResource($reglementfournisseur);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Modification de Reglement Fournisseur a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reglementfournisseur  $reglementfournisseur
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/reglementfournisseurs/{reglementfournisseur}",
     *      operationId="Delete Reglement de Fournisseur",
     *      tags={"Supprimer Reglement de Fournisseur"},

     *      summary="Supprimer un Reglement de Fournisseur",
     *      description="Supprimer un Reglement de Fournisseur",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
    public function destroy(Reglementfournisseur $reglementfournisseur)
    {

        try {
            $reglementfournisseur->delete();
            return response()->json([
                'status' => true,
                'message' => 'Ce Reglement de Fournisseur est supprimer avec success',
            ], 204);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Suppression de Fournisseur a eu un Probleme"
            ], 500);
        }
    }
}
