<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Http\Controllers\Controller;
use App\Resources\Mission\Mission as MissionResource;
use App\Models\User ;
use Carbon\Carbon;
use Illuminate\Http\Request;
use stdClass;
use function Webmozart\Assert\Tests\StaticAnalysis\length;
use App\Resources\User\User as UserResource;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        return MissionResource::collection(Mission::orderBy('id', 'ASC')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdate(Request $request)
    {
        $points = $this->calcPoints($request);
        $mission = Mission::updateOrCreate(
            ['id' => $request->id],
            [
                'id_utente' => $request->idUtente,
                'parola_cruciverba' => $request->parolaCruciverba,
                'selfie_sposa' => $request->selfieSposa,
                'selfie_sposo' => $request->selfieSposo,
                'brindisi' => $request->brindisi,
                'video_brindisi' => $request->videoBrindisi,
                'parola_jenga' => $request->parolaJenga,
                'indovinello' => $request->indovinello,
                'punteggio' => $points,
                'date' => Carbon::now()
            ]
        );
        $user = User::where('id', $request->idUtente)->first()->update(['punteggio' => $points]);
        $user['mission'] = $mission;
        return response()->json(['data' => new UserResource($user)], 200);
    }

    public function calcPoints(Request $request) {
        $points = 0;
        if(strtolower($request->parolaCruciverba) == 'complicità' || 'complicita') {
            $points = $points + 20;
        }

        if($request->selfieSposa != null) {
            $points = $points + 25;
        }

        if($request->selfieSposo != null) {
            $points = $points + 25;
        }

        if($request->brindisi) {
            $points = $points + 30;
        }

        if(strtolower($request->parolaJenga) == 'divertimento') {
            $points = $points + 30;
        }

        if(strtolower($request->parolaJenga) == 'burraco' || strtolower($request->parolaJenga) == 'buracco') {
            $points = $points + 25;
        }

        return $points;
    }

    public function getByIdUser($id)
    {
        return new MissionResource(Mission::where('id_utente', $id));
    }

    public function delete($id)
    {
        $product = Mission::where('id', $id)->first();
        return $product->delete();
    }
}
