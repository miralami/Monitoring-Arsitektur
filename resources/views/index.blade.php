<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tabel Instansi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <style>
        /* Override DataTables default styles with Tailwind CSS */
        .dataTables_wrapper .dataTables_length select {
            @apply px-4 py-2 border border-gray-300 rounded-lg;
        }
        .dataTables_wrapper .dataTables_filter input {
            @apply px-4 py-2 border border-gray-300 rounded-lg;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            @apply bg-blue-500 text-white px-3 py-1 rounded;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            @apply bg-blue-100;
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow mb-6">
        <div class="max-w-7xl mx-auto px-4 flex space-x-4">
            @foreach (['Kementerian','LPNK','LNS','InstansiLain','Provinsi','KabKota'] as $nav)
                <a href="{{ route('instansi.index', ['kategori' => $nav]) }}"
                   class="py-3 px-4 kategori-link {{ $kategori==$nav ? 'border-b-2 border-blue-600 font-semibold text-blue-600' : 'text-gray-600 hover:text-blue-600' }}"
                   data-kategori="{{ $nav }}">
                    {{ $nav == 'InstansiLain' ? 'Instansi Lain' : ($nav == 'KabKota' ? 'Kab/Kota' : $nav) }}
                </a>
            @endforeach
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4">
        <!-- Alert -->
        <div id="alert-box" class="hidden mb-4 p-3 rounded"></div>

        <!-- Refresh All -->
        <button id="refresh-all"
            class="mb-3 bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
            Refresh All Data
        </button>

        <!-- Table -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table id="instansi-table" class="min-w-full text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th rowspan="2" class="px-4 py-2">Instansi</th>
                        <th colspan="6" class="px-4 py-2 text-center">Arsitektur As-Is</th>
                        <th colspan="6" class="px-4 py-2 text-center">Arsitektur To-Be</th>
                        <th rowspan="2" class="px-4 py-2">Peta Rencana</th>
                        <th rowspan="2" class="px-4 py-2">Clearance</th>
                        <th rowspan="2" class="px-4 py-2">Reviu dan Evaluasi</th>
                        <th rowspan="2" class="px-4 py-2">Tingkat Kematangan</th>
                        <th rowspan="2" class="px-4 py-2">Aksi</th>
                    </tr>
                    <tr class="bg-gray-50">
                        <th>Proses Bisnis</th><th>Layanan</th><th>Data & Info</th>
                        <th>Aplikasi</th><th>Infra</th><th>Keamanan</th>
                        <th>Proses Bisnis</th><th>Layanan</th><th>Data & Info</th>
                        <th>Aplikasi</th><th>Infra</th><th>Keamanan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <script>
        let table;
        const alertBox = document.getElementById('alert-box');

        function showAlert(message, success = true) {
            alertBox.textContent = message;
            alertBox.className = success
                ? "mb-4 p-3 rounded bg-green-100 text-green-700"
                : "mb-4 p-3 rounded bg-red-100 text-red-700";
            alertBox.classList.remove("hidden");
            setTimeout(() => alertBox.classList.add("hidden"), 3000);
        }

        function initDataTable(kategori) {
            if (table) {
                table.destroy();
            }

            table = $('#instansi-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: '{{ route('instansi.data', ['kategori' => 'Kementerian']) }}',
                    data: function(d) {
                        d.kategori = kategori;
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    error: function(xhr, error, thrown) {
                        console.error('DataTables Ajax error:', error);
                        showAlert('Gagal memuat data: ' + error, false);
                    }
                },
                columns: [
                    { data: 'instansi', name: 'instansi' },
                    { data: 'proses_bisnis_as_is', name: 'proses_bisnis_as_is' },
                    { data: 'layanan_as_is', name: 'layanan_as_is' },
                    { data: 'data_info_as_is', name: 'data_info_as_is' },
                    { data: 'aplikasi_as_is', name: 'aplikasi_as_is' },
                    { data: 'infra_as_is', name: 'infra_as_is' },
                    { data: 'keamanan_as_is', name: 'keamanan_as_is' },
                    { data: 'proses_bisnis_to_be', name: 'proses_bisnis_to_be' },
                    { data: 'layanan_to_be', name: 'layanan_to_be' },
                    { data: 'data_info_to_be', name: 'data_info_to_be' },
                    { data: 'aplikasi_to_be', name: 'aplikasi_to_be' },
                    { data: 'infra_to_be', name: 'infra_to_be' },
                    { data: 'keamanan_to_be', name: 'keamanan_to_be' },
                    { data: 'peta_rencana_icon', name: 'peta_rencana' },
                    { data: 'clearance_icon', name: 'clearance' },
                    { data: 'reviueval_icon', name: 'reviueval' },
                    { data: 'tingkat_kematangan_display', name: 'tingkat_kematangan' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [[0, 'asc']],
                pageLength: 10,
                dom: '<"flex justify-between items-center mb-4"lf>rtip',
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    zeroRecords: "Tidak ada data yang cocok",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                },
                drawCallback: function() {
                    bindRowRefresh();
                }
            });
        }

        function changeKategori(kategori) {
            // Update URL tanpa reload halaman
            window.history.pushState({}, '', '{{ route('instansi.index') }}?kategori=' + kategori);

            // Update tampilan tab yang aktif
            document.querySelectorAll('.kategori-link').forEach(link => {
                if (link.dataset.kategori === kategori) {
                    link.classList.add('border-b-2', 'border-blue-600', 'font-semibold', 'text-blue-600');
                    link.classList.remove('text-gray-600', 'hover:text-blue-600');
                } else {
                    link.classList.remove('border-b-2', 'border-blue-600', 'font-semibold', 'text-blue-600');
                    link.classList.add('text-gray-600', 'hover:text-blue-600');
                }
            });

            // Reload DataTable dengan kategori baru
            initDataTable(kategori);
        }

        // Refresh row handler
        function bindRowRefresh() {
            $('.refresh-btn').off('click').on('click', async function() {
                const btn = $(this);
                const id = btn.data('id');

                btn.html('...');
                try {
                    await table.ajax.reload();
                    showAlert('Data berhasil diperbarui!');
                } catch (err) {
                    showAlert('Gagal memperbarui data!', false);
                }
                btn.html('<i class="fas fa-sync-alt"></i>');
            });
        }

        // Refresh All handler
        $('#refresh-all').click(async function() {
            const btn = $(this);
            btn.text('Refreshing...');

            try {
                await table.ajax.reload();
                showAlert('Semua data berhasil diperbarui!');
            } catch (err) {
                showAlert('Gagal memperbarui data!', false);
            }

            btn.text('Refresh All Data');
        });

        // Initialize with default category
        initDataTable('{{ $kategori }}');
    </script>
</body>
</html>
