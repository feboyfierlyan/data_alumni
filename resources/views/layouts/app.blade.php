<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Data Alumni') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- SweetAlert2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/alumni.js'])
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="font-sans antialiased bg-gray-100 text-gray-900">
  <div class="min-h-screen flex flex-col bg-gray-100">
    <nav class="bg-white/95 backdrop-blur-sm shadow-sm border-b border-gray-200 sticky top-0 z-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex">
            <div class="shrink-0 flex items-center">
              <a href="{{ route('alumni.index') }}" class="flex items-center gap-2">
                {{-- Optional: Add an SVG logo here --}}
                <span class="font-semibold text-lg text-gray-800">{{ config('app.name', 'Data Alumni') }}</span>
              </a>
            </div>
          </div>
          <!-- Add more nav items here if needed -->
        </div>
      </div>
    </nav>

    {{-- Page Heading is removed from layout, handled within specific views --}}

    <!-- Page Content -->
    <main class="flex-grow">
      <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
          <div class="p-6 md:p-8 text-gray-900">
            {{ $slot }}
          </div>
        </div>
      </div>
    </main>
  </div>
  @stack('scripts')
</body>

</html>