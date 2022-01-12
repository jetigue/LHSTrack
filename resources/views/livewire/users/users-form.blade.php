<div>
    <x-form wire:submit.prevent="submitForm" action="/users">

        <div class="flex flex-col space-y-2">
            <div>Username: <span class="font-semibold">{{ $user->name }}</span></div>
            <div>email: <span class="font-semibold">{{ $user->email }}</span></div>
        </div>

        <x-input.group for="User Roles" label="User Roles" :error="$errors->first('user_role_id')">
           <x-input.select wire:model="user_role_id">
               <option value="">Role...</option>
                @foreach($userRoles as $userRole)
                    <option value="{{ $userRole->id }}">
                        {{ $userRole->name }}
                    </option>
                @endforeach
           </x-input.select>
        </x-input.group>

    </x-form>
</div>
