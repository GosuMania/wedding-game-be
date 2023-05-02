<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Resources\User\User as UserResource;

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
        return UserResource::collection(User::orderBy('punteggio', 'ASC')->orderBy('date', 'ASC')->get());
    }

    public function signInOrSignUp(Request $request)
    {
        $user = User::where(DB::raw('lower(nome)'), strtolower($request->nome))
            ->where(DB::raw('lower(cognome)'), strtolower($request->cognome))
            ->where(DB::raw('lower(nome_utente)'), strtolower($request->nomeUtente))
            ->first();
        if ($user != null) {
            $mission = Mission::updateOrCreate(
                ['id' => $user->id],
                [
                    'id_utente' => $user['id'],
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
            $user['mission'] = $mission;
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
            $mission = Mission::where('id_utente', $user['id'])->first();
            if(!$mission) {
                $mission = Mission::updateOrCreate(
                    ['id' => $user->id],
                    [
                        'id_utente' => $user['id'],
                        'parola_cruciverba' => $request->mission['parolaCruciverba'],
                        'selfie_sposa' => $request->mission['selfieSposa'],
                        'selfie_sposo' => $request->mission['selfieSposo'],
                        'brindisi' => $request->mission['brindisi'],
                        'video_brindisi' => $request->mission['videoBrindisi'],
                        'parola_jenga' => $request->mission['parolaJenga'],
                        'indovinello' => $request->mission['indovinello'],
                        'punteggio' => $request->mission['punteggio'],
                        'date' => Carbon::now()
                    ]
                );
            }
            $user['mission'] = $mission;
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
