<div>
    <x-form wire:submit.prevent="submitForm" action="/track/events">

        <x-input.group for="name" label="Event Name" :error="$errors->first('name')">
            <x-input.text
                wire:model.defer="name"
                type="text"
                >
            </x-input.text>
        </x-input.group>

        <x-input.group for="Categories" label="Categories" :error="$errors->first('category_id')">
           <x-input.select wire:model="category_id">
               <option value="">Category...</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
           </x-input.select>
        </x-input.group>

    </x-form>
</div>
