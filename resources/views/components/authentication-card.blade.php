<div class="min-h-screen flex flex-col sm:justify-center items-center pt-4 sm:pt-0 bg-emerald-100">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full lg:max-w-screen-lg md:max-screen-md mx-auto sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
