<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Resources\User\User as UserResource;
use App\Resources\Mission\Mission as MissionResource;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DB;

class UserController extends Controller
{

    public function getAll()
    {
        return UserResource::collection(User::orderBy('punteggio', 'DESC')->orderBy('date', 'ASC')->get());
    }

    public function signInOrSignUp(Request $request)
    {
        $user = User::where(DB::raw('lower(nome)'), strtolower($request->nome))
            ->where(DB::raw('lower(cognome)'), strtolower($request->cognome))
            ->where(DB::raw('lower(nome_utente)'), strtolower($request->nomeUtente))
            ->first();
        if ($user != null) {
            return response()->json(['data' => new UserResource($user)], 200);
        } else {
            $missionNew = Mission::create(
                [
                    'parola_cruciverba' => null,
                    'selfie_sposa' => null,
                    'selfie_sposo' => null,
                    'brindisi' => false,
                    'video_brindisi' => null,
                    'parola_jenga' => null,
                    'indovinello' => null,
                    'punteggio' => 0,
                    'date' => Carbon::now()
                ]
            );
            $user = User::updateOrCreate(
                ['id' => $request->id],
                [
                    'nome' => $request->nome,
                    'cognome' => $request->cognome,
                    'nome_utente' => $request->nomeUtente,
                    'punteggio' => $request->punteggio,
                    'id_mission' => $missionNew['id'],
                    'date' => Carbon::now()
                ]
            );
            return response()->json(['data' => new UserResource($user)], 200);
        }
    }

    public function getById($id)
    {
        $user = User::where('id', $id)->first();
        return new UserResource($user);
    }

    public function delete($id)
    {
        $customer = User::where('id', $id)->first();
        return $customer->delete();
    }
}
