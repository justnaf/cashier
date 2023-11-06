<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('cart.store') }}" method="POST" class="w-full max-w-sm mx-auto">
                        @csrf
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="por">
                                    Produk
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <select
                                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="por" name="products_id">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('products_id')" class="mt-2" />
                            </div>
                        </div>
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="nor">
                                    Quantity
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input
                                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight"
                                    id="nor" type="number" name="qty">
                                <x-input-error :messages="$errors->get('qty')" class="mt-2" />
                            </div>
                        </div>
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3"></div>
                            <div class="md:w-2/3">
                                <button
                                    class="mt-3 bg-green-500 hover:bg-green-400 font-extrabold text-white py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded"
                                    type="submit">
                                    Masukan Cart
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                @include('includes.alert')
                <br>
                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <div class="w-full md:w-1/2 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            Pembeli
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            id="grid-first-name" type="text" placeholder="Jane" name="buyer" required>
                    </div>
                    <button
                        class="mt-3 mb-3 bg-green-500 hover:bg-green-400 font-extrabold text-white py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded"
                        type="submit">
                        Checkout
                    </button>
                </form>
                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700 shadow-md">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th scope="col"
                                class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                Nama Produk
                            </th>
                            <th scope="col"
                                class="hidden md:table-cell py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                Jumlah
                            </th>
                            <th scope="col"
                                class="hidden md:table-cell py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                Subtotal
                            </th>
                            <th scope="col" class="p-4">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @php
                            $total = 0;
                        @endphp
                        @if (count($cart) > 0)
                            @foreach ($cart as $items)
                                @php
                                    $subtotal = $items->products->price * $items->qty;
                                @endphp
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td
                                        class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $items->products->name }}</td>
                                    <td
                                        class="hidden md:table-cell py-4 px-6 text-sm font-medium text-gray-500 whitespace-nowrap dark:text-white">
                                        {{ $items->qty }}</td>
                                    <td
                                        class="hidden md:table-cell py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ 'Rp. ' . number_format($subtotal, 0, 0, '.') }}
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                        <div class="flex space-x-1">
                                            {{-- <a href="{{ route('cart.edit', ['cart' => $items->id]) }}"
                                                class="text-blue-600 dark:text-blue-500 hover:underline">Edit</a> --}}
                                            <form action="{{ route('cart.update', ['cart' => $items->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="type" value="increment" class="sr-only">
                                                <button type="submit"
                                                    class="flex align-middle rounded-md bg-green-500 p-2">
                                                    <box-icon name='plus' color="white"></box-icon>
                                                </button>
                                            </form>
                                            <form action="{{ route('cart.update', ['cart' => $items->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="type" value="decrement" class="sr-only">
                                                <button type="submit"
                                                    class="flex align-middle rounded-md bg-orange-500 p-2">
                                                    <box-icon name='minus' color="white"></box-icon>
                                                </button>
                                            </form>
                                            <form action="{{ route('cart.update', ['cart' => $items->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Beneran Mau Hapus?')" type="submit"
                                                    class="flex bg-red-600 p-2 rounded-md align-middle">
                                                    <box-icon name='trash' color='white'></box-icon>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @php
                                    $total += $subtotal;
                                @endphp
                            @endforeach
                        @else
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td colspan="4" class="text-center text-sm text-gray-900 p-3">No Data Read</td>
                            </tr>
                        @endif
                    </tbody>
                    <tfoot class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <td colspan="2" scope="col"
                                class="md:hidden py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                {{ 'Total : ' . 'Rp. ' . number_format($total, 0, 0, '.') }}
                            </td>
                            <td colspan="2" scope="col"
                                class="hidden md:table-cell py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                Grand Total
                            </td>
                            <td scope="col"
                                class="hidden md:table-cell py-3 px-6 text-xs font-bold tracking-wider text-left text-black uppercase dark:text-gray-400">
                                {{ 'Rp. ' . number_format($total, 0, 0, '.') }}
                            </td>
                            <td scope="col" class="p-4">
                                <span class="sr-only">Total</span>
                            </td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
