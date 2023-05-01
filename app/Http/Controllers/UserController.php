<?php

namespace App\Http\Controllers;

use App\Resources\User\User as UserResource;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function getAll()
    {
        return UserResource::collection(User::orderBy('punteggio', 'ASC')->orderBy('date', 'ASC')->get());
    }

    public function signInOrSignUp(Request $request)
    {
        $user = User::
        whereRaw('LOWER(nome)', $request->nome)
            ->whereRaw('LOWER(cognome)', $request->cognome)
                ->whereRaw('LOWER(nome_utente)', $request->nomeUtente)
                    ->first();
        if ($user != null) {
            return response()->json(['data' => new UserResource($user)], 200);
        } else {
            $user = User::updateOrCreate(
                ['id' => $request->id],
                [
                    'nome' => $request->nome,
                    'cognome' => $request->cognome,
                    'nome_utente' => $request->nomeUtente,
                    'punteggio' => $request->punteggio,
                    'date' => Carbon::now(),
                ]
            );
            return response()->json(['data' => new UserResource($user)], 200);
        }
    }

    public function getById($id)
    {
        return new UserResource(User::findOrFail($id));
    }

    public function delete($id)
    {
        $customer = User::where('id', $id)->first();
        return $customer->delete();
    }
}
