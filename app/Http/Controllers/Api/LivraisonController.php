<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Livraison;
use App\Models\Lignelivraison;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\LivraisonResource;
use App\Http\Requests\Livraison\StoreLivraisonRequest;
use App\Http\Requests\Livraison\UpdateLivraisonRequest;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class LivraisonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/livraisons",
     *      operationId="Affiche livraisons et Lignelivraisons",
     *      tags={"Affiche livraisons et Lignelivraisons"},

     *      summary="Affiche la liste des livraisons et Lignelivraisons",
     *      description="Retourner Touts les livraisons et Lignelivraisons",
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
        $livraisons = Livraison::paginate(10);
        if ($livraisons->isEmpty()) {
            return response()->json([
                "message" => "Aucun Livraison n'est pas trouve"
            ], 200);
        }
        return LivraisonResource::collection($livraisons);
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
     *      path="/livraisons",
     *      operationId="Store livraisons et Lignelivraisons",
     *      tags={"Ajouter livraisons et Lignelivraisons"},

     *      summary="Ajoute livraisons et Lignelivraisons",
     *      description="Ajouter  livraisons et Lignelivraisons et Retourne les Valeurs Ajouter",
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
    public function store(StoreLivraisonRequest $request)
    {
        try {
            $livraison = new Livraison();
            $livraison->NumLivraison = $request->NumLivraison;
            $livraison->StatusLivraison = "Non Facturer";
            $livraison->DescriptionLivraison = $request->DescriptionLivraison;
            $livraison->TotalLivraison = $request->TotalLivraison;
            $livraison->commandeclient_id = $request->commandeclient_id;
            $livraison->save();
            $data = [];
            foreach ($request->article_id as $key => $value) {
                $data[] = [
                    'article_id' => $request->article_id[$key],
                    'ReferenceLigneLivraison' => $request->ReferenceLigneLivraison[$key],
                    'DesignationLigneLivraison' => $request->DesignationLigneLivraison[$key],
                    'PrixVenteLigneLivraison' => $request->PrixVenteLigneLivraison[$key],
                    'quantiteLigneLivraison' => $request->quantiteLigneLivraison[$key],
                    'quantiteCMDCLLigneLivraison' => $request->quantiteCMDCLLigneLivraison[$key],
                    'soustotalLigneLivraison' => $request->soustotalLigneLivraison[$key],
                    'livraison_id' => $livraison->id
                ];
                Article::where('id', $request->article_id[$key])->update(["StockActuel" => DB::raw('StockActuel - ' . $request->quantiteLigneLivraison[$key])]);
            }
            Lignelivraison::insert($data);


            if ($livraison->save()) {
                return new LivraisonResource($livraison);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Creation de Livraison a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Livraison  $livraison
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/livraisons/{livraison}",
     *      operationId="Show livraison et Lignelivraison",
     *      tags={"Affiche livraison et Lignelivraison par ID"},
     *      summary="Affiche le Commandeachat et Lignecommandeachat par ID",
     *      description="Retourner le livraison et Lignelivraison",
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
    public function show(Livraison $livraison)
    {
        return new LivraisonResource($livraison);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Livraison  $livraison
     * @return \Illuminate\Http\Response
     */
    public function edit(Livraison $livraison)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Livraison  $livraison
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\PUT(
     *      path="/livraisons/{livraison}",
     *      operationId="Modifier livraison et Lignelivraison",
     *      tags={"Mise en Jour livraison et Lignelivraison"},
     *      summary="Modifier livraison et Lignelivraison",
     *      description="Retourner livraison et Lignelivraison Modifier",
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
    public function update(UpdateLivraisonRequest $request, Livraison $livraison)
    {
        try {
            $livraison->lignelivraisons->each(function ($item) {
                $article = Article::find($item->article_id);
                $article->update(['StockActuel' => $article->StockActuel + $item->quantiteLigneLivraison]);
            });
            $livraison->NumLivraison = $request->NumLivraison;
            $livraison->StatusLivraison = "Non Facturer";
            $livraison->DescriptionLivraison = $request->DescriptionLivraison;
            $livraison->TotalLivraison = $request->TotalLivraison;
            $livraison->commandeclient_id = $request->commandeclient_id;
            $livraison->save();
            $livraison->lignelivraisons()->delete();
            $data = [];
            foreach ($request->article_id as $key => $value) {
                $data[] = [
                    'article_id' => $request->article_id[$key],
                    'ReferenceLigneLivraison' => $request->ReferenceLigneLivraison[$key],
                    'DesignationLigneLivraison' => $request->DesignationLigneLivraison[$key],
                    'PrixVenteLigneLivraison' => $request->PrixVenteLigneLivraison[$key],
                    'quantiteLigneLivraison' => $request->quantiteLigneLivraison[$key],
                    'quantiteCMDCLLigneLivraison' => $request->quantiteCMDCLLigneLivraison[$key],
                    'soustotalLigneLivraison' => $request->soustotalLigneLivraison[$key],
                    'livraison_id' => $livraison->id
                ];
            }
            Lignelivraison::insert($data);


            if ($livraison->save()) {
                return new LivraisonResource($livraison);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Modification de Livraison a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Livraison  $livraison
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/livraisons/{livraison}",
     *      operationId="Delete livraison et Lignelivraison",
     *      tags={"Supprimer livraison et Lignelivraison"},

     *      summary="Supprimer un livraison et Lignelivraison",
     *      description="Supprimer un livraison et Lignelivraison",
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
    public function destroy(Livraison $livraison)
    {
        try {
            $livraison->lignelivraisons->each(function ($item) {
                $article = Article::find($item->article_id);
                $article->update(['StockActuel' => $article->StockActuel + $item->quantiteLigneLivraison]);
            });
            $livraison->lignelivraisons()->delete();
            $livraison->delete();
            return response()->json([
                'status' => true,
                'message' => 'Cette Livraison est supprimer avec success',
            ], 204);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Suppression de Livraison a eu un Probleme"
            ], 500);
        }
    }
}
