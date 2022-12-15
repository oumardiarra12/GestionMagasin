<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Commandeclient;
use App\Models\Lignecommandeclient;
use App\Http\Resources\CommandeclientResource;
use App\Http\Requests\Commandeclient\StoreCommandeclientRequest;
use App\Http\Requests\Commandeclient\UpdateCommandeclientRequest;
use Illuminate\Support\Facades\Log;

class CommmandeclientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/commandeclients",
     *      operationId="Affiche Commandeclients et Lignecommandeclients",
     *      tags={"Affiche Commandeclients et Lignecommandeclients"},

     *      summary="Affiche la liste des Commandeclients et Lignecommandeclients",
     *      description="Retourner Touts les Commandeclients et Lignecommandeclients",
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
        $commandeclients = Commandeclient::paginate(10);
        if ($commandeclients->isEmpty()) {
            return response()->json([
                "message" => "Aucun Commande Client n'est pas trouve"
            ], 200);
        }
        return CommandeclientResource::collection($commandeclients);
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
     *      path="/commandeclients",
     *      operationId="Store Commandeclients et Lignecommandeclients",
     *      tags={"Ajouter Commandeclients et Lignecommandeclients"},

     *      summary="Ajoute Commandeclients et Lignecommandeclients",
     *      description="Ajouter  Commandeclients et Lignecommandeclients et Retourne les Valeurs Ajouter",
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
    public function store(StoreCommandeclientRequest $request)
    {
        try {
            $commandeclient = new Commandeclient();
            $commandeclient->NumCommandeClient = $request->NumCommandeClient;
            $commandeclient->StatusCommandeClient = "Non Livrer";
            $commandeclient->client_id = $request->client_id;
            $commandeclient->DescriptionCommandeClient = $request->DescriptionCommandeClient;
            $commandeclient->TotalCommandeClient = $request->TotalCommandeClient;
            $commandeclient->save();
            $data = [];
            foreach ($request->article_id as $key => $value) {
                $data[] = [
                    'article_id' => $request->article_id[$key],
                    'Referencecmdc' => $request->Referencecmdc[$key],
                    'Designationcmdc' => $request->Designationcmdc[$key],
                    'Prixclientcmdc' => $request->Prixclientcmdc[$key],
                    'quantitecmdc' => $request->quantitecmdc[$key],
                    'soustotalcmdc' => $request->soustotalcmdc[$key],
                    'commandeclient_id' => $commandeclient->id
                ];
            }
            Lignecommandeclient::insert($data);

            if ($commandeclient->save()) {
                return new CommandeclientResource($commandeclient);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Creation de Commande Vente a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commandeclient  $commandeclient
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/commandeclients/{commandeclient}",
     *      operationId="Show Commandeclient et Lignecommandeclient",
     *      tags={"Affiche Commandeclient et Lignecommandeclient par ID"},
     *      summary="Affiche le Commandeclient et Lignecommandeclient par ID",
     *      description="Retourner le Commandeclient et Lignecommandeclient",
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
    public function show(Commandeclient $commandeclient)
    {
        return new CommandeclientResource($commandeclient);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commandeclient  $commandeclient
     * @return \Illuminate\Http\Response
     */
    public function edit(Commandeclient $commandeclient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commandeclient  $commandeclient
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\PUT(
     *      path="/commandeclients/{commandeclient}",
     *      operationId="Modifier Commandeclient et Lignecommandeclient",
     *      tags={"Mise en Jour Commandeclient et Lignecommandeclient"},

     *      summary="Modifier Commandeclient et Lignecommandeclient",
     *      description="Retourner Commandeclient et Lignecommandeclient Modifier",
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
    public function update(UpdateCommandeclientRequest $request, Commandeclient $commandeclient)
    {
        try {
            $commandeclient->NumCommandeClient = $request->NumCommandeClient;
            $commandeclient->StatusCommandeClient = "Non Livrer";
            $commandeclient->client_id = $request->client_id;
            $commandeclient->DescriptionCommandeClient = $request->DescriptionCommandeClient;
            $commandeclient->TotalCommandeClient = $request->TotalCommandeClient;
            $commandeclient->save();
            $commandeclient->lignecommandeclients()->delete();
            $data = [];
            foreach ($request->article_id as $key => $value) {
                $data[] = [
                    'article_id' => $request->article_id[$key],
                    'Referencecmdc' => $request->Referencecmdc[$key],
                    'Designationcmdc' => $request->Designationcmdc[$key],
                    'Prixclientcmdc' => $request->Prixclientcmdc[$key],
                    'quantitecmdc' => $request->quantitecmdc[$key],
                    'soustotalcmdc' => $request->soustotalcmdc[$key],
                    'commandeclient_id' => $commandeclient->id
                ];
            }
            Lignecommandeclient::insert($data);

            if ($commandeclient->save()) {
                return new CommandeclientResource($commandeclient);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Modification de Commande Vente a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commandeclient  $commandeclient
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/commandeclients/{commandeclient}",
     *      operationId="Delete Commandeclient et Lignecommandeclient",
     *      tags={"Supprimer Commandeclient et Lignecommandeclient"},

     *      summary="Supprimer un Commandeclient et Lignecommandeclient",
     *      description="Supprimer un Commandeclient et Lignecommandeclient",
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
    public function destroy(Commandeclient $commandeclient)
    {
        try {
            $commandeclient->lignecommandeclients()->delete();
            $commandeclient->delete();
            return response()->json([
                'status' => true,
                'message' => 'Ce Commande Client est supprimer avec success',
            ], 204);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Suppression de Commande Client a eu un Probleme"
            ], 500);
        }
    }
}
