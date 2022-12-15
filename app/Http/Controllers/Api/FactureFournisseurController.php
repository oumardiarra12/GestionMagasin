<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Facturefournisseur;
use App\Models\Lignefacturefournisseur;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\FactureFournisseurResource;
use App\Http\Requests\FactureFournisseur\StoreFactureFournisseurRequest;
use App\Http\Requests\FactureFournisseur\UpdateFactureFournisseurRequest;

class FactureFournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/facturefournisseurs",
     *      operationId="Affiche Facture de Fournisseurs",
     *      tags={"Affiche  Facture de Fournisseurs"},

     *      summary="Affiche la liste des Facture de Fournisseurs",
     *      description="Retourner Touts les Facture de Fournisseurs",
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
        $facturefournisseurs = Facturefournisseur::paginate(10);
        if ($facturefournisseurs->isEmpty()) {
            return response()->json([
                "message" => "Aucun Facture Achat n'est pas trouve"
            ], 200);
        }
        return FactureFournisseurResource::collection($facturefournisseurs);
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
     *      path="/facturefournisseurs",
     *      operationId="Store Facture de Fournisseur",
     *      tags={"Ajouter Facture de Fournisseur"},

     *      summary="Ajoute Facture de Fournisseurs",
     *      description="Ajouter  Facture de Fournisseur et Retourne les Valeurs Ajouter",
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
    public function store(StoreFactureFournisseurRequest $request)
    {
        try {
            $facturefournisseur = new Facturefournisseur();
            $facturefournisseur->NumFactures = $request->NumFactures;
            $facturefournisseur->StatusFacture = "Non Regler";
            $facturefournisseur->reception_id = $request->reception_id;
            $facturefournisseur->DescriptionFacture = $request->DescriptionFacture;
            $facturefournisseur->TotalFacture = $request->TotalFacture;
            $facturefournisseur->save();
            $data = [];
            foreach ($request->artticle_id as $key => $value) {
                $data[] = [
                    'article_id' => $request->article_id[$key],
                    'ReferenceLigneFacture' => $request->ReferenceLigneFacture[$key],
                    'DesignationLigneFacture' => $request->DesignationLigneFacture[$key],
                    'PrixAchatLigneFacture' => $request->PrixAchatLigneFacture[$key],
                    'quantiteLigneFacture' => $request->quantiteLigneFacture[$key],
                    'soustotalLigneFacture' => $request->soustotalLigneFacture[$key],
                    'facturefournisseur_id' => $facturefournisseur->id,
                ];
            }
            Lignefacturefournisseur::insert($data);
            if ($facturefournisseur->save()) {
                return new FactureFournisseurResource($facturefournisseur);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Creation de Facture de Fournisseur a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facturefournisseur  $facturefournisseur
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/facturefournisseurs/{facturefournisseur}",
     *      operationId="Show Facture de Fournisseur",
     *      tags={"Affiche Facture de Fournisseur par ID"},
     *      summary="Affiche le Facture de Fournisseur par ID",
     *      description="Retourner le Facture de Fournisseur",
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
    public function show(Facturefournisseur $facturefournisseur)
    {
        return new FactureFournisseurResource($facturefournisseur);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facturefournisseur  $facturefournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Facturefournisseur $facturefournisseur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facturefournisseur  $facturefournisseur
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\PUT(
     *      path="/facturefournisseurs/{facturefournisseur}",
     *      operationId="Modifier Facture et Lignefacture",
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
    public function update(UpdateFactureFournisseurRequest $request, Facturefournisseur $facturefournisseur)
    {

        try {
            $facturefournisseur->NumFactures = $request->NumFactures;
            $facturefournisseur->StatusFacture = "Non Regler";
            $facturefournisseur->reception_id = $request->reception_id;
            $facturefournisseur->DescriptionFacture = $request->DescriptionFacture;
            $facturefournisseur->TotalFacture = $request->TotalFacture;
            $facturefournisseur->save();
            $data = [];
            $facturefournisseur->lignefacturefournisseur()->delete();
            foreach ($request->artticle_id as $key => $value) {
                $data[] = [
                    'article_id' => $request->article_id[$key],
                    'ReferenceLigneFacture' => $request->ReferenceLigneFacture[$key],
                    'DesignationLigneFacture' => $request->DesignationLigneFacture[$key],
                    'PrixAchatLigneFacture' => $request->PrixAchatLigneFacture[$key],
                    'quantiteLigneFacture' => $request->quantiteLigneFacture[$key],
                    'soustotalLigneFacture' => $request->soustotalLigneFacture[$key],
                    'facturefournisseur_id' => $facturefournisseur->id,
                ];
            }
            Lignefacturefournisseur::insert($data);
            if ($facturefournisseur->save()) {
                return new FactureFournisseurResource($facturefournisseur);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Modification de Facture de Fournisseur a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facturefournisseur  $facturefournisseur
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/facturefournisseurs/{facturefournisseur}",
     *      operationId="Delete Facture et Lignefacture",
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
    public function destroy(Facturefournisseur $facturefournisseur)
    {
        try {
            $facturefournisseur->lignefacturefournisseur()->delete();
            $facturefournisseur->delete();
            return response()->json([
                'status' => true,
                'message' => 'Ce Facture Achat est supprimer avec success',
            ], 204);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Suppression de Facture Achat a eu un Probleme"
            ], 500);
        }
    }
}
