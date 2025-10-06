@extends('layouts.app')

@section('title', 'Detail Provinsi')

@section('content')
<div class="container-fluid px-4">
    <!-- Province Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Provinsi {{ $province ?? 'Nama Provinsi' }}</h1>
        <a href="{{ route('dashboard.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Dashboard Nasional
        </a>
    </div>

    <!-- Province Metrics Cards -->
    <div class="row g-4 mb-4">
        <!-- SPBE Index -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 border-left-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Indeks SPBE Provinsi</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">3.45</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Architecture Implementation -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 border-left-success">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Rata-rata Implementasi Arsitektur</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">4.2</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cube fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ICT Budget -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 border-left-info">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Persentase Anggaran TIK Disetujui</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">85%</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SERABI Survey -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 border-left-warning">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Rata-rata Nilai Survei SERABI</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">4.5</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Visualizations Row -->
    <div class="row mb-4">
        <!-- Architecture Implementation Status -->
        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Status Implementasi Arsitektur</h6>
                </div>
                <div class="card-body">
                    <div id="architecture-radar" style="height: 400px;"></div>
                </div>
            </div>
        </div>

        <!-- ICT Budget Clearance Status -->
        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Status Clearance Anggaran TIK</h6>
                </div>
                <div class="card-body">
                    <div id="budget-donut" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cities/Regencies Comparison Table -->
    <div class="card mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Perbandingan Kabupaten/Kota</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="citiesTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Kabupaten/Kota</th>
                            <th>Indeks SPBE</th>
                            <th>Anggaran TIK Disetujui (Rp)</th>
                            <th>Rata-rata Implementasi Arsitektur</th>
                            <th>Nilai Akhir Survei SERABI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample data - Replace with actual data -->
                        <tr>
                            <td>Kota A</td>
                            <td><span class="badge bg-success">3.5</span></td>
                            <td>15,000,000</td>
                            <td>4.2</td>
                            <td>4.5</td>
                        </tr>
                        <tr>
                            <td>Kabupaten B</td>
                            <td><span class="badge bg-warning">2.8</span></td>
                            <td>12,000,000</td>
                            <td>3.8</td>
                            <td>4.0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Architecture Radar Chart
        const radarChart = echarts.init(document.getElementById('architecture-radar'));
        const radarOption = {
            radar: {
                indicator: [
                    { name: 'Proses Bisnis', max: 5 },
                    { name: 'Layanan', max: 5 },
                    { name: 'Data', max: 5 },
                    { name: 'Aplikasi', max: 5 },
                    { name: 'Infrastruktur', max: 5 },
                    { name: 'Keamanan', max: 5 }
                ]
            },
            series: [{
                type: 'radar',
                data: [{
                    value: [4.2, 3.8, 4.0, 3.5, 4.5, 4.0],
                    name: 'Nilai Implementasi'
                }]
            }]
        };
        radarChart.setOption(radarOption);

        // Initialize Budget Donut Chart
        const donutChart = echarts.init(document.getElementById('budget-donut'));
        const donutOption = {
            tooltip: {
                trigger: 'item'
            },
            legend: {
                orient: 'vertical',
                left: 'left'
            },
            series: [{
                name: 'Anggaran TIK',
                type: 'pie',
                radius: ['40%', '70%'],
                avoidLabelOverlap: false,
                label: {
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: '20',
                        fontWeight: 'bold'
                    }
                },
                labelLine: {
                    show: false
                },
                data: [
                    { value: 85, name: 'Disetujui' },
                    { value: 15, name: 'Ditolak' }
                ]
            }]
        };
        donutChart.setOption(donutOption);

        // Initialize DataTables
        $('#citiesTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
            }
        });
    });
</script>
@endpush
@endsection
