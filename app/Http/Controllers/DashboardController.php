<?php

namespace App\Http\Controllers;

use App\Services\SpbeDataService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $spbeService;

    public function __construct(SpbeDataService $spbeService)
    {
        $this->spbeService = $spbeService;
    }

    public function index()
    {
        $nationalData = $this->spbeService->getNationalData();
        $provinceData = $this->spbeService->getProvinceData();

        return view('dashboard.index', compact('nationalData', 'provinceData'));
    }

    public function province($province)
    {
        $data = $this->spbeService->getProvinceDetails($province);
        return view('dashboard.province', [
            'province' => $province,
            'provinceData' => $data['province_data'],
            'cityData' => $data['cities']
        ]);
    }

    public function tables()
    {
        $data = $this->spbeService->getDummyNationalData();
        return view('dashboard.tables', [
            'provinces' => collect($data['provinces'])->map(function($data, $province) {
                return [
                    'name' => $province,
                    'spbe_index' => $data['spbe_index'],
                    'architecture_implementation' => $data['architecture_implementation'],
                    'ict_budget' => $data['ict_budget'],
                    'serabi_score' => $data['serabi_score']
                ];
            })
        ]);
    }
}
