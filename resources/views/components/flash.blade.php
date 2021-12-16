    <div>
        @if (session()->has('success'))
            <div x-data="{ show: true }"
                 x-init="setTimeout(() => show = false, 3500)"
                 x-show="show"
                class="fixed top-4 right-4 text-white bg-green-500 text-white py-2 px-3 rounded-md">
                {{ session('success') }}
            </div>
        @endif
    </div>
