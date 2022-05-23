<?php

namespace App\Repositories\Location;

use App\Location;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentLocation extends EloquentRepository implements BaseRepository, LocationRepository
{
	protected $model;

	public function __construct(Location $location)
	{
		$this->model = $location;
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
        $location = parent::store($request);
        return $location;
    }

    public function update(Request $request, $id)
    {
        $location = parent::update($request, $id);

        
        return $location;
    }

	public function destroy($id)
	{
        $location = parent::findTrash($id);
        return $location->forceDelete();
	}
}