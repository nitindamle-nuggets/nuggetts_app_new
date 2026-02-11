<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite('resources/css/app.css')
</head>

<body class="h-full m-0">
    <div class="flex min-h-screen bg-gray-200">

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white flex flex-col">
            <div class="p-4 text-2xl font-bold border-b border-gray-700">
                Admin Panel
            </div>

            <nav class="flex-1 overflow-y-auto mt-4">
                <a href="{{ route('admin.dashboard') }}"
                   class="block py-2.5 px-4 hover:bg-gray-700 transition">
                   Dashboard
                </a>

                <a href="{{ route('admin.departments.index') }}"
                   class="block py-2.5 px-4 hover:bg-gray-700 transition">
                   Departments
                </a>

                <a href="{{ route('admin.locations.index') }}"
                   class="block py-2.5 px-4 hover:bg-gray-700 transition">
                   Locations
                </a>

                <a href="{{ route('admin.companies.index') }}"
                   class="block py-2.5 px-4 hover:bg-gray-700 transition">
                   Companies
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">

            <!-- Header -->
            <header class="bg-white border-b px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold">@yield('title')</h1>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-500 hover:text-red-700">
                        Logout
                    </button>
                </form>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-100 p-6">
                @yield('content')
            </main>

        </div>
    </div>
</body>
</html>
