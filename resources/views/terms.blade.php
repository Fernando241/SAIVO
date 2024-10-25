<x-guest-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div>
                {{-- <x-authentication-card-logo /> --}}
                <div class=" bg-white p-2 rounded-full m-2">
                    <div class="w-16 h-16">
                        <img src="{{ asset('img/Logo.svg') }}" class="w-full h-full" alt="logo">
                    </div>
                </div>
            </div>

            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                {!! $terms !!}
            </div>
        </div>
    </div>
</x-guest-layout>
