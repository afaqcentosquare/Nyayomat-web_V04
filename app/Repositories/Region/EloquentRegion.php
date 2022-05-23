<?php

namespace App\Repositories\Region;

use App\Region;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentRegion extends EloquentRepository implements BaseRepository, RegionRepository
{
	protected $model;

	public function __construct(Region $region)
	{
		$this->model = $region;
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
        $region = parent::store($request);
        return $region;
    }

    public function update(Request $request, $id)
    {
        $region = parent::update($request, $id);

        
        return $region;
    }

	public function destroy($id)
	{
        $region = parent::findTrash($id);
        return $region->forceDelete();
	}
}