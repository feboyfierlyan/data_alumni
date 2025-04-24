<x-app-layout>
  <header class="pt-6 pb-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center">
      <a href="{{ route('alumni.index') }}" class="text-gray-500 hover:text-gray-700 mr-3">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
      </a>
      <h1 class="text-2xl font-semibold text-gray-800">Detail Alumni</h1>
    </div>
  </header>

  <div class="pb-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
        <div class="p-6 md:p-8 bg-white">
          <div class="flex items-center mb-6">
            @if($alumnus->foto)
            <div class="flex-shrink-0 h-20 w-20">
              <img class="h-20 w-20 rounded-full object-cover" src="{{ Storage::url($alumnus->foto) }}" alt="Foto {{ $alumnus->nama }}">
            </div>
            @else
            <div class="flex-shrink-0 h-20 w-20 rounded-full bg-gray-200 flex items-center justify-center">
              <span class="text-gray-500 text-xl">{{ strtoupper(substr($alumnus->nama, 0, 1)) }}</span>
            </div>
            @endif
            <div class="ml-4">
              <div class="text-lg font-medium text-gray-900">{{ $alumnus->nama }}</div>
              <div class="text-sm text-gray-500">{{ $alumnus->email }}</div>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <h3 class="text-lg font-medium text-gray-900">Informasi Pribadi</h3>
              <p class="mt-2 text-sm text-gray-500">NIM: {{ $alumnus->nim }}</p>
              <p class="mt-2 text-sm text-gray-500">Jenis Kelamin: {{ $alumnus->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
              <p class="mt-2 text-sm text-gray-500">Tempat/Tanggal Lahir: {{ $alumnus->tempat_lahir }}, {{ Carbon\Carbon::parse($alumnus->tanggal_lahir)->format('d-m-Y') }}</p>
              <p class="mt-2 text-sm text-gray-500">Alamat: {{ $alumnus->alamat }}</p>
              <p class="mt-2 text-sm text-gray-500">Email: {{ $alumnus->email }}</p>
              <p class="mt-2 text-sm text-gray-500">No. Telepon: {{ $alumnus->no_telepon }}</p>
            </div>
            <div>
              <h3 class="text-lg font-medium text-gray-900">Pendidikan</h3>
              <p class="mt-2 text-sm text-gray-500">Jurusan: {{ $alumnus->education ? $alumnus->education->jurusan : '-' }}</p>
              <p class="mt-2 text-sm text-gray-500">Fakultas: {{ $alumnus->education ? $alumnus->education->fakultas : '-' }}</p>
              <p class="mt-2 text-sm text-gray-500">Tahun Masuk: {{ $alumnus->education ? $alumnus->education->tahun_masuk : '-' }}</p>
              <p class="mt-2 text-sm text-gray-500">Tahun Lulus: {{ $alumnus->education ? $alumnus->education->tahun_lulus : '-' }}</p>
              <p class="mt-2 text-sm text-gray-500">IPK: {{ $alumnus->education ? $alumnus->education->ipk : '-' }}</p>

              <h3 class="text-lg font-medium text-gray-900 mt-4">Pekerjaan</h3>
              @if($alumnus->jobs->where('pekerjaan_saat_ini', true)->first())
              <p class="mt-2 text-sm text-gray-500">Perusahaan: {{ $alumnus->jobs->where('pekerjaan_saat_ini', true)->first()->nama_perusahaan }}</p>
              <p class="mt-2 text-sm text-gray-500">Jabatan: {{ $alumnus->jobs->where('pekerjaan_saat_ini', true)->first()->jabatan }}</p>
              <p class="mt-2 text-sm text-gray-500">Bidang: {{ $alumnus->jobs->where('pekerjaan_saat_ini', true)->first()->bidang }}</p>
              <p class="mt-2 text-sm text-gray-500">Alamat Perusahaan: {{ $alumnus->jobs->where('pekerjaan_saat_ini', true)->first()->alamat_perusahaan }}</p>
              <p class="mt-2 text-sm text-gray-500">Tahun Masuk Kerja: {{ $alumnus->jobs->where('pekerjaan_saat_ini', true)->first()->tahun_masuk_kerja }}</p>
              @else
              <p class="mt-2 text-sm text-gray-500">-</p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>