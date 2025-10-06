@extends('layouts.app')

@section('title', 'Tabel Data Monitoring')

@push('styles')
<link href="https://cdn.tailwindcss.com" rel="stylesheet">
<style>
    .sticky-header {
        position: sticky;
        top: 0;
        background-color: #f8fafc;
        z-index: 10;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold text-gray-800">Data Monitoring Arsitektur</h1>
        <button id="refreshAll" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 flex items-center gap-2">
            <i class="fas fa-sync-alt"></i> Refresh All
        </button>
    </div>

    <div class="card">
        <div class="card-body overflow-x-auto">
            <table class="min-w-full border border-gray-200 table-fixed">
                <thead>
                    <tr class="bg-blue-50">
                        <th rowspan="2" class="sticky-header border px-4 py-2 text-left bg-blue-50 min-w-[200px]">
                            Instansi
                        </th>
                        <th colspan="6" class="sticky-header border px-4 py-2 text-center bg-blue-50">
                            Arsitektur As-Is
                        </th>
                        <th colspan="6" class="sticky-header border px-4 py-2 text-center bg-blue-50">
                            Arsitektur To-Be
                        </th>
                        <th rowspan="2" class="sticky-header border px-4 py-2 text-center bg-blue-50">
                            Peta Rencana
                        </th>
                        <th rowspan="2" class="sticky-header border px-4 py-2 text-center bg-blue-50">
                            Clearance
                        </th>
                        <th rowspan="2" class="sticky-header border px-4 py-2 text-center bg-blue-50">
                            Reviu dan Evaluasi
                        </th>
                        <th rowspan="2" class="sticky-header border px-4 py-2 text-center bg-blue-50">
                            Tingkat Kematangan
                        </th>
                        <th rowspan="2" class="sticky-header border px-4 py-2 text-center bg-blue-50 w-[100px]">
                            Aksi
                        </th>
                    </tr>
                    <tr class="bg-blue-50">
                        <!-- As-Is Subheaders -->
                        <th class="sticky-header border px-2 py-2 text-center text-sm">Proses Bisnis</th>
                        <th class="sticky-header border px-2 py-2 text-center text-sm">Layanan</th>
                        <th class="sticky-header border px-2 py-2 text-center text-sm">Data dan Informasi</th>
                        <th class="sticky-header border px-2 py-2 text-center text-sm">Aplikasi</th>
                        <th class="sticky-header border px-2 py-2 text-center text-sm">Infrastruktur</th>
                        <th class="sticky-header border px-2 py-2 text-center text-sm">Keamanan</th>

                        <!-- To-Be Subheaders -->
                        <th class="sticky-header border px-2 py-2 text-center text-sm">Proses Bisnis</th>
                        <th class="sticky-header border px-2 py-2 text-center text-sm">Layanan</th>
                        <th class="sticky-header border px-2 py-2 text-center text-sm">Data dan Informasi</th>
                        <th class="sticky-header border px-2 py-2 text-center text-sm">Aplikasi</th>
                        <th class="sticky-header border px-2 py-2 text-center text-sm">Infrastruktur</th>
                        <th class="sticky-header border px-2 py-2 text-center text-sm">Keamanan</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Kementerian A -->
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">Kementerian A</td>
                        <!-- As-Is Data -->
                        <td class="border px-4 py-2 text-center">10</td>
                        <td class="border px-4 py-2 text-center">12</td>
                        <td class="border px-4 py-2 text-center">25</td>
                        <td class="border px-4 py-2 text-center">3</td>
                        <td class="border px-4 py-2 text-center">4</td>
                        <td class="border px-4 py-2 text-center">2</td>
                        <!-- To-Be Data -->
                        <td class="border px-4 py-2 text-center">3</td>
                        <td class="border px-4 py-2 text-center">0</td>
                        <td class="border px-4 py-2 text-center">0</td>
                        <td class="border px-4 py-2 text-center">2</td>
                        <td class="border px-4 py-2 text-center">0</td>
                        <td class="border px-4 py-2 text-center">0</td>
                        <!-- Additional Columns -->
                        <td class="border px-4 py-2 text-center">5</td>
                        <td class="border px-4 py-2 text-center">Approved</td>
                        <td class="border px-4 py-2 text-center">Completed</td>
                        <td class="border px-4 py-2 text-center">3.5</td>
                        <td class="border px-4 py-2 text-center">
                            <button class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-sm">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Kementerian B -->
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">Kementerian B</td>
                        <!-- As-Is Data -->
                        <td class="border px-4 py-2 text-center">8</td>
                        <td class="border px-4 py-2 text-center">15</td>
                        <td class="border px-4 py-2 text-center">20</td>
                        <td class="border px-4 py-2 text-center">5</td>
                        <td class="border px-4 py-2 text-center">3</td>
                        <td class="border px-4 py-2 text-center">1</td>
                        <!-- To-Be Data -->
                        <td class="border px-4 py-2 text-center">2</td>
                        <td class="border px-4 py-2 text-center">1</td>
                        <td class="border px-4 py-2 text-center">0</td>
                        <td class="border px-4 py-2 text-center">3</td>
                        <td class="border px-4 py-2 text-center">1</td>
                        <td class="border px-4 py-2 text-center">0</td>
                        <!-- Additional Columns -->
                        <td class="border px-4 py-2 text-center">3</td>
                        <td class="border px-4 py-2 text-center">In Review</td>
                        <td class="border px-4 py-2 text-center">In Progress</td>
                        <td class="border px-4 py-2 text-center">2.8</td>
                        <td class="border px-4 py-2 text-center">
                            <button class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-sm">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
function updateRow(row, data) {
    const cells = row.querySelectorAll('td');
    cells[1].textContent = data.as_is_proses_bisnis;
    cells[2].textContent = data.as_is_layanan;
    cells[3].textContent = data.as_is_data_informasi;
    cells[4].textContent = data.as_is_aplikasi;
    cells[5].textContent = data.as_is_infrastruktur;
    cells[6].textContent = data.as_is_keamanan;
    cells[7].textContent = data.to_be_proses_bisnis;
    cells[8].textContent = data.to_be_layanan;
    cells[9].textContent = data.to_be_data_informasi;
    cells[10].textContent = data.to_be_aplikasi;
    cells[11].textContent = data.to_be_infrastruktur;
    cells[12].textContent = data.to_be_keamanan;
    cells[13].textContent = data.peta_rencana;
    
    // Update status badges
    const clearanceSpan = cells[14].querySelector('span');
    clearanceSpan.textContent = data.clearance;
    clearanceSpan.className = `px-2 py-1 rounded text-sm ${getClearanceClass(data.clearance)}`;
    
    const reviuSpan = cells[15].querySelector('span');
    reviuSpan.textContent = data.reviu_evaluasi;
    reviuSpan.className = `px-2 py-1 rounded text-sm ${getReviuClass(data.reviu_evaluasi)}`;
    
    cells[16].textContent = Number(data.tingkat_kematangan).toFixed(1);
}

function getClearanceClass(status) {
    switch(status) {
        case 'Approved': return 'bg-green-100 text-green-800';
        case 'In Review': return 'bg-yellow-100 text-yellow-800';
        case 'Rejected': return 'bg-red-100 text-red-800';
        default: return 'bg-gray-100 text-gray-800';
    }
}

function getReviuClass(status) {
    switch(status) {
        case 'Completed': return 'bg-green-100 text-green-800';
        case 'In Progress': return 'bg-blue-100 text-blue-800';
        default: return 'bg-gray-100 text-gray-800';
    }
}

document.getElementById('refreshAll').addEventListener('click', async function() {
    try {
        const response = await fetch('{{ route("arsitektur.refreshAll") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });
        
        const result = await response.json();
        if (result.success) {
            location.reload(); // Refresh the page to show updated data
        } else {
            alert('Error refreshing data: ' + result.message);
        }
    } catch (error) {
        alert('Error refreshing data: ' + error.message);
    }
});

document.querySelectorAll('.refresh-row').forEach(button => {
    button.addEventListener('click', async function() {
        const row = this.closest('tr');
        const id = row.dataset.id;
        
        try {
            const response = await fetch(`{{ url('arsitektur/refresh-row') }}/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });
            
            const result = await response.json();
            if (result.success) {
                updateRow(row, result.data);
            } else {
                alert('Error refreshing row: ' + result.message);
            }
        } catch (error) {
            alert('Error refreshing row: ' + error.message);
        }
    });
});
</script>
@endpush
@endsection
