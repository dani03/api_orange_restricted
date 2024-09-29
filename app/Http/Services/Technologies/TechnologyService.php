<?php

namespace App\Http\Services\Technologies;

use App\Http\Repositories\Technologies\TechnologyRepository;
use Illuminate\Support\Collection;

class TechnologyService
{
    public function __construct(private TechnologyRepository $technologyRepository)
    {
    }

    public function getTechnologies(array $names): Collection {
        $technos = [];
        foreach($names as $name) {
        $technology = $this->technologyRepository->findTechnologyByName($name);
            if($technology) {
                $technos[] = $technology;
            }

        }
        return collect($technos);
    }

    public function getTechnologiesIds(array $names) {
        $technos = [];
        foreach($names as $name) {
            $technologyId = $this->technologyRepository->getTechnologiesIds($name);
            if($technologyId) {
                $technos[] = $technologyId;
            }

        }
        return $technos;
    }


}
