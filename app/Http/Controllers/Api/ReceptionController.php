<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reception;
use App\Models\Lignereception;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\ReceptionResource;
use App\Http\Requests\Reception\StoreReceptionRequest;
use App\Http\Requests\Reception\UpdateReceptionRequest;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class ReceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/receptions",
     *      operationId="Affiche Receptions et Lignereceptions",
     *      tags={"Affiche Receptions et Lignereceptions"},

     *      summary="Affiche la liste des Receptions et Lignereceptions",
     *      description="Retourner Touts les Receptions et Lignereceptions",
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
        $receptions = Reception::paginate(10);
        if ($receptions->isEmpty()) {
            return response()->json([
                "message" => "Aucun Reception n'est pas trouve"
            ], 200);
        }
        return ReceptionResource::collection($receptions);
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
     *      path="/receptions",
     *      operationId="Store Receptions et Lignereceptions",
     *      tags={"Ajouter Receptions et Lignereceptions"},

     *      summary="Ajoute Receptions et Lignereceptions",
     *      description="Ajouter  Receptions et Lignereceptions et Retourne les Valeurs Ajouter",
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
    public function store(StoreReceptionRequest $request)
    {
        try {
            $reception = new Reception();
            $reception->NumRecept = $request->NumRecept;
            $reception->StatusReception = "Non Facturer";
            $reception->DescriptionRecept = $request->DescriptionRecept;
            $reception->TotalRecept = $request->TotalRecept;
            $reception->commandeachat_id = $request->commandeachat_id;
            $reception->save();
            $data = [];
            foreach ($request->article_id as $key => $value) {
                $data[] = [
                    'article_id' => $request->article_id[$key],
                    'ReferenceLigneRecept' => $request->ReferenceLigneRecept[$key],
                    'DesignationLigneRecept' => $request->DesignationLigneRecept[$key],
                    'PrixVenteLigneRecept' => $request->PrixVenteLigneRecept[$key],
                    'quantiteCMDLigneRecept' => $request->quantiteCMDLigneRecept[$key],
                    'quantiteLigneRecept' => $request->quantiteLigneRecept[$key],
                    'soustotalLigneRecept' => $request->soustotalLigneRecept[$key],
                    'reception_id' => $reception->id
                ];

                Article::where('id', $request->article_id[$key])->update(["StockActuel" => DB::raw('StockActuel + ' . $request->quantiteLigneRecept[$key])]);
            }
            Lignereception::insert($data);


            if ($reception->save()) {
                return new ReceptionResource($reception);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $th->getMessage();
            return response()->json([
                "message" => "La Creation de Reception a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/receptions/{reception}",
     *      operationId="Show Reception et Lignereception",
     *      tags={"Affiche Reception et Lignereception par ID"},
     *      summary="Affiche le Commandeachat et Lignecommandeachat par ID",
     *      description="Retourner le Reception et Lignereception",
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
    public function show(Reception $reception)
    {
        return new ReceptionResource($reception);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function edit(Reception $reception)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\PUT(
     *      path="/receptions/{reception}",
     *      operationId="Modifier Reception et Lignereception",
     *      tags={"Mise en Jour Reception et Lignereception"},
     *      summary="Modifier Reception et Lignereception",
     *      description="Retourner Reception et Lignereception Modifier",
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
    public function update(UpdateReceptionRequest $request, Reception $reception)
    {
        try {
            $reception->lignereceptions->each(function ($item) {
                $article = Article::find($item->article_id);
                $article->update(['StockActuel' => $article->StockActuel - $item->quantiteLigneRecept]);
            });
            $reception->NumRecept = $request->NumRecept;
            $reception->StatusReception = "Non Facturer";
            $reception->DescriptionRecept = $request->DescriptionRecept;
            $reception->TotalRecept = $request->TotalRecept;
            $reception->commandeachat_id = $request->commandeachat_id;
            $reception->save();
            $reception->lignereceptions()->delete();
            $data = [];
            foreach ($request->article_id as $key => $value) {
                $data[] = [
                    'article_id' => $request->article_id[$key],
                    'ReferenceLigneRecept' => $request->ReferenceLigneRecept[$key],
                    'DesignationLigneRecept' => $request->DesignationLigneRecept[$key],
                    'PrixVenteLigneRecept' => $request->PrixVenteLigneRecept[$key],
                    'quantiteCMDLigneRecept' => $request->quantiteCMDLigneRecept[$key],
                    'quantiteLigneRecept' => $request->quantiteLigneRecept[$key],
                    'soustotalLigneRecept' => $request->soustotalLigneRecept[$key],
                    'reception_id' => $reception->id
                ];
                Article::where('id', $request->article_id[$key])->update(["StockActuel" => DB::raw('StockActuel + ' . $request->quantiteLigneRecept[$key])]);
            }
            Lignereception::insert($data);

            if ($reception->save()) {
                return new ReceptionResource($reception);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Modification de Reception a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/receptions/{reception}",
     *      operationId="Delete Reception et Lignereception",
     *      tags={"Supprimer Reception et Lignereception"},

     *      summary="Supprimer un Reception et Lignereception",
     *      description="Supprimer un reception et Lignereception",
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
    public function destroy(Reception $reception)
    {
        try {
            $reception->lignereceptions->each(function ($item) {
                $article = Article::find($item->article_id);
                $article->update(['StockActuel' => $article->StockActuel - $item->quantiteLigneRecept]);
            });
            $reception->lignereceptions()->delete();
            $reception->delete();
            return response()->json([
                'status' => true,
                'message' => 'Cette Reception est supprimer avec success',
            ], 204);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $th->getMessage();
            return response()->json([
                "message" => "La Suppression de Reception a eu un Probleme"
            ], 500);
        }
    }
}
