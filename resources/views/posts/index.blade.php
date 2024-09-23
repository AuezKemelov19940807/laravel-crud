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

    <style>
        /* Make sure the modal is hidden by default */
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            width: 600px;
            position: fixed;
            margin: auto;
            padding: 2rem;
            background: white;
            border-radius: 0.5rem;
            max-width: 500px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Loader styles */
        .loader {
            border: 2px solid #f3f3f3; /* Light grey */
            border-top: 2px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .confirmation-modal {
            display: none;
            position: fixed;
            z-index: 60;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .confirmation-modal-content {
            width: 400px;
            padding: 1.5rem;
            background: white;
            border-radius: 0.5rem;
            text-align: center;
        }

    </style>
</head>
<body class="bg-gray-100 text-gray-900 font-sans antialiased">
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold mb-6">Posts</h1>

    <div class="bg-white p-6 rounded-lg shadow-lg">

        @foreach($posts as $post)
            <div class="p-4 border-b border-gray-200 flex justify-between last:border-0">
                <div class="flex flex-col gap-y-2">
                    <div>
                        <span class="text-lg font-medium">Title:</span>
                        <span class="text-lg font-medium">{{$post->title}}</span>
                    </div>
                    <div>
                        <span class="text-lg font-medium">Content:</span>
                        <span class="text-lg font-medium">{{$post->content}}</span>
                    </div>
                    <div>
                        <span class="text-lg font-medium">Category:</span>
                        <span class="text-lg font-medium">
                         {{ $post->category ? $post->category->name : 'Uncategorized' }} <!-- Добавлена проверка -->
                        </span>
                    </div>
                </div>

                <div class="flex items-start gap-x-[10px]">
                    <a  href="{{route('posts.show', $post->id)}}"
                       class="max-w-[24px] max-h-[24px] flex items-center justify-center px-4 py-2  text-white rounded-lg shadow hover:bg-gray-100  transition">
                        <img src="{{ asset('images/view.svg') }}" class="min-w-[24px] min-h-[24px]"  alt="View">
                    </a>
                    <a href="{{route('posts.edit', $post->id)}}"
                       class="max-w-[24px] max-h-[24px] flex items-center justify-center px-4 py-2  text-white rounded-lg shadow hover:bg-gray-100  transition update-btn">
                        <img class="min-w-[24px] min-h-[24px]" src="{{ asset('images/edit.svg') }}" alt="Edit">
                    </a>
                    <button
                        class="max-w-[24px] max-h-[24px] flex items-center justify-center px-4 py-2  text-white rounded-lg shadow hover:bg-gray-100  transition delete-btn"
                        data-id="{{ $post->id }}">
                        <img class="min-w-[24px] min-h-[24px]" src="{{ asset('images/delete.svg') }}" alt="Delete">
                    </button>
                </div>
            </div>

            <div id="modalEdit" class="modal">
                <div class="modal-content">
                    <h1 class="text-2xl font-semibold mb-4 text-center ">Update Category</h1>
                    <form id="editCategoryForm" action="{{ route('categories.update', $post->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-col gap-y-[24px]">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    Title:
                                </label>
                                <input id="name" placeholder="Name" value="{{$post->title}}"
                                       class="mt-1 px-[10px] py-[12px] block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                       type="text" name="name">
                            </div>
                            <div>
                                <label for="code" class="block text-sm font-medium text-gray-700">
                                    Content:
                                </label>
                                <input id="code" value="{{$post->content}}" placeholder="Code"
                                       class="mt-1 px-[10px] py-[12px] block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                       type="text" name="code">
                            </div>

                        </div>

                        <button id="submitButtonEdit"
                                class="relative flex items-center justify-center mt-4 w-full h-[40px] px-4 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none "
                                type="submit">
                            <span id="submitButtonEdit">Update Category</span>
                            <span id="loadingSpinner" class="loader flex items-center w-full justify-center"
                                  style="display: none;"></span>
                        </button>
                        <button type="button" id="closeModalBtnUpdate"
                                class="absolute top-[10px] right-[10px] text-black text-[30px] ">X
                        </button>
                    </form>
                </div>
            </div>

        @endforeach
    </div>
    <div class="flex gap-x-5">
        <a href="{{route('welcome')}}"
           class="mt-6 inline-block px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition">
            <img src="{{ asset('images/back.svg') }}" alt="Back">
        </a>
        <button id="openModalBtn"
                class="mt-6 inline-block px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition">
            <img src="{{ asset('images/add.svg') }}" alt="Delete">
        </button>
    </div>
    <!-- Button to open modal -->

</div>

<!-- Modal -->
<div id="modal" class="modal">
    <div class="modal-content">
        <h1 class="text-2xl font-semibold mb-4 text-center ">Create Post</h1>
        <form id="createCategoryForm" action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="flex flex-col gap-y-[24px]">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Title:
                    </label>
                    <input id="title" placeholder="Title"
                           class="mt-1 px-[10px] py-[12px] block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                           type="text" name="title">
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
                    <label for="code" class="block text-sm font-medium text-gray-700">
                        Content:
                    </label>
                    <textarea id="content" placeholder="Content"
                              class="mt-1 resize-none py-[12px] block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                              name="content" rows="10" style="height: auto;">
                    </textarea>
                </div>
            </div>

            <button id="submitButton"
                    class="relative flex items-center justify-center mt-4 w-full h-[40px] px-4 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none "
                    type="submit">
                <span id="buttonText">Create Post</span>
                <span id="loadingSpinner" class="loader flex items-center w-full justify-center"
                      style="display: none;"></span>
            </button>
            <button type="button" id="closeModalBtn" class="absolute top-[10px] right-[10px] text-black text-[30px]">
                X
            </button>
        </form>
    </div>
</div>

<div id="confirmationModal" class="confirmation-modal">
    <div class="confirmation-modal-content">
        <h2 class="text-lg font-semibold mb-4">Are you sure you want to delete this category?</h2>
        <form id="confirmationForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex gap-x-[24px]">
                <button type="submit"
                        class="px-4 w-full py-2 bg-red-500 text-white rounded-lg shadow hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 transition">
                    Yes
                </button>
                <button type="button" id="cancelDelete"
                        class="px-4 w-full py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript for modal functionality -->
<script>
    document.getElementById('openModalBtn').addEventListener('click', function () {
        document.getElementById('modal').style.display = 'flex';
    });


    document.getElementById('closeModalBtn').addEventListener('click', function () {
        console.log('btn close')
        document.getElementById('modal').style.display = 'none';
    });

    // Close modal when clicking outside of it
    window.addEventListener('click', function (event) {
        if (event.target === document.getElementById('modal')) {
            document.getElementById('modal').style.display = 'none';
        }
    });


    document.querySelectorAll('.delete-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            const postId = button.getAttribute('data-id');
            const confirmationForm = document.getElementById('confirmationForm');
            const url = `{{ url('/posts') }}/${postId}`;
            confirmationForm.setAttribute('action', url);
            document.getElementById('confirmationModal').style.display = 'flex';
        });
    });


    document.getElementById('confirmationForm').addEventListener('submit', function (event) {
        const submitButton = event.target.querySelector('button[type="submit"]');
        const buttonText = submitButton.innerText;

        submitButton.innerHTML = '<span class="loader"></span>';
        submitButton.setAttribute('disabled', 'true');

        // Optionally prevent form submission if using AJAX:
        // event.preventDefault();
    });

    // Handle cancel button click
    document.getElementById('cancelDelete').addEventListener('click', function () {
        document.getElementById('confirmationModal').style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === document.getElementById('confirmationModal')) {
            document.getElementById('confirmationModal').style.display = 'none';
        }
    });


    document.getElementById('createCategoryForm').addEventListener('submit', function (event) {
        const submitButton = document.getElementById('submitButton');
        const buttonText = document.getElementById('buttonText');
        const loadingSpinner = document.getElementById('loadingSpinner');

        // Show loading spinner and hide button text
        loadingSpinner.style.display = 'flex';
        buttonText.style.display = 'none';

        // Optionally prevent form submission if using AJAX:
        // event.preventDefault();
    });
</script>
</body>
</html>
