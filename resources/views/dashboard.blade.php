<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 px-1 md:px-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row space-y-3 md:space-y-0 space-x-0 md:space-x-3">
                <div class="row bg-green-200 border-2 border-green-600 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <h2 class="flex font-bold mb-2 content-center">
                        <box-icon name='package'></box-icon> Jumlah Produk
                    </h2>
                    <h3 class="text-xl md:text-5xl font-bold">{{count($produk)}}</h3>
                </div>
                <div class="row bg-orange-200 border-2 border-orange-600 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <h2 class="flex font-bold mb-2 content-center">
                        <box-icon name='cart'></box-icon> Jumlah Order
                    </h2>
                    <h3 class="text-xl md:text-5xl font-bold">{{count($order)}}</h3>
                </div>
                <div class="row bg-orange-200 border-2 border-orange-600 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <h2 class="flex font-bold mb-2 content-center">
                        <box-icon name='money'></box-icon> Omzet
                    </h2>
                    @if(count($order) == 0)
                    <h3 class="text-lg md:text-5xl font-bold">0</h3>
                    @else
                    <h3 class="text-lg md:text-2xl font-bold">{{"Rp. ".number_format($order->sum('subtotal'), 0, 0, '.')}}</h3>
                    @endif
                </div>
                @php
                $toppro = $produk->sortByDesc('stock')->take(5);
                $lesspro = $produk->sortBy('stock')->take(5);
                @endphp
                <div class="row bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <h2 class="font-bold mb-2">Stock Produk 5 Terbanyak</h2>
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700 shadow-md">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Nama Produk
                                </th>
                                <th scope="col" class="hidden md:table-cell py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Stock
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @if(count($toppro) == 0)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td colspan="6" class="text-center py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    No Data</td>
                            </tr>
                            @else
                            @foreach ($toppro as $pro)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="text-center py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$pro->name}}</td>
                                <td class="text-center py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$pro->stock}}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="row bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <h2 class="font-bold mb-2">Stock Produk 5 Tersedikit</h2>
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700 shadow-md">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Nama Produk
                                </th>
                                <th scope="col" class="hidden md:table-cell py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Stock
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @if(count($lesspro) == 0)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td colspan="6" class="text-center py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    No Data</td>
                            </tr>
                            @else
                            @foreach ($lesspro as $pro)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="text-center py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$pro->name}}</td>
                                <td class="text-center py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$pro->stock}}</td>
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
