<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Restocks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @include('includes.alert')
                    <a href="{{ route('restocks.create') }}">
                        <button
                            class="mt-3 bg-green-500 hover:bg-green-400 font-extrabold text-white py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded mb-3">Restock
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
                                @foreach ($data as $restock)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $restock->products->name }}</td>
                                        <td
                                            class="hidden md:table-cell py-4 px-6 text-sm font-medium text-gray-500 whitespace-nowrap dark:text-white">
                                            {{ $restock->stock }}</td>
                                        <td
                                            class="hidden md:table-cell py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ 'Rp. ' . number_format($restock->price, 0, 0, '.') }}</td>
                                        <td
                                            class="hidden lg:table-cell lg:py-4 lg:px-6 text-sm font-medium text-gray-900 lg:whitespace-nowrap dark:text-white">
                                            {{ $restock->created_at->locale('id')->translatedformat('l, d F Y') }}</td>
                                        <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                            <div class="flex space-x-1">
                                                <form
                                                    action="{{ route('restocks.destroy', ['restock' => $restock->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Beneran Mau Hapus?')"
                                                        type="submit"
                                                        class="flex bg-red-600 p-2 rounded-md align-middle">
                                                        <box-icon name='trash' color='white'></box-icon>
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