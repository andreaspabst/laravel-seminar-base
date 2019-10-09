<?php

namespace App\Http\Controllers;

use App\Exceptions\TooLessMoneyForBuyingAHouseException;
use App\House;
use App\Http\Requests\House\HouseStoreRequest;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return House::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HouseStoreRequest $request)
    {
        $house = new House($request->all());
        $house->city_id = $request->city_id;

        return $house->save() ? response()->json(['created' => true],201) : response()->json(["error" => "true"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, House $house)
    {
        $money = $request->query('money',0);
        if ($money < $house->price) {
            throw new TooLessMoneyForBuyingAHouseException();
        }
        return $house;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
