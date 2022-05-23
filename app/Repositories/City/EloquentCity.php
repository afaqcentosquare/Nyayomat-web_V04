<?php

namespace App\Repositories\City;

use App\City;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentCity extends EloquentRepository implements BaseRepository, CityRepository
{
	protected $model;

	public function __construct(City $city)
	{
		$this->model = $city;
	}

    public function all()
    {
        // return $this->model->published()->with('author','image')->orderBy('created_at', 'desc')->withCount('comments')->get();
        return $this->model->orderBy('created_at', 'desc')->get();
    }

    public function trashOnly()
    {
        return $this->model->orderBy('created_at', 'desc')->onlyTrashed()->get();
    }

    public function store(Request $request)
    {
        $city = parent::store($request);
        return $city;
    }

    public function update(Request $request, $id)
    {
        $city = parent::update($request, $id);

        
        return $city;
    }

	public function destroy($id)
	{
        $city = parent::findTrash($id);
        return $city->forceDelete();
	}
}