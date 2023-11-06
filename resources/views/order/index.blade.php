<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @include('includes.alert')
                    <table class="mt-3 min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700 shadow-md">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Pembeli
                                </th>
                                <th scope="col"
                                    class="hidden md:table-cell py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Total
                                </th>
                                <th scope="col"
                                    class="hidden lg:table-cell lg:py-3 lg:px-6 text-xs font-medium lg:tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Timestamp
                                </th>
                                <th scope="col" class="p-4">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @if (count($data) < 1)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td colspan="4"
                                        class="text-center py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        No Data</td>
                                </tr>
                            @else
                                @foreach ($data as $order)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $order->buyer }}</td>
                                        <td
                                            class="hidden md:table-cell py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ 'Rp. ' . number_format($order->orderdetail->sum('subtotal'), 0, 0, '.') }}
                                        </td>
                                        <td
                                            class="hidden lg:table-cell lg:py-4 lg:px-6 text-sm font-medium text-gray-900 lg:whitespace-nowrap dark:text-white">
                                            {{ $order->created_at->locale('id')->translatedFormat('l, d F Y') }}</td>
                                        <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                            <div class="flex space-x-1">
                                                <a href="{{ route('order.show', ['id' => $order->id]) }}"
                                                    class="bg-green-500 flex align-middle p-2 rounded-md">
                                                    <box-icon name='show' color="white"></box-icon>
                                                </a>
                                                <form action="{{ route('order.destroy', ['id' => $order->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Beneran Mau Hapus?')"
                                                        type="submit"
                                                        class="flex align-middle rounded-md bg-red-500 p-2">
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
