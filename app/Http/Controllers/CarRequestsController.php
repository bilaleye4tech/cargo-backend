<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\EditRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\ViewRequest;
use App\Models\CarRequests;
use Illuminate\Http\Request;

class CarRequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function allRequests()
    {
        $Request = CarRequests::all();

        return Helpers::successResponse('All Requests', $Request);
    }

    public function createRequest(CreateRequest $request)
    {
        $Request = CarRequests::create($request->all());

        return Helpers::successResponse('Request Created Successfully', $Request);
    }

    public function updateRequest(EditRequest $request)
    {
        $data = CarRequests::find($request->input('id'))->update($request->all());

        return Helpers::successResponse('Request Updated Successfully', $data);
    }

    public function viewRequest(ViewRequest $request)
    {
        $Request = CarRequests::find($request->input('id'));

        return Helpers::successResponse('Single Request', $Request);
    }

    public function deleteRequest(DeleteRequest $request)
    {
        $Request = CarRequests::find($request->input('id'))->delete();

        return Helpers::successResponse('Request Deleted Successfully', $Request);
    }

    public function searchRequests(SearchRequest $request)
    {
        $request = CarRequests::where('departure', $request->input('departure'))->where('destination', $request->input('destination'))->where('start_date', $request->input('start_date'))->first();

        return Helpers::successResponse('Requests', $request);
    }
}
