<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use Illuminate\Support\Facades\Storage;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/articles",
     *      operationId="Affiche Article",
     *      tags={"Affiche Articles"},

     *      summary="Affiche la liste des articles",
     *      description="Retourner Touts les Articles",
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
        $articles = Article::paginate(10);
        if ($articles->isEmpty()) {
            return response()->json([
                "message" => "Aucun Article n'est pas trouve"
            ], 200);
        }
        return ArticleResource::collection($articles);
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
     *      path="/articles",
     *      operationId="Store Article",
     *      tags={"Ajouter Article"},

     *      summary="Ajoute   Article",
     *      description="Ajouter  Article et Retourne les Valeurs Ajouter",
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
    public function store(StoreArticleRequest $request)
    {
        try {
            $NomImage = time() . '.' . $request->ImageArticle->getClientOriginalExtension();
            $request->ImageArticle->storeAs('public/images/article', $NomImage);
            $article = Article::create($request->post() + ["ImageArticle" => $NomImage]);
            return new ArticleResource($article);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Creation d'Article a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/articles/{article}",
     *      operationId="Show Article",
     *      tags={"Affiche Article par ID"},

     *      summary="Affiche l'Article par ID",
     *      description="Retourner l'Article",
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
    public function show(Article $article)
    {
        return new ArticleResource($article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\PUT(
     *      path="/articles/{article}",
     *      operationId="Modifier Article",
     *      tags={"Mise en Jour  Article"},

     *      summary="Modifier   Article",
     *      description="Retourner Article Modifier",
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
    public function update(UpdateArticleRequest $request, Article $article)
    {
        try {
            $article->update($request->post());
            if ($request->hasFile('ImageArticle')) {
                if ($article->ImageArticle) {
                    $existeImage = Storage::exists("public/images/article/{$article->ImageArticle}");
                    if ($existeImage) {
                        Storage::delete("public/images/article/" . $article->ImageArticle);
                    }
                }
                $NomImage = time() . '.' . $request->ImageArticle->getClientOriginalExtension();
                $request->ImageArticle->storeAs('public/images/article', $NomImage);
                $article->ImageArticle = $NomImage;
                $article->save();
            }
            return new ArticleResource($article);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Modification d'Article a eu un Probleme"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/articles/{article}",
     *      operationId="Delete Article",
     *      tags={"Supprimer Article"},

     *      summary="Supprimer une Article",
     *      description="Supprimer une Article",
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
    public function destroy(Article $article)
    {
        try {
            if ($article->ImageArticle) {
                $existeImage = Storage::exists("public/images/article/{$article->ImageArticle}");
                if ($existeImage) {
                    Storage::delete("public/images/article/" . $article->ImageArticle);
                }
            }
            $article->delete();
            return response()->json([
                'status' => true,
                'message' => 'Cet Article est supprimer avec success'
            ], 204);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Suppression d'Article a eu un Probleme"
            ], 500);
        }
    }
}
