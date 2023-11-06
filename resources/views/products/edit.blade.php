<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products > Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('products.update', ['product' => $data->id]) }}" method="POST"
                        class="w-full max-w-sm mx-auto" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="nor">
                                    Nama Products
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input
                                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight"
                                    id="nor" type="text" name="name" value="{{ $data->name }}">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="st">
                                    Stock
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input
                                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight"
                                    id="st" type="number" name="stock" value="{{ $data->stock }}">
                                <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                            </div>
                        </div>
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="cs">
                                    Cost
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input
                                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight"
                                    id="cs" type="number" name="cost" value="{{ $data->cost }}">
                                <x-input-error :messages="$errors->get('cost')" class="mt-2" />
                            </div>
                        </div>
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="pr">
                                    Price
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input
                                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight"
                                    id="pr" type="number" name="price" value="{{ $data->price }}">
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>
                        </div>

                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="pt">
                                    Picture
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input
                                    class="file:bg-gray-500 file:border-0 file:p-2 file:rounded-l-lg file:text-white file:font-bold bg-gray-200 rounded-r-lg w-full"
                                    id="pt" type="file" name="pic">
                                <x-input-error :messages="$errors->get('pic')" class="mt-2" />
                            </div>
                        </div>
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3"></div>
                            <div class="md:w-2/3">
                                <button
                                    class="mt-3 bg-green-500 hover:bg-green-400 font-extrabold text-white py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded"
                                    type="submit">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
