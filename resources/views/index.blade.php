<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tabel Instansi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow mb-6">
        <div class="max-w-7xl mx-auto px-4 flex space-x-4">
            @foreach (['Kementerian','LPNK','LNS','InstansiLain','Provinsi','KabKota'] as $nav)
                <a href="{{ route('index', ['kategori' => $nav]) }}"
                class="py-3 px-4 {{ $kategori==$nav ? 'border-b-2 border-blue-600 font-semibold text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
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
            <table class="min-w-full text-sm text-center">
                <thead class="bg-gray-100 text-gray-700 sticky top-0">
                    <tr>
                        <th rowspan="2" class="px-4 py-2">Instansi</th>
                        <th colspan="6" class="px-4 py-2">Arsitektur As-Is</th>
                        <th colspan="6" class="px-4 py-2">Arsitektur To-Be</th>
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
                <tbody id="instansi-tbody" class="divide-y">
                    @foreach($data as $row)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 font-medium text-gray-900">{{ $row->instansi }}</td>

                        <td>{{ $row->proses_bisnis_as_is }}</td>
                        <td>{{ $row->layanan_as_is }}</td>
                        <td>{{ $row->data_info_as_is }}</td>
                        <td>{{ $row->aplikasi_as_is }}</td>
                        <td>{{ $row->infra_as_is }}</td>
                        <td>{{ $row->keamanan_as_is }}</td>

                        <td>{{ $row->proses_bisnis_to_be }}</td>
                        <td>{{ $row->layanan_to_be }}</td>
                        <td>{{ $row->data_info_to_be }}</td>
                        <td>{{ $row->aplikasi_to_be }}</td>
                        <td>{{ $row->infra_to_be }}</td>
                        <td>{{ $row->keamanan_to_be }}</td>

                        <td>{{ $row->peta_rencana ? '✓' : '-' }}</td>
                        <td>{{ $row->clearance ? '✓' : '-' }}</td>
                        <td>{{ $row->reviueval ? '✓' : '-' }}</td>
                        <td>{{ $row->tingkat_kematangan ? '✓' : '-' }}</td>
                        <td>
                            <button
                                data-id="{{ $row->id }}"
                                class="refresh-btn bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                Refresh
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $data->links('pagination::tailwind') }}
        </div>
    </div>

    <script>
        const alertBox = document.getElementById('alert-box');
        const tbody = document.getElementById('instansi-tbody');

        function showAlert(message, success = true) {
            alertBox.textContent = message;
            alertBox.className = success
                ? "mb-4 p-3 rounded bg-green-100 text-green-700"
                : "mb-4 p-3 rounded bg-red-100 text-red-700";
            alertBox.classList.remove("hidden");
            setTimeout(() => alertBox.classList.add("hidden"), 3000);
        }

        // Render ulang tabel dari JSON
        function renderTable(rows) {
            tbody.innerHTML = "";
            rows.forEach(row => {
                tbody.innerHTML += `
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 font-medium text-gray-900">${row.instansi}</td>

                    <td>${row.proses_bisnis_as_is ?? ''}</td>
                    <td>${row.layanan_as_is ?? ''}</td>
                    <td>${row.data_info_as_is ?? ''}</td>
                    <td>${row.aplikasi_as_is ?? ''}</td>
                    <td>${row.infra_as_is ?? ''}</td>
                    <td>${row.keamanan_as_is ?? ''}</td>

                    <td>${row.proses_bisnis_to_be ?? ''}</td>
                    <td>${row.layanan_to_be ?? ''}</td>
                    <td>${row.data_info_to_be ?? ''}</td>
                    <td>${row.aplikasi_to_be ?? ''}</td>
                    <td>${row.infra_to_be ?? ''}</td>
                    <td>${row.keamanan_to_be ?? ''}</td>

                    <td>${row.peta_rencana ? '✓' : '-'}</td>
                    <td>${row.clearance ? '✓' : '-'}</td>
                    <td>${row.reviueval ? '✓' : '-'}</td>
                    <td>${row.tingkat_kematangan ? '✓' : '-'}</td>
                    <td>
                        <button data-id="${row.id}"
                            class="refresh-btn bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                            Refresh
                        </button>
                    </td>
                </tr>`;
            });

            // re-bind refresh button
            bindRowRefresh();
        }

        // Fetch data terbaru
        async function fetchData() {
            try {
                const res = await fetch("{{ route('data', ['kategori' => $kategori]) }}");
                const json = await res.json();
                renderTable(json.data);
                showAlert("Data berhasil diperbarui!");
            } catch (err) {
                showAlert("Gagal ambil data!", false);
            }
        }

        // Refresh 1 baris → ambil ulang semua data biar aman
        function bindRowRefresh() {
            document.querySelectorAll('.refresh-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    btn.textContent = '...';
                    fetchData().finally(() => {
                        btn.textContent = 'Refresh';
                    });
                });
            });
        }

        // Refresh All
        document.getElementById('refresh-all').addEventListener('click', async () => {
            const btn = document.getElementById('refresh-all');
            btn.textContent = 'Refreshing...';
            await fetchData();
            btn.textContent = 'Refresh All Data';
        });

        // pertama kali binding
        bindRowRefresh();
    </script>
</body>
</html>
