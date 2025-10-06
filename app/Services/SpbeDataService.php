<?php

namespace App\Services;

class SpbeDataService
{
    public function getNationalData()
    {
        return [
            'average_spbe_index' => 2.99,
            'good_province_count' => 15,
            'total_ict_budget' => 516000000000, // 516 M
            'trend' => [
                '2021' => 2.75,
                '2022' => 2.92,
                '2023' => 3.08,
                '2024' => 3.24,
                '2025' => 3.40
            ]
        ];
    }

    public function getProvinceData()
    {
        return [
            'DKI Jakarta' => ['spbe_index' => 3.85],
            'Jawa Barat' => ['spbe_index' => 3.70],
            'Jawa Timur' => ['spbe_index' => 3.65],
            'DI Yogyakarta' => ['spbe_index' => 3.60],
            'Bali' => ['spbe_index' => 3.55],
            'Jawa Tengah' => ['spbe_index' => 3.45],
            'Sumatera Barat' => ['spbe_index' => 3.35],
            'Kepulauan Riau' => ['spbe_index' => 3.25],
            'Kalimantan Timur' => ['spbe_index' => 2.95],
            'Sulawesi Selatan' => ['spbe_index' => 2.85],
            // Tambahkan provinsi lainnya...
        ];
    }

    public function getProvinceDetails($province)
    {
        return [
            'province_data' => [
                'spbe_index' => 3.75,
                'architecture_implementation' => 4.2,
                'ict_budget_approved_percentage' => 85,
                'serabi_score' => 4.1,
                'architecture_domains' => [
                    'business_process' => 4.2,
                    'services' => 4.0,
                    'data' => 3.8,
                    'application' => 4.1,
                    'infrastructure' => 4.3,
                    'security' => 3.9
                ],
                'budget_status' => [
                    'approved' => 250000000,
                    'rejected' => 50000000
                ]
            ],
            'cities' => [
                [
                    'name' => 'Kota A',
                    'spbe_index' => 3.8,
                    'architecture_implementation' => 4.0,
                    'ict_budget' => 150000000,
                    'serabi_score' => 4.2
                ],
                [
                    'name' => 'Kota B',
                    'spbe_index' => 3.6,
                    'architecture_implementation' => 3.8,
                    'ict_budget' => 120000000,
                    'serabi_score' => 3.9
                ],
                // Add more cities as needed
            ]
        ];
    }

    public function getDummyNationalData()
    {
        return [
            'provinces' => [
                'DKI Jakarta' => [
                    'spbe_index' => 3.85,
                    'architecture_implementation' => 4.5,
                    'ict_budget' => 500000000,
                    'serabi_score' => 4.3
                ],
                'Jawa Barat' => [
                    'spbe_index' => 3.70,
                    'architecture_implementation' => 4.2,
                    'ict_budget' => 450000000,
                    'serabi_score' => 4.1
                ],
                'Jawa Timur' => [
                    'spbe_index' => 3.65,
                    'architecture_implementation' => 4.0,
                    'ict_budget' => 400000000,
                    'serabi_score' => 4.0
                ],
                // Add more provinces with realistic data
            ]
        ];
    }
}
