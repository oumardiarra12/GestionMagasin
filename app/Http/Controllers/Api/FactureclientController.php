<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Factureclient;
use App\Models\Lignefactureclient;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\FactureclientResource;
use App\Http\Requests\Factureclient\StoreFactureclientRequest;
use App\Http\Requests\Factureclient\UpdateFactureclientRequest;

class FactureclientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/factureclients",
     *      operationId="Affiche Facture de clients",
     *      tags={"Affiche  Facture de clients"},

     *      summary="Affiche la liste des Facture de clients",
     *      description="Retourner Touts les Facture de clients",
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
        $factureclients = Factureclient::paginate(10);
        if ($factureclients->isEmpty()) {
            return response()->json([
                "message" => "Aucun Facture Client n'est pas trouve"
            ], 200);
        }
        return FactureclientResource::collection($factureclients);
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
     *      path="/factureclients",
     *      operationId="Store Facture de client",
     *      tags={"Ajouter Facture de client"},

     *      summary="Ajoute Facture de clients",
     *      description="Ajouter  Facture de client et Retourne les Valeurs Ajouter",
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
    public function store(StoreFactureclientRequest $request)
    {
        try {
            $factureclient = new Factureclient();
            $factureclient->NumFactureClient = $request->NumFactureClient;
            $factureclient->StatusFactureClient = "Non Regler";
            $factureclient->livraison_id = $request->livraison_id;
            $factureclient->DescriptionFactureClient = $request->DescriptionFactureClient;
            $factureclient->TotalFactureClient = $request->TotalFactureClient;
            $factureclient->save();
            $data = [];
            foreach ($request->article_id as $key => $value) {
                $data[] = [
                    'article_id' => $request->article_id[$key],
                    'Referencefcl' => $request->Referencefcl[$key],
                    'Designationfcl' => $request->Designationfcl[$key],
                    'PrixVentefcl' => $request->PrixVentefcl[$key],
                    'quantitefcl' => $request->quantitefcl[$key],
                    'soustotalfcl' => $request->soustotalfcl[$key],
                    'factureclient_id' => $factureclient->id
                ];
            }
            Lignefactureclient::insert($data);

            if ($factureclient->save()) {
                return new FactureclientResource($factureclient);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Creation de Facture Client  a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Factureclient  $factureclient
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/factureclients/{factureclient}",
     *      operationId="Show Facture de client",
     *      tags={"Affiche Facture de client par ID"},
     *      summary="Affiche le Facture de client par ID",
     *      description="Retourner le Facture de client",
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
    public function show(Factureclient $factureclient)
    {
        return new FactureclientResource($factureclient);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Factureclient  $factureclient
     * @return \Illuminate\Http\Response
     */
    public function edit(Factureclient $factureclient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Factureclient  $factureclient
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\PUT(
     *      path="/factureclients/{factureclient}",
     *      operationId="Modifier Facture Client et Lignefacture Client",
     *      tags={"Mise en Jour Facture et Lignefacture"},
     *      summary="Modifier Facture et Lignefacture",
     *      description="Retourner Facture et Lignefacture Modifier",
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
    public function update(UpdateFactureclientRequest $request, Factureclient $factureclient)
    {
        try {
            $factureclient->NumFactureClient = $request->NumFactureClient;
            $factureclient->StatusFactureClient = "Non Regler";
            $factureclient->livraison_id = $request->livraison_id;
            $factureclient->DescriptionFactureClient = $request->DescriptionFactureClient;
            $factureclient->TotalFactureClient = $request->TotalFactureClient;
            $factureclient->save();
            $factureclient->lignefactures()->delete();
            $data = [];
            foreach ($request->article_id as $key => $value) {
                $data[] = [
                    'article_id' => $request->article_id[$key],
                    'Referencefcl' => $request->Referencefcl[$key],
                    'Designationfcl' => $request->Designationfcl[$key],
                    'PrixVentefcl' => $request->PrixVentefcl[$key],
                    'quantitefcl' => $request->quantitefcl[$key],
                    'soustotalfcl' => $request->soustotalfcl[$key],
                    'factureclient_id' => $factureclient->id
                ];
            }
            Lignefactureclient::insert($data);

            if ($factureclient->save()) {
                return new FactureclientResource($factureclient);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Modification de Facture Client  a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Factureclient  $factureclient
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/factureclients/{factureclient}",
     *      operationId="Delete Facture Client et Lignefacture Client",
     *      tags={"Supprimer Facture et Lignefacture"},

     *      summary="Supprimer un Facture et Lignefacture",
     *      description="Supprimer un Facture et Lignefacture",
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
    public function destroy(Factureclient $factureclient)
    {
        try {
            $factureclient->lignefactures()->delete();
            $factureclient->delete();
            return response()->json([
                'status' => true,
                'message' => 'Ce Facture Client est supprimer avec success',
            ], 204);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Suppression de Facture Client a eu un Probleme"
            ], 500);
        }
    }
}
