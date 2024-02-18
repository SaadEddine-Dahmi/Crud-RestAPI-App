@if (auth()->check())
    {{-- Redirect to the login page --}}
    <script>
        window.location.href = "{{ url('/') }}";
    </script>
@endif
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite('resources/css/app.css')
    <title>Register</title>
</head>

<body>
    <div class="flex items-center justify-center min-h-screen">
        <div
            class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-sm p-6 rounded-md shadow-2xl z-50">
            <div id="successMessage"
                class="hidden relative w-full p-4 mb-4 text-sm leading-5 text-white bg-green-500 rounded-lg opacity-100 font-regular">
                <!-- Success message will appear here -->
            </div>

            <form method="POST" id="registrationForm" onsubmit="validateAndSubmit(event)"
                class="object-center m-auto w-10/12 justify-center mt-2 py-5 items-center bg-white">
                <h1 class="font-medium text-2xl my-3 text-center"> Enter your information</h1>
                @csrf

                <!-- Name Input -->
                <div class="relative h-11 w-full min-w-[200px] pt-3 my-3">
                    <input type="text" id="name" name="name" placeholder="Yahya Essenwar"
                        class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-500 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50 placeholder:opacity-0 focus:placeholder:opacity-100">
                    <label
                        class="after:content[''] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-1.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.25] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        Name
                    </label>

                </div>
                <div id="nameError"
                    class="relative hidden w-full p-2  text-base leading-5 text-white bg-red-500 rounded-lg opacity-100 font-regular">
                    <!-- Error message will appear here -->
                </div>

                <!-- Email Input -->
                <div class="relative h-11 w-full min-w-[200px] pt-3 my-3">
                    <input type="email" id="email" name="email" placeholder="Abu-Obayda@email.com"
                        class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-500 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50 placeholder:opacity-0 focus:placeholder:opacity-100">
                    <label
                        class="after:content[''] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-1.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.25] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        Email
                    </label>

                </div>
                <div id="emailError"
                    class="relative hidden w-full p-2  text-base leading-5 text-white bg-red-500 rounded-lg opacity-100 font-regular">
                    <!-- Error message will appear here -->
                </div>

                <!-- Password Input -->
                <div class="relative h-11 w-full min-w-[200px] pt-3 my-3">
                    <input type="password" id="password" name="password" placeholder="Enter Password"
                        class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-500 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50 placeholder:opacity-0 focus:placeholder:opacity-100">
                    <label
                        class="after:content[''] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-1.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.25] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        Password
                    </label>

                </div>
                <div id="passwordError"
                    class="relative hidden w-full p-2  text-base leading-5 text-white bg-red-500 rounded-lg opacity-100 font-regular">
                    <!-- Error message will appear here -->
                </div>

                <button
                    class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 bg-gradient-to-tr from-gray-900 to-gray-800 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 active:opacity-[0.85] rounded-full mt-3">
                    Register
                </button>

                <p
                    class="block mt-4 font-sans text-base antialiased font-normal leading-relaxed text-center text-gray-700">
                    You already have an account?
                    <a href="/login" class="font-medium text-gray-900">Log In</a>
                </p>
            </form>
        </div>
    </div>


</body>
<script src='/js/checking_register.js'></script>

</html>
