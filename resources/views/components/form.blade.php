@props([
    'method' => 'POST',
    'action' => ''
])

<form method="{{ $method === 'GET' ? 'GET' : 'POST' }}"
      action="{{ $action }}" {{ $attributes }}
>
    @csrf
    @if (! in_array($method, ['GET', 'POST']))
        @method($method)
    @endif
    <div class="space-y-2">
        {{ $slot }}
    </div>

</form>
