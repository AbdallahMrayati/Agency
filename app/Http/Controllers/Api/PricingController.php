<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;

use App\Http\Resources\PricingResource;
use App\Models\Pricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PricingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("pricingsView");
        $pricing = Pricing::all();

        return $this->sendResponse(PricingResource::collection($pricing), 'Price retrieved successfully.');
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

        $this->authorize("pricingAdd");
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required',
            'period' => 'required',
            "price" => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $pricing = new Pricing();
        $pricing->title = $request->title;
        $pricing->description = $request->description;
        $pricing->period = $request->period;
        $pricing->price = $request->price;
        $pricing->save();

        return $this->sendResponse(new PricingResource($pricing), 'Pricing created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize("pricingShow");
        $pricing = Pricing::find($id);

        if (is_null($pricing)) {
            return $this->sendError('Pricing not found.');
        }

        return $this->sendResponse(new PricingResource($pricing), 'Pricing retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $this->authorize("pricingEdit");
        $price = Pricing::find($id);
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required',
            'period' => 'required',
            "price" => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $price->title = $request->title;
        $price->description = $request->description;
        $price->period = $request->period;
        $price->price = $request->price;
        $price->save();

        return $this->sendResponse(new PricingResource($price), 'Pricing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize("pricingDelete");
        $price = Pricing::find($id);
        if (!$price) {
            return response()->json(["Not found"]);
        }
        $price->delete();

        return $this->sendResponse([], 'Pricing deleted successfully.');
    }
}
