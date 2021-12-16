<button {{ $attributes->merge(['type' => 'submit', 'class' => 'flex justify-center px-4 py-2 text-sm font-medium text-white bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:border-gray-50 focus:ring-gray-100 active:bg-gray-50 transition duration-150 ease-in-out']) }}>
    {{ $slot }}
</button>
