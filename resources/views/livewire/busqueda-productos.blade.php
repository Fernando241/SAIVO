<div>
    <input type="text" wire:model="query" placeholder="Buscar productos..." class="form-control">

    @if (!empty($productos))
        <ul class="list-group mt-2">
            @foreach ($productos as $producto)
                <li class="list-group-item">
                    {{ $producto->nombre }}
                </li>
            @endforeach
        </ul>
    @endif
</div>

