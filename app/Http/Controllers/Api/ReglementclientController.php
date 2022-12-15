<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reglementclient;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\ReglementclientResource;
use App\Http\Requests\Reglementclient\StoreReglementclientRequest;
use App\Http\Requests\Reglementclient\UpdateReglementclientRequest;

class ReglementclientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/reglementclients",
     *      operationId="Affiche Reglement de clients",
     *      tags={"Affiche Reglement de client"},

     *      summary="Affiche la liste des Reglements de clients",
     *      description="Retourner Touts les Reglement de clients",
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
        $reglementclients = Reglementclient::paginate(10);
        if ($reglementclients->isEmpty()) {
            return response()->json([
                "message" => "Aucun Reglement Client n'est pas trouve"
            ], 200);
        }
        return ReglementclientResource::collection($reglementclients);
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
     *      path="/reglementclients",
     *      operationId="Store Reglement client",
     *      tags={"Ajouter Reglement client"},

     *      summary="Ajoute Reglement client",
     *      description="Ajouter  Reglement client et Retourne les Valeurs Ajouter",
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
    public function store(StoreReglementclientRequest $request)
    {
        try {
            $reglementclient = Reglementclient::create($request->post());
            return new ReglementclientResource($reglementclient);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Creation de Reglement Client a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reglementclient  $reglementclient
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/reglementclients/{reglementclient}",
     *      operationId="Show Reglement de client",
     *      tags={"Affiche Reglement de client par ID"},
     *      summary="Affiche leReglement de client par ID",
     *      description="Retourner le Reglement de client",
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
    public function show(Reglementclient $reglementclient)
    {
        return new ReglementclientResource($reglementclient);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reglementclient  $reglementclient
     * @return \Illuminate\Http\Response
     */
    public function edit(Reglementclient $reglementclient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reglementclient  $reglementclient
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\PUT(
     *      path="/reglementclients/{reglementclient}",
     *      operationId="Modifier Reglement de client",
     *      tags={"Mise en Jour Reglement de client"},
     *      summary="Modifier Reglement de client",
     *      description="Retourner Reglement de client Modifier",
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
    public function update(UpdateReglementclientRequest $request, Reglementclient $reglementclient)
    {
        try {
            $reglementclient->update($request->post());
            return new ReglementclientResource($reglementclient);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Modification de Reglement Client a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reglementclient  $reglementclient
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/reglementclients/{reglementclient}",
     *      operationId="Delete Reglement de client",
     *      tags={"Supprimer Reglement de client"},

     *      summary="Supprimer un Reglement de client",
     *      description="Supprimer un Reglement de client",
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
    public function destroy(Reglementclient $reglementclient)
    {
        try {
            $reglementclient->delete();
            return response()->json([
                'status' => true,
                'message' => 'Ce Reglement de Client est supprimer avec success',
            ], 204);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Suppression de Client a eu un Probleme"
            ], 500);
        }
    }
}
