<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Devis;
use App\Models\Lignedevis;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\DevisResource;
use App\Http\Requests\Devis\StoreDevisRequest;
use App\Http\Requests\Devis\UpdateDevisRequest;

class DevisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/devis",
     *      operationId="Affiche devis et lignedevis",
     *      tags={"Affiche devis et lignedevis"},

     *      summary="Affiche la liste des devis et lignedevis",
     *      description="Retourner Touts les devis et lignedevis",
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
        $devis = Devis::paginate(10);
        if ($devis->isEmpty()) {
            return response()->json([
                "message" => "Aucun Devis n'est pas trouve"
            ], 200);
        }
        return DevisResource::collection($devis);
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
     *      path="/devis",
     *      operationId="Store devis et lignedevis",
     *      tags={"Ajouter devis et lignedevis"},

     *      summary="Ajoute devis et lignedevis",
     *      description="Ajouter  devis et lignedevis et Retourne les Valeurs Ajouter",
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
    public function store(StoreDevisRequest $request)
    {
        try {
            $devis = new Devis();
            $devis->NumDevis = $request->NumDevis;
            $devis->StatusDevis = "Non Accepter";
            $devis->client_id = $request->client_id;
            $devis->TotalDevis = $request->TotalDevis;
            $devis->RemisDevis = $request->RemisDevis;
            $devis->DescriptionDevis = $request->DescriptionDevis;
            $devis->save();
            $data = [];
            foreach ($request->article_id as $key => $value) {
                $data[] = [
                    'article_id' => $request->article_id[$key],
                    'ReferenceDevis' => $request->ReferenceDevis[$key],
                    'DesignationDevis' => $request->DesignationDevis[$key],
                    'PrixVenteDevis' => $request->PrixVenteDevis[$key],
                    'quantiteDevis' => $request->quantiteDevis[$key],
                    'soustotalDevis' => $request->soustotalDevis[$key],
                    'devis_id' => $devis->id
                ];
            }
            Lignedevis::insert($data);

            if ($devis->save()) {
                return new DevisResource($devis);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Creation de Devis a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Devis  $devis
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/devis/{devis}",
     *      operationId="Show devis et lignedevis",
     *      tags={"Affiche devis et lignedevis par ID"},
     *      summary="Affiche le devis et lignedevis par ID",
     *      description="Retourner le devis et lignedevis",
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
    public function show(Devis $devis)
    {
        return new DevisResource($devis);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Devis  $devis
     * @return \Illuminate\Http\Response
     */
    public function edit(Devis $devis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Devis  $devis
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\PUT(
     *      path="/devis/{devis}",
     *      operationId="Modifier devis et lignedevis",
     *      tags={"Mise en Jour devis et lignedevis"},

     *      summary="Modifier devis et lignedevis",
     *      description="Retourner devis et lignedevis Modifier",
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
    public function update(UpdateDevisRequest $request, Devis $devis)
    {
        try {
            $devis->NumDevis = $request->NumDevis;
            $devis->StatusDevis = "Non Accepter";
            $devis->client_id = $request->client_id;
            $devis->TotalDevis = $request->TotalDevis;
            $devis->RemisDevis = $request->RemisDevis;
            $devis->DescriptionDevis = $request->DescriptionDevis;
            $devis->save();
            $devis->lignedevis()->delete();
            $data = [];
            foreach ($request->article_id as $key => $value) {
                $data[] = [
                    'article_id' => $request->article_id[$key],
                    'ReferenceDevis' => $request->ReferenceDevis[$key],
                    'DesignationDevis' => $request->DesignationDevis[$key],
                    'PrixVenteDevis' => $request->PrixVenteDevis[$key],
                    'quantiteDevis' => $request->quantiteDevis[$key],
                    'soustotalDevis' => $request->soustotalDevis[$key],
                    'devis_id' => $devis->id
                ];
            }
            Lignedevis::insert($data);

            if ($devis->save()) {
                return new DevisResource($devis);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Modification de Devis a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Devis  $devis
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/devis/{devis}",
     *      operationId="Delete devis et lignedevis",
     *      tags={"Supprimer devis et lignedevis"},

     *      summary="Supprimer un devis et lignedevis",
     *      description="Supprimer un devis et lignedevis",
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
    public function destroy(Devis $devis)
    {
        try {
            $devis->lignedevis()->delete();
            $devis->delete();
            return response()->json([
                'status' => true,
                'message' => 'Ce Devis est supprimer avec success',
            ], 204);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Suppression de Devis a eu un Probleme"
            ], 500);
        }
    }
}
