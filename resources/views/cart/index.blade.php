@extends('template.template')

@section('content')
    <h1>Carrito de Compras</h1><br>
    @if(session('cart'))
        {{-- Definir la variable $total --}}
        @php $total = 0 @endphp

        <div class="container">
            <table class="">
                <thead class="bg-green-400">
                    <tr>
                        <th class="hidden md:table-cell">Imagen</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <tr class=" hover:border border-slate-500">
                            <td><img src="{{ asset('images/'. $details['image']) }}" alt="{{ $details['name'] }}" class="h-20 sm:h-32 object-cover rounded-lg m-auto"></td>
                            <td class="text-center hidden md:table-cell">{{ $details['name'] }}</td>
                            <td class="text-center">
                                <form action="{{ route('cart.update', $id) }}" method="post">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" class="w-14 sm:w-16"/>
                                    <button type="submit" class="p-2 bg-green-600 hover:text-white hover:bg-green-800"><i class='bx bx-reset'></i></i></button>
                                </form>
                            </td>
                            <td class="text-center">$ {{ number_format( $details['price'], 0, ',', '.' ) }}</td>
                            <td class="text-center">$ {{ number_format( $details['price'] * $details['quantity'], 0, ',', '.' )}}</td>
                            <td class="text-center">
                                <form action="{{ route('cart.remove', $id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="text-red-500 hover:text-red-900"><i class='bx bxs-trash'></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="text-center">
                        <td>
                            <form action="{{ route('cart.clear') }}" method="post">
                                @csrf
                                <button type="submit" class="inline-block p-2 text-sm font-medium text-red-500 bg-white hover:bg-red-200 rounded-md md:p-4">Vaciar Carrito</button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('productos.index') }}" class="inline-block p-2 text-sm font-medium text-green-800 bg-white hover:bg-green-400 rounded-md">Seguir Comprando</a>
                        </td>
                        <td>
                            <h3>Total: $ {{ number_format($total, 0, ',', '.') }}</h3>
                        </td>
                        <td>
                            <form action="{{ route('cart.AddDatasClient') }}" method="post">
                                @csrf
                                <button type="submit" class="inline-block p-2 text-sm font-medium text-white bg-green-600 hover:bg-green-800 rounded-md">Comprar</button>
                            </form>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
    @else
    <div class="flex justify-center items-center h-64">
        <p class="text-center bg-white m-1 p-4 w-[80%]">El carrito está vacío</p>
    </div>
        
    @endif
@endsection
