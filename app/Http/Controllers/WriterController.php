<?php

namespace App\Http\Controllers;

use App\Http\Resources\Writer\WriterCollection;
use App\Http\Resources\Writer\WriterResource;
use App\Models\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WriterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $writers = Writer::all();
        return response()->json([
            'writers' => new WriterCollection($writers)
        ]);
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:writers',
            'birth' => 'required|integer|between:1400,2000',
            'nationality' => 'required|string|in:Afghanistan,Albania,Algeria,Andorra,Angola,Antigua&Deps,Argentina,Armenia,Australia,Austria,Azerbaijan,Bahamas,Bahrain,Bangladesh,Barbados,Belarus,Belgium,Belize,Benin,Bhutan,Bolivia,BosniaHerzegovina,Botswana,Brazil,Brunei,Bulgaria,Burkina,Burundi,Cambodia,Cameroon,Canada,CapeVerde,CentralAfricanRep,Chad,Chile,China,Colombia,Comoros,Congo,Congo{DemocraticRep},CostaRica,Croatia,Cuba,Cyprus,CzechRepublic,Denmark,Djibouti,Dominica,DominicanRepublic,EastTimor,Ecuador,Egypt,ElSalvador,EquatorialGuinea,Eritrea,Estonia,Ethiopia,Fiji,Finland,France,Gabon,Gambia,Georgia,Germany,Ghana,Greece,Grenada,Guatemala,Guinea,Guinea-Bissau,Guyana,Haiti,Honduras,Hungary,Iceland,India,Indonesia,Iran,Iraq,Ireland{Republic},Israel,Italy,IvoryCoast,Jamaica,Japan,Jordan,Kazakhstan,Kenya,Kiribati,KoreaNorth,KoreaSouth,Kosovo,Kuwait,Kyrgyzstan,Laos,Latvia,Lebanon,Lesotho,Liberia,Libya,Liechtenstein,Lithuania,Luxembourg,Macedonia,Madagascar,Malawi,Malaysia,Maldives,Mali,Malta,MarshallIslands,Mauritania,Mauritius,Mexico,Micronesia,Moldova,Monaco,Mongolia,Montenegro,Morocco,Mozambique,Myanmar,{Burma},Namibia,Nauru,Nepal,Netherlands,NewZealand,Nicaragua,Niger,Nigeria,Norway,Oman,Pakistan,Palau,Panama,PapuaNewGuinea,Paraguay,Peru,Philippines,Poland,Portugal,Qatar,Romania,RussianFederation,Rwanda,StKitts&Nevis,StLucia,SaintVincent&theGrenadines,Samoa,SanMarino,SaoTome&Principe,SaudiArabia,Senegal,Serbia,Seychelles,SierraLeone,Singapore,Slovakia,Slovenia,SolomonIslands,Somalia,SouthAfrica,SouthSudan,Spain,SriLanka,Sudan,Suriname,Swaziland,Sweden,Switzerland,Syria,Taiwan,Tajikistan,Tanzania,Thailand,Togo,Tonga,Trinidad&Tobago,Tunisia,Turkey,Turkmenistan,Tuvalu,Uganda,Ukraine,UnitedArabEmirates,UnitedKingdom,UnitedStates,Uruguay,Uzbekistan,Vanuatu,VaticanCity,Venezuela,Vietnam,Yemen,Zambia,Zimbabwe'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $writer = Writer::create([
            'name' => $request->name,
            'birth' => $request->birth,
            'nationality' => $request->nationality,
        ]);

        return response()->json([
            'message' => 'Writer inserted',
            'writer' => new WriterResource($writer)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Writer  $writer
     * @return \Illuminate\Http\Response
     */
    public function show($writer_id)
    {
        $writer = Writer::find($writer_id);
        if (is_null($writer)) {
            return response()->json('Writer not found', 404);
        }
        return response()->json([
            'writer' => new WriterResource($writer)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Writer  $writer
     * @return \Illuminate\Http\Response
     */
    public function edit(Writer $writer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Writer  $writer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Writer $writer)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'birth' => 'required|integer|between:1400,2000',
            'nationality' => 'required|integer|in:Afghanistan,Albania,Algeria,Andorra,Angola,Antigua&Deps,Argentina,Armenia,Australia,Austria,Azerbaijan,Bahamas,Bahrain,Bangladesh,Barbados,Belarus,Belgium,Belize,Benin,Bhutan,Bolivia,BosniaHerzegovina,Botswana,Brazil,Brunei,Bulgaria,Burkina,Burundi,Cambodia,Cameroon,Canada,CapeVerde,CentralAfricanRep,Chad,Chile,China,Colombia,Comoros,Congo,Congo{DemocraticRep},CostaRica,Croatia,Cuba,Cyprus,CzechRepublic,Denmark,Djibouti,Dominica,DominicanRepublic,EastTimor,Ecuador,Egypt,ElSalvador,EquatorialGuinea,Eritrea,Estonia,Ethiopia,Fiji,Finland,France,Gabon,Gambia,Georgia,Germany,Ghana,Greece,Grenada,Guatemala,Guinea,Guinea-Bissau,Guyana,Haiti,Honduras,Hungary,Iceland,India,Indonesia,Iran,Iraq,Ireland{Republic},Israel,Italy,IvoryCoast,Jamaica,Japan,Jordan,Kazakhstan,Kenya,Kiribati,KoreaNorth,KoreaSouth,Kosovo,Kuwait,Kyrgyzstan,Laos,Latvia,Lebanon,Lesotho,Liberia,Libya,Liechtenstein,Lithuania,Luxembourg,Macedonia,Madagascar,Malawi,Malaysia,Maldives,Mali,Malta,MarshallIslands,Mauritania,Mauritius,Mexico,Micronesia,Moldova,Monaco,Mongolia,Montenegro,Morocco,Mozambique,Myanmar,{Burma},Namibia,Nauru,Nepal,Netherlands,NewZealand,Nicaragua,Niger,Nigeria,Norway,Oman,Pakistan,Palau,Panama,PapuaNewGuinea,Paraguay,Peru,Philippines,Poland,Portugal,Qatar,Romania,RussianFederation,Rwanda,StKitts&Nevis,StLucia,SaintVincent&theGrenadines,Samoa,SanMarino,SaoTome&Principe,SaudiArabia,Senegal,Serbia,Seychelles,SierraLeone,Singapore,Slovakia,Slovenia,SolomonIslands,Somalia,SouthAfrica,SouthSudan,Spain,SriLanka,Sudan,Suriname,Swaziland,Sweden,Switzerland,Syria,Taiwan,Tajikistan,Tanzania,Thailand,Togo,Tonga,Trinidad&Tobago,Tunisia,Turkey,Turkmenistan,Tuvalu,Uganda,Ukraine,UnitedArabEmirates,UnitedKingdom,UnitedStates,Uruguay,Uzbekistan,Vanuatu,VaticanCity,Venezuela,Vietnam,Yemen,Zambia,Zimbabwe'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $writer->name = $request->name;
        $writer->birth = $request->birth;
        $writer->nationality = $request->nationality;

        $writer->save();

        return response()->json([
            'message' => 'Writer updated',
            'writer' => new WriterResource($writer)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Writer  $writer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Writer $writer)
    {
        $writer->delete();

        return response()->json('Writer deleted');
    }
}
