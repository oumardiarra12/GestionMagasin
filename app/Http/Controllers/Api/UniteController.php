<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Unite;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\UniteResource;
use App\Http\Requests\Unite\StoreUniteRequest;
use App\Http\Requests\Unite\UpdateUniteRequest;

class UniteController extends Controller
{
    /**
     * @OA\Get(
     *      path="/unites",
     *      operationId="affiche unites",
     *      tags={"Affiche Unites"},

     *      summary="Affiche la liste des unites",
     *      description="Retourner Touts les Unites",
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
        $unites = Unite::paginate(10);
        if ($unites->isEmpty()) {
            return response()->json([
                "message" => "Aucun Unite n'a ete  trouve"
            ], 200);
        }
        return  UniteResource::collection($unites);
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
     *      path="/unites",
     *      operationId="Store Unite",
     *      tags={"Ajouter Unite"},

     *      summary="Ajoute Unite Article",
     *      description="Ajouter Unite Article et Retourne les Valeurs Ajouter",
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
    public function store(StoreUniteRequest $request)
    {
        try {
            $unite = Unite::create($request->post());
            return new UniteResource($unite);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Creation Unite a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unite  $unite
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/unites/{unite}",
     *      operationId="Show Unite",
     *      tags={"Affiche Unite par ID"},

     *      summary="Affiche l'unite par ID",
     *      description="Retourner l'Unite",
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
    public function show(Unite $unite)
    {
        return new UniteResource($unite);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unite  $unite
     * @return \Illuminate\Http\Response
     */
    public function edit(Unite $unite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unite  $unite
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\PUT(
     *      path="/unites/{unite}",
     *      operationId="Modifier Unite",
     *      tags={"Mise en Jour Unite Article"},

     *      summary="Modifier  unite Article",
     *      description="Retourner Unite Modifier",
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
    public function update(UpdateUniteRequest $request, Unite $unite)
    {
        try {
            $unite->update($request->all());
            return new UniteResource($unite);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Modification Unite a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unite  $unite
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/unites/{unite}",
     *      operationId="Delete Unite",
     *      tags={"Supprimer Unite"},

     *      summary="Supprimer une unite",
     *      description="Supprimer une Unite",
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
    public function destroy(Unite $unite)
    {
        try {
            $unite->delete();
            return response()->json([
                'status' => true,
                'message' => 'Cet unite est supprimer avec success',
            ], 204);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Suppession Unite a eu un Probleme"
            ], 500);
        }
    }
}
