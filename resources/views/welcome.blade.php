<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome - Event System</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="antialiased bg-gray-100 min-h-screen flex items-center justify-center">
        
        <div class="max-w-xl w-full bg-white p-10 rounded-xl shadow-2xl text-center">
            
            <div class="mb-6 flex justify-center">
                <div class="bg-indigo-100 p-4 rounded-full">
                    <svg class="w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            </div>

            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Event System</h1>
            <p class="text-gray-500 mb-8 text-lg">Manage your profile and register for events securely.</p>

            <div class="space-y-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="block w-full py-3 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 transition shadow-md">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full py-3 bg-gray-900 text-white font-bold rounded-lg hover:bg-gray-800 transition shadow-md">
                            Log In
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block w-full py-3 bg-white border-2 border-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-50 transition">
                                Register New Account
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
            
            <div class="mt-8 text-xs text-gray-400">
                &copy; {{ date('Y') }} SSD Project
            </div>
        </div>

    </body>
</html>