<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[url('/img/homepage-bg.svg')] bg-blend-overlay bg-prims-azure-900 bg-opacity-50">
    <div class="w-full sm:max-w-md px-6 py-4 bg-prims-yellow-5 shadow-md overflow-hidden sm:rounded-lg">
        <div class="flex justify-center my-3">
            {{ $logo }}
        </div>
        {{ $slot }}
    </div>
</div>
