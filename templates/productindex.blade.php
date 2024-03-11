@extends('main')

@section('content')
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Product name
                </th>
                <th scope="col" class="px-6 py-3">
                    Slug
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Category
                </th>
                <th scope="col" class="px-6 py-3">
                    Image
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $product->name }}
                </th>
                <td class="px-6 py-4">
                    {{ $product->slug}}
                </td>
                <td class="px-6 py-4">
                    {{ $product->description }}
                </td>
                <td class="px-6 py-4">
                    {{ $product->category_id }}
                </td>
                <td class="px-6 py-4">
                    <img src="{{ asset("storage/" . $product->image) }}" />
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection