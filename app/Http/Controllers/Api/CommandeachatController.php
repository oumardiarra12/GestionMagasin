<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Commandeachat;
use App\Models\Lignecommandeachat;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\CommandeachatResource;
use App\Http\Requests\Commandeachat\StoreCommandeachatRequest;
use App\Http\Requests\Commandeachat\UpdateCommandeachatRequest;

class CommandeachatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/commandeachats",
     *      operationId="Affiche Commandeachats et Lignecommandeachats",
     *      tags={"Affiche Commandeachats et Lignecommandeachats"},

     *      summary="Affiche la liste des Commandeachats et Lignecommandeachats",
     *      description="Retourner Touts les Commandeachats et Lignecommandeachats",
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
        $commandeachats = Commandeachat::paginate(10);
        if ($commandeachats->isEmpty()) {
            return response()->json([
                "message" => "Aucun Commande Achat n'est pas trouve"
            ], 200);
        }
        return CommandeachatResource::collection($commandeachats);
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
     *      path="/commandeachats",
     *      operationId="Store Commandeachats et Lignecommandeachats",
     *      tags={"Ajouter Commandeachats et Lignecommandeachats"},

     *      summary="Ajoute Commandeachats et Lignecommandeachats",
     *      description="Ajouter  Commandeachats et Lignecommandeachats et Retourne les Valeurs Ajouter",
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
    public function store(StoreCommandeachatRequest $request)
    {
        try {
            $commandeachat = new Commandeachat();
            $commandeachat->NumCommandeAchat = $request->NumCommandeAchat;
            $commandeachat->StatusCommandeAchat = "Non Receptionner";
            $commandeachat->fournisseur_id = $request->fournisseur_id;
            $commandeachat->DescriptionCommandeAchat = $request->DescriptionCommandeAchat;
            $commandeachat->TotalCommandeAchat = $request->TotalCommandeAchat;
            $commandeachat->save();
            $data = [];
            foreach ($request->article_id as $key => $value) {
                $data[] = [
                    'article_id' => $request->article_id[$key],
                    'Referencecmdf' => $request->Referencecmdf[$key],
                    'Designationcmdf' => $request->Designationcmdf[$key],
                    'PrixAchatcmdf' => $request->PrixAchatcmdf[$key],
                    'quantitecmdf' => $request->quantitecmdf[$key],
                    'soustotalcmdf' => $request->soustotalcmdf[$key],
                    'commandeachat_id' => $commandeachat->id
                ];
            }
            Lignecommandeachat::insert($data);

            if ($commandeachat->save()) {
                return new CommandeachatResource($commandeachat);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $th->getMessage();
            return response()->json([
                "message" => "La Creation de Commande Achat a eu un Probleme"
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commandeachat  $commandeachat
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/commandeachats/{commandeachat}",
     *      operationId="Show Commandeachat et Lignecommandeachat",
     *      tags={"Affiche Commandeachat et Lignecommandeachat par ID"},
     *      summary="Affiche le Commandeachat et Lignecommandeachat par ID",
     *      description="Retourner le Commandeachat et Lignecommandeachat",
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
    public function show(Commandeachat $commandeachat)
    {

        return new CommandeachatResource($commandeachat);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commandeachat  $commandeachat
     * @return \Illuminate\Http\Response
     */
    public function edit(Commandeachat $commandeachat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commandeachat  $commandeachat
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\PUT(
     *      path="/commandeachats/{commandeachat}",
     *      operationId="Modifier Commandeachat et Lignecommandeachat",
     *      tags={"Mise en Jour Commandeachat et Lignecommandeachat"},

     *      summary="Modifier Commandeachat et Lignecommandeachat",
     *      description="Retourner Commandeachat et Lignecommandeachat Modifier",
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
    public function update(UpdateCommandeachatRequest $request, Commandeachat $commandeachat)
    {
        try {
            $commandeachat->NumCommandeAchat = $request->NumCommandeAchat;
            $commandeachat->StatusCommandeAchat = "Non Receptionner";
            $commandeachat->fournisseur_id = $request->fournisseur_id;
            $commandeachat->DescriptionCommandeAchat = $request->DescriptionCommandeAchat;
            $commandeachat->TotalCommandeAchat = $request->TotalCommandeAchat;
            $commandeachat->save();
            $commandeachat->lignecommandeachats()->delete();
            $data = [];
            foreach ($request->article_id as $key => $value) {
                $data[] = [
                    'article_id' => $request->article_id[$key],
                    'Referencecmdf' => $request->Referencecmdf[$key],
                    'Designationcmdf' => $request->Designationcmdf[$key],
                    'PrixAchatcmdf' => $request->PrixAchatcmdf[$key],
                    'quantitecmdf' => $request->quantitecmdf[$key],
                    'soustotalcmdf' => $request->soustotalcmdf[$key],
                    'commandeachat_id' => $commandeachat->id
                ];
            }
            Lignecommandeachat::insert($data);

            if ($commandeachat->save()) {
                return new CommandeachatResource($commandeachat);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Modification de Commande Achat a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commandeachat  $commandeachat
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/commandeachats/{commandeachat}",
     *      operationId="Delete Commandeachat et Lignecommandeachat",
     *      tags={"Supprimer Commandeachat et Lignecommandeachat"},

     *      summary="Supprimer un Commandeachat et Lignecommandeachat",
     *      description="Supprimer un Commandeachat et Lignecommandeachat",
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
    public function destroy(Commandeachat $commandeachat)
    {
        try {
            $commandeachat->lignecommandeachats()->delete();
            $commandeachat->delete();
            return response()->json([
                'status' => true,
                'message' => 'Ce Commande Achat est supprimer avec success',
            ], 204);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Suppression de Commande Achat a eu un Probleme"
            ], 500);
        }
    }
}
