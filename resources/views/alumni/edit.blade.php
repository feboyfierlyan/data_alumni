<x-app-layout>
  {{-- Header --}}
  <header class="pt-6 pb-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center">
      <a href="{{ route('alumni.index') }}" class="text-gray-500 hover:text-gray-700 mr-3">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
      </a>
      <h1 class="text-2xl font-semibold text-gray-800">Edit Data Alumni</h1>
    </div>
  </header>

  {{-- Form Content --}}
  <div class="pb-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
        <form action="{{ route('alumni.update', ['alumnus' => $alumnus->id]) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
          @csrf
          @method('PUT')
          <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

            {{-- Kolom Kiri: Data Pribadi --}}
            <div class="space-y-6">
              <h3 class="text-lg font-medium leading-6 text-gray-900 border-b pb-2">Data Pribadi</h3>

              <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $alumnus->nama) }}" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
              </div>

              <div>
                <label for="nim" class="block text-sm font-medium text-gray-700 mb-1">NIM</label>
                <input type="text" name="nim" id="nim" value="{{ old('nim', $alumnus->nim) }}" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
              </div>

              <div>
                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                  <option value="L" {{ old('jenis_kelamin', $alumnus->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                  <option value="P" {{ old('jenis_kelamin', $alumnus->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
              </div>

              <div class="grid grid-cols-2 gap-4">
                <div>
                  <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                  <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', $alumnus->tempat_lahir) }}" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                </div>

                <div>
                  <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                  <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $alumnus->tanggal_lahir) }}" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                </div>
              </div>

              <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>{{ old('alamat', $alumnus->alamat) }}</textarea>
              </div>

              <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $alumnus->email) }}" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
              </div>

              <div>
                <label for="no_telepon" class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                <input type="tel" name="no_telepon" id="no_telepon" value="{{ old('no_telepon', $alumnus->no_telepon) }}" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
              </div>

              <div>
                <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                @if($alumnus->foto)
                <img src="{{ Storage::url($alumnus->foto) }}" alt="Foto {{ $alumnus->nama }}" class="w-24 h-24 object-cover rounded-lg mb-2">
                <p class="text-xs text-gray-500 mb-1">Foto saat ini. Upload file baru untuk mengganti.</p>
                @endif
                <input type="file" name="foto" id="foto" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
              </div>
            </div>

            {{-- Kolom Kanan: Data Pendidikan & Pekerjaan --}}
            <div class="space-y-6">
              <h3 class="text-lg font-medium leading-6 text-gray-900 border-b pb-2">Data Pendidikan</h3>

              <div>
                <label for="jurusan" class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
                <input type="text" name="jurusan" id="jurusan" value="{{ old('jurusan', optional($alumnus->education)->jurusan) }}" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
              </div>

              <div>
                <label for="fakultas" class="block text-sm font-medium text-gray-700 mb-1">Fakultas</label>
                <input type="text" name="fakultas" id="fakultas" value="{{ old('fakultas', optional($alumnus->education)->fakultas) }}" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
              </div>

              <div class="grid grid-cols-2 gap-4">
                <div>
                  <label for="tahun_masuk" class="block text-sm font-medium text-gray-700 mb-1">Tahun Masuk</label>
                  <input type="number" name="tahun_masuk" id="tahun_masuk" value="{{ old('tahun_masuk', optional($alumnus->education)->tahun_masuk) }}" placeholder="YYYY" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                </div>

                <div>
                  <label for="tahun_lulus" class="block text-sm font-medium text-gray-700 mb-1">Tahun Lulus</label>
                  <input type="number" name="tahun_lulus" id="tahun_lulus" value="{{ old('tahun_lulus', optional($alumnus->education)->tahun_lulus) }}" placeholder="YYYY" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                </div>
              </div>

              <div>
                <label for="ipk" class="block text-sm font-medium text-gray-700 mb-1">IPK</label>
                <input type="text" name="ipk" id="ipk" value="{{ old('ipk', optional($alumnus->education)->ipk) }}" placeholder="Contoh: 3.75" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
              </div>

              <h3 class="text-lg font-medium leading-6 text-gray-900 border-b pb-2 pt-4">Data Pekerjaan</h3>

              <div>
                <label for="nama_perusahaan" class="block text-sm font-medium text-gray-700 mb-1">Nama Perusahaan</label>
                <input type="text" name="nama_perusahaan" id="nama_perusahaan" value="{{ old('nama_perusahaan', optional($alumnus->jobs->first())->nama_perusahaan) }}" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
              </div>

              <div class="grid grid-cols-2 gap-4">
                <div>
                  <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                  <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', optional($alumnus->jobs->first())->jabatan) }}" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                </div>

                <div>
                  <label for="bidang" class="block text-sm font-medium text-gray-700 mb-1">Bidang</label>
                  <input type="text" name="bidang" id="bidang" value="{{ old('bidang', optional($alumnus->jobs->first())->bidang) }}" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                </div>
              </div>

              <div>
                <label for="alamat_perusahaan" class="block text-sm font-medium text-gray-700 mb-1">Alamat Perusahaan</label>
                <textarea name="alamat_perusahaan" id="alamat_perusahaan" rows="3" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>{{ old('alamat_perusahaan', optional($alumnus->jobs->first())->alamat_perusahaan) }}</textarea>
              </div>

              <div>
                <label for="tahun_masuk_kerja" class="block text-sm font-medium text-gray-700 mb-1">Tahun Masuk Kerja</label>
                <input type="number" name="tahun_masuk_kerja" id="tahun_masuk_kerja" value="{{ old('tahun_masuk_kerja', optional($alumnus->jobs->first())->tahun_masuk_kerja) }}" placeholder="YYYY" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
              </div>
            </div>
          </div>

          {{-- Form Actions --}}
          <div class="mt-8 pt-5 border-t border-gray-200 flex justify-end gap-3">
            <a href="{{ route('alumni.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
              Batal
            </a>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
              Update Data
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>