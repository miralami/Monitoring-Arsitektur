@extends('layouts.app')

@section('title', 'Dashboard SPBE')

@section('content')
<div class="container-fluid px-4">
    <!-- KPI Cards Row -->
    <div class="row g-4 mb-4">
        <!-- National SPBE Index -->
        <div class="col-xl-4">
            <div class="card h-100 border-left-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Rata-rata Indeks SPBE Nasional</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">{{ number_format($nationalData['average_spbe_index'], 2) }}
                                <span class="text-success small ml-2">
                                    <i class="fas fa-arrow-up"></i>
                                    +{{ number_format($nationalData['average_spbe_index'] - $nationalData['trend'][2024], 2) }}
                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Provinces with Good Index -->
        <div class="col-xl-4">
            <div class="card h-100 border-left-success">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Provinsi dengan Indeks "Baik"</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $nationalData['good_province_count'] }}
                                <span class="text-success small ml-2">
                                    <i class="fas fa-arrow-up"></i>
                                    Dari {{ count($provinceData) }} Provinsi
                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total National ICT Budget -->
        <div class="col-xl-4">
            <div class="card h-100 border-left-info">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Anggaran TIK Nasional</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($nationalData['total_ict_budget'] / 1000000, 1) }} M</div>
                            <div class="small text-muted">dalam Ribu Rupiah</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map and Trends Row -->
    <div class="row mb-4">
        <!-- Indonesia Choropleth Map -->
        <div class="col-xl-8">
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Peta Indeks SPBE Indonesia</h6>
                </div>
                <div class="card-body">
                    <div id="indonesia-map" style="height: 400px;"></div>
                </div>
            </div>
        </div>

        <!-- National SPBE Index Trend -->
        <div class="col-xl-4">
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Tren Indeks SPBE Nasional</h6>
                </div>
                <div class="card-body">
                    <div id="trend-chart" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Performance Comparison Row -->
    <div class="row">
        <!-- Top 5 Provinces -->
        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-success">Top 5 Provinsi</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="topProvinceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom 5 Provinces -->
        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-danger">Bottom 5 Provinsi</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="bottomProvinceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
<script>
    // Initialize charts when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Indonesia Map Configuration
        const mapChart = echarts.init(document.getElementById('indonesia-map'));
        const mapOption = {
            tooltip: {
                trigger: 'item',
                formatter: '{b}<br/>Indeks SPBE: {c}'
            },
            visualMap: {
                min: 1.0,
                max: 4.0,
                text: ['Tinggi', 'Rendah'],
                realtime: false,
                calculable: true,
                inRange: {
                    color: ['#e74a3b', '#f6c23e', '#1cc88a']
                }
            },
            series: [{
                name: 'Indeks SPBE Indonesia',
                type: 'map',
                map: 'Indonesia',
                selectedMode: 'single',
                itemStyle: {
                    normal: {
                        borderColor: '#fff',
                        areaColor: '#eee',
                    },
                    emphasis: {
                        areaColor: '#4e73df',
                        label: {
                            show: true
                        }
                    }
                },
                data: {!! json_encode(collect($provinceData)->map(function($data, $province) {
                    return [
                        'name' => $province,
                        'value' => $data['spbe_index']
                    ];
                })->values()) !!}
            }]
        };
        mapChart.setOption(mapOption);

        // Add click event to navigate to province detail
        mapChart.on('click', function(params) {
            if (params.name) {
                window.location.href = `/dashboard/province/${params.name.toLowerCase().replace(/ /g, '-')}`;
            }
        });

        // Trend Chart Configuration
        const trendChart = echarts.init(document.getElementById('trend-chart'));
        const trendOption = {
            tooltip: {
                trigger: 'axis'
            },
            xAxis: {
                type: 'category',
                data: Object.keys({{ json_encode($nationalData['trend']) }})
            },
            yAxis: {
                type: 'value',
                min: 1,
                max: 4
            },
            series: [{
                data: Object.values({{ json_encode($nationalData['trend']) }}),
                type: 'line',
                smooth: true,
                lineStyle: {
                    color: '#4e73df',
                    width: 3
                },
                itemStyle: {
                    color: '#4e73df'
                }
            }]
        };
        trendChart.setOption(trendOption);

        // Get top and bottom 5 provinces
        const provinceData = {!! json_encode($provinceData) !!};
        const sortedProvinces = Object.entries(provinceData)
            .sort((a, b) => b[1].spbe_index - a[1].spbe_index);

        const top5 = sortedProvinces.slice(0, 5);
        const bottom5 = sortedProvinces.slice(-5).reverse();

        // Top 5 Provinces Chart
        const topCtx = document.getElementById('topProvinceChart');
        new Chart(topCtx, {
            type: 'horizontalBar',
            data: {
                labels: top5.map(p => p[0]),
                datasets: [{
                    label: 'Indeks SPBE',
                    data: top5.map(p => p[1].spbe_index),
                    backgroundColor: '#1cc88a'
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            max: 4
                        }
                    }]
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Bottom 5 Provinces Chart
        const bottomCtx = document.getElementById('bottomProvinceChart');
        new Chart(bottomCtx, {
            type: 'horizontalBar',
            data: {
                labels: bottom5.map(p => p[0]),
                datasets: [{
                    label: 'Indeks SPBE',
                    data: bottom5.map(p => p[1].spbe_index),
                    backgroundColor: '#e74a3b'
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            max: 4
                        }
                    }]
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
</script>
@endpush
@endsection
