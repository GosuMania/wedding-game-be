<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Http\Controllers\Controller;
use App\Resources\Mission\Mission as MissionResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use stdClass;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

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
        $object = Mission::updateOrCreate(
            ['id' => $request->id],
            [
                'id_utente' => $request->idUtente,
                'parola_cruciverba' => $request->parolaCruciverba,
                'selfie_sposa' => $request->selfieSposa,
                'selfie_sposo'=> $request->selfieSposo,
                'brindisi' => $request->brindisi,
                'video_brindisi' => $request->videoBrindisi,
                'parola_jenga' => $request->parolaJenga,
                'indovinello' => $request->indovinello,
                'punteggio' => $request->punteggio,
                'date' => Carbon::now()
            ]
        );

        return response()->json(['data' => new MissionResource($object)], 200);
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
