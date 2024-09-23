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
<div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg relative">

    <div class="modal-content">
        <h1 class="text-2xl font-semibold mb-4 text-center ">View Post</h1>
        <div id="editCategoryForm" >

            <div class="flex flex-col gap-y-[24px]">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Title:
                    </label>
                    <div class="mt-1 px-[10px] py-[12px] block w-full  rounded-md  focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        {{$post->title}}
                    </div>
                </div>
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700">
                        Content:
                    </label>
                    <div class="mt-1 px-[10px] py-[12px] block w-full  rounded-md  focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        {{$post->content}}
                    </div>
                </div>

                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700">
                        Category:
                    </label>
                    <div class="mt-1 px-[10px] py-[12px] block w-full  rounded-md  focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        {{$post->category->name}}
                    </div>
                </div>

            </div>
            <a href="{{route('posts.index')}}" type="button" id="closeModalBtnUpdate" class="absolute top-[10px] right-[10px] text-black text-[30px] ">X</a>

        </div>
    </div>
</div>



</body>
</html>
