<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @include('includes.alert')
                    <a href="{{ route('products.create') }}">
                        <button
                            class="mt-3 bg-green-500 hover:bg-green-400 font-extrabold text-white py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded mb-3">Tambah
                            Produk</button>
                    </a>
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700 shadow-md">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Nama Produk
                                </th>
                                <th scope="col"
                                    class="hidden md:table-cell py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Stock
                                </th>
                                <th scope="col"
                                    class="hidden md:table-cell py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Harga
                                </th>
                                <th scope="col"
                                    class="hidden lg:table-cell lg:py-3 lg:px-6 text-xs font-medium lg:tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Created
                                </th>
                                <th scope="col"
                                    class="hidden lg:table-cell lg:py-3 lg:px-6 text-xs font-medium lg:tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Last Update
                                </th>
                                <th scope="col" class="p-4">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @if (count($data) < 1)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td colspan="6"
                                        class="text-center py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        No Data</td>
                                </tr>
                            @else
                                @foreach ($data as $product)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $product->name }}</td>
                                        <td
                                            class="hidden md:table-cell py-4 px-6 text-sm font-medium text-gray-500 whitespace-nowrap dark:text-white">
                                            {{ $product->stock }}</td>
                                        <td
                                            class="hidden md:table-cell py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ 'Rp. ' . number_format($product->price, 0, 0, '.') }}</td>
                                        <td
                                            class="hidden lg:table-cell lg:py-4 lg:px-6 text-sm font-medium text-gray-900 lg:whitespace-nowrap dark:text-white">
                                            {{ $product->created_at->locale('id')->diffForHumans() }}</td>
                                        <td
                                            class="hidden lg:table-cell py-4 px-6 text-sm font-medium text-gray-900 lg:whitespace-nowrap dark:text-white">
                                            {{ $product->updated_at->locale('id')->diffForHumans() }}</td>
                                        <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                            <div class="flex space-x-1">
                                                <a href="{{ route('products.edit', ['product' => $product->id]) }}"
                                                    class="flex bg-orange-400 align-middle p-2 rounded-md">
                                                    <box-icon name='edit' color='white'></box-icon>
                                                </a>
                                                <form
                                                    action="{{ route('products.destroy', ['product' => $product->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Beneran Mau Hapus?')"
                                                        type="submit"
                                                        class="flex bg-red-600 p-2 rounded-md align-middle">
                                                        <box-icon name='trash' color='white'></box-icon>
                                                    </button>
                                                </form>
                                                <form action="{{ route('cart.store') }}" method="POST">
                                                    <input type="text" readonly name="products_id"
                                                        value="{{ $product->id }}" class="sr-only">
                                                    @csrf
                                                    <button type="submit"
                                                        class="bg-green-500 p-2 rounded-md flex align-middle">
                                                        <box-icon name='cart' color='white'></box-icon>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
