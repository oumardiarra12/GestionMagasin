<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\CategorieResource;
use App\Http\Requests\Categorie\StoreCategorieRequest;
use App\Http\Requests\Categorie\UpdateCategorieRequest;


class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/categories",
     *      operationId="Affiche Categorie",
     *      tags={"Affiche Categories"},

     *      summary="Affiche la liste des categories",
     *      description="Retourner Touts les Categories",
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
        $categories = Categorie::paginate(10);
        if ($categories->isEmpty()) {
            return response()->json([
                "message" => "Aucun Categorie n'est pas trouve"
            ], 200);
        }
        return CategorieResource::collection($categories);
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
     *      path="/categories",
     *      operationId="Store Categorie",
     *      tags={"Ajouter Categorie"},

     *      summary="Ajoute  Categorie Article",
     *      description="Ajouter Categorie Article et Retourne les Valeurs Ajouter",
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
    public function store(StoreCategorieRequest $request)
    {
        try {
            $categorie = Categorie::create($request->post());
            return new CategorieResource($categorie);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Creation de Categorie a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/categories/{categorie}",
     *      operationId="Show Categorie",
     *      tags={"Affiche Categorie par ID"},

     *      summary="Affiche l'Categorie par ID",
     *      description="Retourner l'Categorie",
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
    public function show(Categorie $categorie)
    {
        return new CategorieResource($categorie);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\PUT(
     *      path="/categories/{categorie}",
     *      operationId="Modifier Categorie",
     *      tags={"Mise en Jour Categorie Article"},

     *      summary="Modifier  Categorie Article",
     *      description="Retourner Categorie Modifier",
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
    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        try {
            $categorie->update($request->post());
            return new CategorieResource($categorie);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Modification de Categorie a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/categories/{categorie}",
     *      operationId="Delete Categorie",
     *      tags={"Supprimer Categorie"},

     *      summary="Supprimer une Categorie",
     *      description="Supprimer une Categorie",
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
    public function destroy(Categorie $categorie)
    {
        try {
            $categorie->delete();
            return response()->json([
                'status' => true,
                'message' => 'Ce Categorie est supprimer avec success'
            ], 204);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Suppression de Categorie a eu un Probleme"
            ], 500);
        }
    }
}
