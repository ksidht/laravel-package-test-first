@extends('layouts.app')
 
@section('title', 'Page Title')
 
@section('sidebar')
    @parent
    <!-- <a href={{ route('user.index') }}>Back</a> -->
@endsection
 
@section('content')

<div class="flex-1 py-9 px-6 mr-6">
<div class="flex">
<h2 class="text-3xl font-extrabold dark:text-white mb-8">Update User</h2>
<a href={{ route('user.index') }}>Back</a>
</div>
<form action={{ route('user.update',$user->id) }} method="post">
  @csrf
  @method('put')
  <div class="mb-6">
    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your Name</label>
    <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter your Name" value={{ old('name') ? old('name') : $user->name }}>
    @error('name')
    <div style="color: red">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-6">
    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your Email</label>
    <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" value={{ old('email') ? old('email') : $user->email }}>
    @error('email')
    <div style="color: red">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-6">
    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your password</label>
    <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    @error('password')
    <div style="color: red">{{ $message }}</div>
    @enderror
  </div>
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>
<div class="mt-6">
<form action={{ route('user.destroy',$user->id) }} method="post">
  @csrf
  @method('delete')
<button type="submit" class="text-white bg-red-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Delete</button>
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