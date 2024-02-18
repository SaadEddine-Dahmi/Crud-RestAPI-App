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
    {{-- <script src="node_modules/@material-tailwind/html@latest/scripts/dismissible.js"></script> --}}

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body>
    @auth
        <p>Welcome back, {{ Auth::user()->name }}!</p>
        <form action="/logout" method="POST">
            @csrf
            <button>Log Out</button>
        </form>
    @else
        <div
            class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-sm  p-6  rounded-md shadow-2xl z-50">
            <div id="customAlert"
                class=" hidden relative w-full p-4 mb-4 text-base leading-5 text-white bg-green-500 rounded-lg opacity-100 font-regular">
            </div>
            <form action="/login" method="POST" id="loginForm" onsubmit="validateAndSubmitLogin(event)"
                class="object-center  m-auto w-10/12 justify-center mt-2 py-5 items-center bg-white ">
                <h1 class="font-medium text-2xl mt-3 text-center"> Log in to your account</h1>
                @csrf

                <div class="relative h-11 w-full min-w-[200px] pt-3 my-8">
                    <input type="email" id="loginmail" name="loginmail" placeholder="Enter Your Email"
                        class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-500 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50 placeholder:opacity-0 focus:placeholder:opacity-100">
                    <label
                        class="after:content[''] pointer-events-none absolute left-0  -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-1.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.25] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        Email
                    </label>
                </div>
                <div class="relative h-11 w-full min-w-[200px] pt-3 my-8">
                    <input type="password" id="loginpassword" name="loginpassword" placeholder="Enter Password"
                        class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-500 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50 placeholder:opacity-0 focus:placeholder:opacity-100">
                    <label
                        class="after:content[''] pointer-events-none absolute left-0  -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-1.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.25] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        Password
                    </label>
                </div>

                <div id="loginError"
                    class="relative hidden w-full p-3 mb-2 text-base leading-5 text-white bg-red-500 rounded-lg opacity-100 font-regular">
                </div>


                <button
                    class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 bg-gradient-to-tr from-gray-900 to-gray-800 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 active:opacity-[0.85] rounded-full mt-3">
                    Login</button>
                <p class="block mt-4 font-sans text-base antialiased font-normal leading-relaxed text-center text-gray-700">
                    Don’t have an account yet?
                    <a href="/register" class="font-medium text-gray-900">
                        Register
                    </a>
                </p>

            </form>
        </div>
    @endauth
</body>
<script src='/js/checking_login.js'></script>

</html>
