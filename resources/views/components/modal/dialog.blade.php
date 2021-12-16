@props(['id' => null, 'maxWidth' => null])

<x-modal.modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg font-semibold border-b-2 border-red-800">
            {{ $title }}
        </div>

        <div class="mt-4">
            {{ $content }}
        </div>
    </div>

    <div class="flex px-6 py-4 bg-gray-100 justify-end space-x-4 rounded-b-lg">
        {{ $footer }}
    </div>
</x-modal.modal>

