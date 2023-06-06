<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\RequestResource;
use App\Models\Pricing;
use Illuminate\Http\Request;
use App\Models\Request as req;
use Illuminate\Support\Facades\Validator;

class RequestController extends BaseController
{

    public function index()
    {
        $request = req::all();

        return $this->sendResponse(RequestResource::collection($request), 'Price retrieved successfully.');
    }

    public function store(Request $request)
    {

        $input = $request->all();

        $validator = Validator::make($input, [
            'fname' => 'required|string',
            'email' => 'required|email',
            'phoneNumer' => 'required|string',
            'company_name' => 'required|string',
            'pricing_id' => 'exists:pricings,id'
        ]);


        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $req = new req();
        $req->fname = $request->fname;
        $req->email = $request->email;
        $req->phoneNumer = $request->phoneNumer;
        $req->company_name = $request->company_name;
        $req->pricing_id = $request->pricing_id;
        $req->save();

        return $this->sendResponse(new RequestResource($req), 'Request updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $req = req::find($id);
        if (!$req) {
            return response()->json(["Not found"]);
        }
        $req->destroy($id);

        return $this->sendResponse([], 'Request deleted successfully.');
    }
}
