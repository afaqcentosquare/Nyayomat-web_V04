<?php namespace App\Http\Controllers\Admin;

use App\Common\Authorizable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Location\LocationRepository;
use App\Http\Requests\Validations\CreateLocationRequest;
use App\Http\Requests\Validations\UpdateLocationRequest;
use App\City;
use App\Region;
use App\Location;
use DB;

class LocationController extends Controller
{
    use Authorizable;

    private $model_name;

    private $location;
    private $blog;

    /**
     * construct
     */
    public function __construct(LocationRepository $location)
    {
        parent::__construct();
        $this->model_name = 'Location';
        $this->location = $location;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = $this->location->all();
        $trashes = $this->location->trashOnly();

        return view('admin.location.index', compact('cities','trashes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location = DB::table('in_region')->find("1");
        return view('admin.location._create',compact('location'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLocationRequest $request)
    {
        $this->location->store($request);

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = $this->location->find($id);
        return view('admin.location._edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationRequest $request, $id)
    {
        $this->location->update($request, $id);

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, $id)
    {
        $this->location->trash($id);

        return back()->with('success', trans('messages.trashed', ['model' => $this->model_name]));
    }

    /**
     * Restore the specified resource from soft delete.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $this->location->restore($id);

        return back()->with('success', trans('messages.restored', ['model' => $this->model_name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->location->destroy($id);

        return back()->with('success', trans('messages.deleted', ['model' => $this->model_name]));
    }


    public function showCounties()
    {
        $cities = City::paginate(10);
        return view('pages.backend.admin.county')->with('cities', $cities);
    }

    public function showSubCounties($city = null)
    {
        if($city == null){
            $regions = Region::paginate(10);
        }else{
            $regions = Region::where('city', $city)->paginate(10);
        }
        $cities = City::all();
        
        return view('pages.backend.admin.sub_county')->with('cities', $cities)->with('regions', $regions);
    }

    public function showLocations($region = null)
    {
        if($region == null){
            $locations = Location::select('in_location.*','in_region.name as region_name')->join('in_region','in_region.id','in_location.region')->paginate(10);
        }else{
            $locations = Location::select('in_location.*','in_region.name as region_name')->where('region', $region)->join('in_region','in_region.id','in_location.region')->paginate(10);
        }
        $regions = Region::all();
        
        return view('pages.backend.admin.locations')->with('locations', $locations)->with('regions', $regions);
    }

    public function createCounty(Request $request)
    {
        $request->validate([
            "county_name" => "required",
        ]);
        try{
            $city = new City();
            $city->name = $request->county_name;
            if($city->save()){
                return back()->withSuccess("County Created Successfully")->withInput();
            }else{
                return back()->withError("Something went wrong :(")->withInput();
            }
        }catch(Exception $ex){
            return back()->withError($ex->getMessage())->withInput();
        }
    }

    public function createSubCounty(Request $request)
    {
        $request->validate([
            "city" => "required",
            "sub_county_name" => "required",
        ]);
        try{
            $region = new Region();
            $region->city = $request->city;
            $region->name = $request->sub_county_name;
            if($region->save()){
                return back()->withSuccess("Sub County Created Successfully")->withInput();
            }else{
                return back()->withError("Something went wrong :(")->withInput();
            }
        }catch(Exception $ex){
            return back()->withError($ex->getMessage())->withInput();
        }
    }

    public function createLocation(Request $request)
    {
        $request->validate([
            "region" => "required",
            "location" => "required",
        ]);
        try{
            $location = new Location();
            $location->region = $request->region;
            $location->name = $request->location;
            if($location->save()){
                return back()->withSuccess("Location Created Successfully")->withInput();
            }else{
                return back()->withError("Something went wrong :(")->withInput();
            }
        }catch(Exception $ex){
            return back()->withError($ex->getMessage())->withInput();
        }
    }
}
