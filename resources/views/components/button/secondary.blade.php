<button {{ $attributes->merge(['type' => 'button', 'class' => 'flex justify-center px-4 py-2 text-sm font-medium text-white bg-black border border-transparent rounded-md hover:bg-gray-800 focus:outline-none focus:border-gray-800 active:bg-gray-800 transition duration-150 ease-in-out']) }}>
    {{ $slot }}
</button>

