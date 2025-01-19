@extends('template.template')

@section('content')
    <h1>Carrito de Compras</h1><br>
    @if(session('cart'))
    <div class="container">
        <table class="">
            <thead class="bg-green-400">
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $id => $details)
                    <tr class="p-4 hover:border border-slate-500">
                        <td><img src="{{ asset('images/'. $details['image']) }}" alt="{{ $details['name'] }}" class="h-32 object-cover rounded-lg m-auto"></td>
                        <td class="text-center">{{ $details['name'] }}</td>
                        <td class="text-center">
                            <form action="{{ route('cart.update', $id) }}" method="post">
                                @csrf
                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" class="w-20"/>
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
        </table>
    </div>
        
    @else
        <p class="text-center bg-white m-1 p-4 w-[80%]">El carrito está vacío</p>
    @endif
@endsection
