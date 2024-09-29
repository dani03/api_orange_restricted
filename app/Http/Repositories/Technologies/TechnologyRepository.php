<?php

namespace App\Http\Repositories\Technologies;

use App\Models\Technology;
use Illuminate\Support\Collection;

class TechnologyRepository
{
    /**
     * @param string $name
     * @return Collection | null
     */
    public function findTechnologyByName(string $name) {
        return Technology::where('name', $name)->first();
    }

    public function getTechnologiesIds(string $name) {
        return Technology::where('name', $name)->pluck('id')->first();

    }

}
