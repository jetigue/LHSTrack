<button {{ $attributes->merge(['type' => 'submit', 'class' => 'flex w-full justify-center px-4 py-2 text-sm font-medium text-white bg-red-800 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:border-white focus:ring-white active:bg-gray-red-700 transition duration-150 ease-in-out']) }}>
    {{ $slot }}
</button>
