<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\FournisseurResource;
use App\Http\Requests\Fournisseur\StoreFournisseurRequest;
use App\Http\Requests\Fournisseur\UpdateFournisseurRequest;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/fournisseurs",
     *      operationId="Affiche Fournisseurs",
     *      tags={"Affiche Fournisseurs"},

     *      summary="Affiche la liste des Fournisseurs",
     *      description="Retourner Touts les Fournisseurs",
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
        $fournisseurs = Fournisseur::paginate(10);
        if ($fournisseurs->isEmpty()) {
            return response()->json([
                "message" => "Aucun Fournisseur n'est pas trouve"
            ], 200);
        }
        return FournisseurResource::collection($fournisseurs);
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
     *      path="/fournisseurs",
     *      operationId="Store Fournisseur",
     *      tags={"Ajouter Fournisseur"},

     *      summary="Ajoute Fournisseur",
     *      description="Ajouter  Fournisseur et Retourne les Valeurs Ajouter",
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
    public function store(StoreFournisseurRequest $request)
    {
        try {
            $fournisseur = Fournisseur::create($request->post());
            return new FournisseurResource($fournisseur);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Creation de Fournisseur a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/fournisseurs/{fournisseur}",
     *      operationId="Show Fournisseur",
     *      tags={"Affiche Fournisseur par ID"},
     *      summary="Affiche le Fournisseur par ID",
     *      description="Retourner le Fournisseur",
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
    public function show(Fournisseur $fournisseur)
    {
        return new FournisseurResource($fournisseur);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\PUT(
     *      path="/fournisseurs/{fournisseur}",
     *      operationId="Modifier Fournisseur",
     *      tags={"Mise en Jour Fournisseur"},

     *      summary="Modifier Fournisseur",
     *      description="Retourner Fournisseur Modifier",
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
    public function update(UpdateFournisseurRequest $request, Fournisseur $fournisseur)
    {
        try {
            $fournisseur->update($request->post());
            return new FournisseurResource($fournisseur);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Modification de Fournisseur a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/fournisseurs/{fournisseur}",
     *      operationId="Delete Fournisseur",
     *      tags={"Supprimer Fournisseur"},

     *      summary="Supprimer un Fournisseur",
     *      description="Supprimer un Fournisseur",
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
    public function destroy(Fournisseur $fournisseur)
    {
        try {
            $fournisseur->delete();
            return response()->json([
                'status' => true,
                'message' => 'Ce Fournisseur est supprimer avec success',
            ], 204);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Suppression de Fournisseur a eu un Probleme"
            ], 500);
        }
    }
}
