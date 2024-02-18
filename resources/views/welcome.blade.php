@if (!auth()->check())
    {{-- Redirect to the login page --}}
    <script>
        window.location.href = "{{ url('/login') }}";
    </script>
@else
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,300,0,0" />



        @vite('resources/css/app.css')

        <style>
            .blurred {
                filter: blur(5px);
            }
        </style>
    </head>

    <body>
        <div class="grid min-h-[140px] w-full place-items-center  rounded-lg p-6 lg:overflow-visible pb-5">
            <div class="-m-6 max-h-[768px] w-[calc(100%+48px)] ">
                <x-navBar />
                <div>
                    <div id="app" class="">
                        <x-createButton />


                        {{-- items table  --}}
                        <div class="overflow-x-auto  " id="content">
                            <div class="bg-gray-100 flex items-center justify-center  font-sans overflow-hidden ">
                                <div class="w-full lg:w-2/3 items-center ">
                                    <div class="bg-white shadow-md rounded my-6">
                                        <table class="min-w-max w-full table-auto  ">
                                            <thead class="">
                                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                                    <th class="py-3 px-6 text-left hidden">Id</th>
                                                    <th class="py-3 px-6 text-left">Reference Titre</th>
                                                    <th class="py-3 px-6 text-left">Valeur</th>
                                                    <th class="py-3 px-6 text-center">Langue</th>
                                                    <th class="py-3 px-6 text-center">Status</th>
                                                    <th class="py-3 px-6 text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            @if ($items->count() > 0)
                                                @foreach ($items as $item)
                                                    {{-- {{ $item_Id = $item['id'] }} --}}
                                                    <tbody class="text-gray-600 text-sm font-light">

                                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                                            <td class="py-3 px-6 text-left whitespace-nowrap hidden">
                                                                <div class="flex items-center font-medium">
                                                                    {{ $item['id'] }}
                                                                </div>
                                                            </td>
                                                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                                                <div class="flex items-center font-medium">
                                                                    {{ $item['ref_titre'] }}
                                                                </div>
                                                            </td>
                                                            <td class="py-3 px-6 text-left">
                                                                <div class="flex items-center">
                                                                    <span>{{ $item['valeur'] }} </span>
                                                                </div>
                                                            </td>
                                                            <td class="py-3 px-6 text-center">
                                                                <div class="flex items-center justify-center">
                                                                    {{ $item['lang'] }}
                                                                </div>
                                                            </td>
                                                            <td class="py-3 px-6 text-center">
                                                                @if ($item['status'] === 'active')
                                                                    <span
                                                                        class="bg-green-600 text-white py-1 px-3 rounded-full text-xs">Active
                                                                    @else
                                                                        <span
                                                                            class="bg-red-600 text-white py-1 px-3 rounded-full text-xs">
                                                                            Inactive</span>
                                                                    </span>
                                                                @endif
                                                            </td>
                                                            <td class="py-3 px-6 text-center">
                                                                <div class="flex item-center justify-center">
                                                                    <div
                                                                        class="w-4 mr-2 transform hover:text-green-500 hover:scale-110 relative">
                                                                        <a href="/edit-item/{{ $item['id'] }}  "
                                                                            class="relative block ">
                                                                            <div
                                                                                class="hidden absolute inset-0 bg-gray-800 bg-opacity-50 transition-opacity opacity-0 hover:opacity-100">
                                                                                <!-- This is the element that will be displayed on hover -->
                                                                                <p class="text-white p-4">Edit</p>
                                                                            </div>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                fill="none" viewBox="0 0 24 24"
                                                                                stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                                            </svg>
                                                                        </a>
                                                                    </div>


                                                                    <div class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 cursor-pointer delete-button"
                                                                        data-item-id="">
                                                                        <i class="openPopup">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                fill="none" viewBox="0 0 24 24"
                                                                                stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                            </svg>
                                                                        </i>
                                                                    </div>
                                                                </div>
                                                @endforeach

                                                <div id="popup"
                                                    class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 items-center justify-center">
                                                    <div
                                                        class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2  max-w-sm p-6 bg-white rounded-md shadow-2xl z-50">
                                                        <h3 class="text-2xl font-bold">Are you sure you want to delete
                                                            this
                                                            item?
                                                        </h3>
                                                        <div class="mt-4 flex justify-end">
                                                            <form action="/delete/{{ $item['id'] }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button id="confirmDeleteBtn"
                                                                    class="mr-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                                                    Delete
                                                                </button>

                                                            </form>



                                                            <button id="cancelDeleteBtn"
                                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                                Cancel
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                </td>
                                                </tr>
                                            @else
                                                <td class="py-3 px-6 text-left whitespace-nowrap hidden">
                                                    <div class="flex items-center font-medium">

                                                    </div>
                                                </td>
                                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                                    <div class="flex items-center font-medium">
                                                        <p>none</p>
                                                    </div>
                                                </td>
                                                <td class="py-3 px-6 text-left">
                                                    <div class="flex items-center">
                                                        <p>none</p>
                                                    </div>
                                                </td>
                                                <td class="py-3 px-6 text-center">
                                                    <div class="flex items-center justify-center">
                                                        <p>none</p>
                                                    </div>
                                                </td>
                                                <td class="py-3 px-6 text-center">
                                                    <div class="flex items-center justify-center">
                                                        <p>none</p>
                                                    </div>
                                                </td>
                                                <td class="py-3 px-6 text-center">
                                                    <div class="flex item-center justify-center">
                                                        <div
                                                            class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 relative">
                                                            <p>-</p>
                                                        </div>
                                                        <div
                                                            class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                            <p>-</p>
                                                        </div>

                                                    </div>
                                                    </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
@endif
</div>
<script src='/js/popup_delete.js'></script>
<script src="/js/create_form.js"></script>

</body>

@endif



</html>
