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
        <h1 class="text-2xl font-semibold mb-4 text-center ">Update Category</h1>
        <form id="editCategoryForm" action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="flex flex-col gap-y-[24px]">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">
                        Title:
                    </label>
                    <input id="title"  placeholder="title" value="{{$post->title}}" class="mt-1 px-[10px] py-[12px] block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" type="text" name="title">
                </div>
                <div>
                    <label for="categoryID" class="block text-sm font-medium text-gray-700">
                        Category:
                    </label>
                    <select id="categoryID" name="category_id"
                            class="mt-1 px-[10px] py-[12px] block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">
                        Content:
                    </label>

                    <textarea  id="content"  placeholder="Content" class="mt-1 h-[400px] resize-none px-[10px] py-[12px] block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" type="text" name="content">
                         {{$post->content}}
                    </textarea>

                </div>
            </div>

            <button id="submitButtonEdit" class="relative flex items-center justify-center mt-4 w-full h-[40px] px-4 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none " type="submit">
                <span id="submitButtonEdit">Update Post</span>
                <span id="loadingSpinner" class="loader flex items-center w-full justify-center" style="display: none;"></span>
            </button>
            <a href="{{route('posts.index')}}" type="button" id="closeModalBtnUpdate" class="absolute top-[10px] right-[10px] text-black text-[30px] ">X</a>
        </form>
    </div>
</div>



</body>
</html>
