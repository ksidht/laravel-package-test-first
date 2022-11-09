@extends('layouts.flowbite')

@section('title', 'Page Title')

@section('sidebar')
@parent
<!-- <a href={{ route('roles.index') }}>Back</a> -->
@endsection

@section('content')

<div class="flex-1 py-9 px-6 mr-6 max-w-2xl">
  <div class="flex justify-between items-center">
    <h2 class="text-3xl font-extrabold dark:text-white my-8">Update Role</h2>
    <button type="button" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
      <a href={{ route('roles.index') }}>Back</a>
    </button>
  </div>
  <form action={{ route('roles.update', $role->id) }} method="post">
    @csrf
    @method('put')
    <div class="mb-6">
      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Role Name</label>
      <input 
        type="text" 
        id="name" 
        name="name" 
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
        placeholder="Editor" 
        value={{ old('name') ? old('name') : $role->name }}>
      @error('name')
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
      @enderror
    </div>
    <div class="mb-6">
      <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your Slug</label>
      <input 
        type="slug" 
        id="slug" 
        name="slug" 
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
        placeholder="name@flowbite.com" 
        value={{ old('slug') ? old('slug') : $role->slug }}>
      @error('slug')
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
      @enderror
    </div>

    <button 
      type="submit" 
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
      Update
    </button>
  </form>

  <div class="mt-6">
    <form action={{ route('roles.destroy', $role->id) }} method="post">
      @csrf
      @method('delete')
      <button 
        type="submit" 
        class="text-white bg-red-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Delete
      </button>
    </form>
  </div>
</div>
@endsection

@once
@push('scripts')
<script>

</script>
@endpush
@endonce