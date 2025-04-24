<x-app-layout>
  {{-- Header Section --}}
  <header class="pt-6 pb-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
      <h1 class="text-2xl font-semibold text-gray-800">List Daftar Alumni</h1>
      <a href="{{ route('alumni.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        Tambah Alumni
      </a>
    </div>
  </header>

  {{-- Main Content Area --}}
  <div class="pb-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
        <div class="p-6 md:p-8 bg-white">
          {{-- Removed redundant header and button, moved to the top layout header --}}

          <!-- Search Form -->
          <!-- Search Form -->
          <form action="{{ route('alumni.index') }}" method="GET" class="mb-6">
            <div class="flex flex-col sm:flex-row gap-4 items-end">
              <div class="flex-1 w-full sm:w-auto">
                <label for="tahun_lulus" class="block text-sm font-medium text-gray-700 mb-1">Filter Tahun Lulus</label>
                <select name="tahun_lulus" id="tahun_lulus" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                  <option value="">Semua Tahun</option>
                  @php
                  $currentYear = date('Y');
                  $startYear = $currentYear - 10;
                  @endphp
                  @for($year = $currentYear; $year >= $startYear; $year--)
                  <option value="{{ $year }}" {{ request('tahun_lulus') == $year ? 'selected' : '' }}>{{ $year }}</option>
                  @endfor
                </select>
              </div>
              <div class="w-full sm:w-auto">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                  Filter
                </button>
              </div>
            </div>
          </form>

          <!-- Alumni List -->
          <div class="overflow-x-auto border border-gray-200 rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">NIM</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Jurusan</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Tahun Lulus</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Pekerjaan</th>
                  <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($alumni as $alumnus)
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      @if($alumnus->foto)
                      <div class="flex-shrink-0 h-10 w-10">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($alumnus->foto) }}" alt="Foto {{ $alumnus->nama }}">
                      </div>
                      @else
                      <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500 text-xs">{{ strtoupper(substr($alumnus->nama, 0, 1)) }}</span>
                      </div>
                      @endif
                      <div class="ml-3">
                        <div class="text-sm font-medium text-gray-900">{{ $alumnus->nama }}</div>
                        <div class="text-sm text-gray-500">{{ $alumnus->email }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">{{ $alumnus->nim }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">{{ $alumnus->education ? $alumnus->education->jurusan : '-' }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden lg:table-cell">{{ $alumnus->education ? $alumnus->education->tahun_lulus : '-' }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">
                    @if($alumnus->jobs->where('pekerjaan_saat_ini', true)->first())
                    {{ $alumnus->jobs->where('pekerjaan_saat_ini', true)->first()->jabatan }} di
                    {{ $alumnus->jobs->where('pekerjaan_saat_ini', true)->first()->nama_perusahaan }}
                    @else
                    -
                    @endif
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('alumni.show', ['alumnus' => $alumnus->id]) }}" class="text-blue-600 hover:text-blue-800 mr-3 font-medium view-details" data-id="{{ $alumnus->id }}">View</a>
                    <a href="{{ route('alumni.edit', ['alumnus' => $alumnus->id]) }}" class="text-blue-600 hover:text-blue-800 mr-3 font-medium">Edit</a>
                    <form action="{{ route('alumni.destroy', ['alumnus' => $alumnus->id]) }}" method="POST" class="inline-block delete-alumni-form">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-red-600 hover:text-red-800 font-medium delete-alumni-btn">Hapus</button>
                    </form>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="px-6 py-12 whitespace-nowrap text-sm text-gray-500 text-center">Tidak ada data alumni yang ditemukan.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          @if ($alumni->hasPages())
          <div class="mt-6 px-2 py-2 border-t border-gray-200">
            {{ $alumni->links() }}
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const deleteForms = document.querySelectorAll('.delete-alumni-form');
    deleteForms.forEach(function(form) {
      form.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
          title: 'Konfirmasi Penghapusan',
          text: 'Anda yakin ingin menghapus data alumni ini?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya, Hapus!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      });
    });
  });
</script>


{{-- HAPUS ATAU KOMENTARI BLOK SCRIPT DI BAWAH INI --}}
{{--
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.view-details');
    viewButtons.forEach(function(button) {
      button.addEventListener('click', function(e) {
        e.preventDefault(); // Mencegah navigasi
        const alumniId = this.getAttribute('data-id');
        // Tidak ada aksi lanjutan di sini
      });
    });
  });
</script>
--}}