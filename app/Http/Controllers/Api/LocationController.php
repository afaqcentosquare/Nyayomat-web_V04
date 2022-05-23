<?php

namespace App\Http\Controllers\Api;

use App\Location;
use App\City;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;

class LocationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::select('id','region','name')->whereNull('deleted_at')->get();
        // return LocationResource::collection($locations);
        return $locations;
    }
    
    public static function locationListing()
    {
        $locationListing = City::select(['id', 'name'])->orderBy('name', 'asc')
        ->with(['regions' => function ($q) {
            $q->select(['id', 'name', 'city'])->orderBy('name', 'asc');
        }, 'regions.locations' => function ($q) {
            $q->select(['id', 'name', 'region']);
        }])->get();
        return $locationListing;
    }


}
