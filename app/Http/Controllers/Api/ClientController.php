<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\ClientResource;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/clients",
     *      operationId="Affiche Clients",
     *      tags={"Affiche Clients"},

     *      summary="Affiche la liste des Clients",
     *      description="Retourner Touts les Clients",
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
        $clients = Client::paginate(10);
        if ($clients->isEmpty()) {
            return response()->json([
                "message" => "Aucun Client n'est pas trouve"
            ], 200);
        }
        return ClientResource::collection($clients);
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
     *      path="/clients",
     *      operationId="Store Client",
     *      tags={"Ajouter Client"},

     *      summary="Ajoute Client",
     *      description="Ajouter  Client et Retourne les Valeurs Ajouter",
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
    public function store(StoreClientRequest $request)
    {
        try {
            $client = Client::create($request->all());
            return new ClientResource($client);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Creation de Client a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/clients/{client}",
     *      operationId="Show Client",
     *      tags={"Affiche Client par ID"},
     *      summary="Affiche le Client par ID",
     *      description="Retourner le Client",
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
    public function show(Client $client)
    {
        return new ClientResource($client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\PUT(
     *      path="/clients/{client}",
     *      operationId="Modifier Client",
     *      tags={"Mise en Jour Client"},

     *      summary="Modifier Client",
     *      description="Retourner Client Modifier",
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
    public function update(UpdateClientRequest $request, Client $client)
    {
        try {
            $client->update($request->all());
            return new ClientResource($client);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Modification de Client a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/clients/{client}",
     *      operationId="Delete Client",
     *      tags={"Supprimer Client"},

     *      summary="Supprimer un Client",
     *      description="Supprimer un Client",
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
    public function destroy(Client $client)
    {
        try {
            $client->delete();
            return response()->json([
                'status' => true,
                'message' => 'Ce Client est supprimer avec success',
            ], 204);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Suppression de Client a eu un Probleme"
            ], 500);
        }
    }
}
