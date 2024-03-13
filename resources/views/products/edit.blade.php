@extends('main')

@section('content')
<div class="p-6 bg-white border-b border-gray-200">
    <form action="{{ route('products.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
        
        @csrf
        @method('PUT')
        
        <div class="sm:col-span-3">
            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Product Name</label>
            <div class="mt-2">
              <input type="text" name="name" id="name" value="{{ $product->name }}" autocomplete="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
            @error('name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-span-3">
            <label for="slug" class="block text-sm font-medium leading-6 text-gray-900">Slug</label>
            <div class="mt-2">
              <input type="text" name="slug" id="slug" value="{{ $product->slug }}" autocomplete="slug" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
            @error('slug')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-span-full">
            <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
            <div class="mt-2">
              <textarea id="description" name="description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ $product->description }}</textarea>
            </div>
            <p class="mt-3 text-sm leading-6 text-gray-600">Write the product description</p>
            @error('description')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
          </div>
        <div class="col-span-3">
            <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
            <div class="mt-2">
              <select id="category_id" name="category_id" autocomplete="category-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
            @error('category_id')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-span-full">
            <label for="image" class="block text-sm font-medium leading-6 text-gray-900">Image</label>
            <div class="mt-2">
              <input type="file" name="image" id="name" />
            </div>
            @error('image')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-6 flex items-center gap-x-6">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>
</div>
@endsection