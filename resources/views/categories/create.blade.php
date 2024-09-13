<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Styles -->
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
    <h1 class="text-2xl font-semibold mb-4">Create Category</h1>
    <form class="space-y-4" action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">
                Name:
            </label>
            <input id="name" placeholder="Name" class="mt-1 px-[10px] py-[12px] block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" type="text" name="name">
        </div>
        <div>
            <label for="code" class="block text-sm font-medium text-gray-700">
                Code:
            </label>
            <input id="name" placeholder="Code" class="mt-1 py-[12px] px-[10px] block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" type="text" name="name">
        </div>
        <button class="mt-4 w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" type="submit">
            Create Category
        </button>
    </form>
</div>
</body>
</html>
