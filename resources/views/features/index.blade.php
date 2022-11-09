@extends('layouts.flowbite')

@section('title', 'Page Title')

@section('sidebar')
@parent
@endsection

@section('content')


<div class="flex-1 py-9 px-6">
  <div>
    <h2 class="text-3xl font-extrabold dark:text-white my-8">
      Features
    </h2>

    <div class="flex justify-between">
      <form action={{ route('features.index') }}>
        <div class="flex">
          <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Your Email</label>
          <button 
            id="dropdown-button" 
            data-dropdown-toggle="dropdown" 
            class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 dark:border-gray-700 dark:text-white rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800" 
            type="button">
            All categories
            <svg aria-hidden="true" class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
          </button>
          <div 
            id="dropdown" 
            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 block" 
            data-popper-reference-hidden="" 
            data-popper-escaped="" 
            data-popper-placement="bottom" 
            style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(4.5px, 72px, 0px);">
            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
              <li>
                <a 
                  href={{ route('features.index') }} 
                  class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                  <br>
                </a>
              </li>
              <li>
                <a 
                  href={{ route('features.index')."?trashed=with" }} 
                  class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                  With Trashed
                </a>
              </li>
              <li>
                <a 
                  href={{ route('features.index')."?trashed=only" }} 
                  class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                  Only Trashed
                </a>
              </li>
            </ul>
          </div>
          <div class="relative w-full">
            <input 
              name="search" 
              type="search" 
              id="search-dropdown" 
              class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-100 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" 
              placeholder="Search" 
              value="{{ request()->get('search') }}" 
            />
            <button 
              type="submit" 
              class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
            </button>
          </div>
        </div>
      </form>

      <button 
        type="button" 
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        <a href={{ route('features.create') }}>Create</a>
      </button>
    </div>

    <div class="overflow-x-auto relative shadow-md sm:rounded-lg mt-4">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="py-3 px-6">Name</th>
            <th scope="col" class="py-3 px-6">Slug</th>
            <th scope="col" class="py-3 px-6">Status</th>
            <th scope="col" class="py-3 px-6">Action</th>
          </tr>
        </thead>
        <tbody id="content">
          @foreach ($features as $role)
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <th scope="row" class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap dark:text-white">
              <div class="pl-3">
                <div class="text-base font-semibold">{{ $role->name }}</div>
                <div class="font-normal text-gray-500">
                  {{ $role->email }}
                </div>
              </div>
            </th>
            <td class="py-4 px-6">{{ $role->slug }}</td>
            <td class="py-4 px-6">
              <div class="flex items-center">
                <div class="h-2.5 w-2.5 rounded-full {{ $role->deleted_at == null ? 'bg-green-400' : 'bg-red-400' }}  mr-2"></div>
                {{ $role->deleted_at == null ? 'Active' : 'Deactive' }}
              </div>
            </td>
            <td class="py-4 px-6">
              <a href={{ route('features.edit', $role->id) }} class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit role</a>
            </td>
          </tr>
          @endforeach

          @if (count($features) === 0)
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <th class="py-4 px-6" colspan="4">No data found</th>
          </tr>
          @endif
        </tbody>
      </table>

      <!-- Pagination  -->
      <div class="px-4 py-3 sm:px-6">
        {{ $features->links() }}
      </div>  

    </div>

  </div>
</div>

@endsection

@once
@push('scripts')
  <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
@endpush
@endonce