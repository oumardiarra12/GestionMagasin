<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ConnexionUserRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *      path="/utilisateurs",
     *      operationId="Affiche utilisateurs",
     *      tags={"Affiche utilisateurs"},

     *      summary="Affiche la liste des utilisateurs",
     *      description="Retourner Touts les utilisateurs",
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
        $users = User::paginate(10);
        if ($users->isEmpty()) {
            return response()->json([
                "message" => "Aucun Utilisateur n'est pas trouve"
            ], 200);
        }
        return UserResource::collection($users);
    }
    /**
     * @OA\Post(
     *      path="/utilisateurs",
     *      operationId="Store utilisateur",
     *      tags={"Ajouter utilisateur"},

     *      summary="Ajoute utilisateur",
     *      description="Ajouter  utilisateur et Retourne les Valeurs Ajouter",
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
    public function Store(StoreUserRequest $request)
    {
        try {
            $NomImage = time() . '.' . $request->image->getutilisateurOriginalExtension();
            $request->image->storeAs('public/images/Utilisateur', $NomImage);

            $user = User::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'image' => $NomImage,
                'password' => bcrypt($request->password)
            ]);
            return new UserResource($user);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Creation Utilisateur a eu un Probleme"
            ], 500);
        }
    }
    /**
     * @OA\Get(
     *      path="/utilisateurs/{utilisateur}",
     *      operationId="Show utilisateur",
     *      tags={"Affiche utilisateur par ID"},
     *      summary="Affiche le utilisateur par ID",
     *      description="Retourner le utilisateur",
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
    public function show(User $user)
    {
        return new UserResource($user);
    }
    /**
     * @OA\PUT(
     *      path="/utilisateurs/{utilisateur}",
     *      operationId="Modifier utilisateur",
     *      tags={"Mise en Jour utilisateur"},

     *      summary="Modifier utilisateur",
     *      description="Retourner utilisateur Modifier",
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
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $user->update($request->all());
            if ($request->hasFile('image')) {
                if ($user->image) {
                    $existeImage = Storage::exists("public/images/Utilisateur/{$user->image}");
                    if ($existeImage) {
                        Storage::delete("public/images/Utilisateur/" . $user->image);
                    }
                }
                $NomImage = time() . '.' . $request->image->getutilisateurOriginalExtension();
                $request->image->storeAs('public/images/Utilisateur', $NomImage);
                $user->image = $NomImage;
                $user->save();
            }
            return new UserResource($user);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Modification Utilisateur a eu un Probleme"
            ], 500);
        }
    }
    /**
     * @OA\Delete(
     *      path="/utilisateurs/{utilisateur}",
     *      operationId="Delete utilisateur",
     *      tags={"Supprimer utilisateur"},

     *      summary="Supprimer un utilisateur",
     *      description="Supprimer un utilisateur",
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
    public function destroy(User $user)
    {
        try {
            if ($user->image) {
                $existeImage = Storage::exists("public/images/Utilisateur/{$user->image}");
                if ($existeImage) {
                    Storage::delete("public/images/Utilisateur/" . $user->image);
                }
            }
            $user->delete();
            return response()->json([
                'status' => true,
                'message' => 'Cet Utilisateur est supprimer avec success',
            ], 204);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                "message" => "La Suppession Utilisateur a eu un Probleme"
            ], 500);
        }
    }
    /**
     * @OA\Post(
     *      path="/connexion",
     *      operationId="Connexion utilisateur",
     *      tags={"Connexion utilisateur"},

     *      summary="Connexion utilisateur",
     *      description="Connexion  utilisateur et Retourne les Valeurs Ajouter",
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
    public function connexion(ConnexionUserRequest $request)
    {
        $utilisateur = User::where("email", $request->email)->first();
        if (!$utilisateur) return response(["message" => "Aucun Utilisateur n'est trouve avec l'Email $request->email"], 401);
        if (Hash::check($request->email, $utilisateur->password)) {
            return response(["message" => "Aucun utilisateur de trouve avec le mot de passe"], 401);
        }
        $token = $utilisateur->createToken('CLE_SECRETE')->plainTextToken;
        return response([
            "utilisateur" => $utilisateur,
            "token" => $token
        ], 200);
    }
}
