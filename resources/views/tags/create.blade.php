<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <p>Create New Tag</p>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('tags.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-semibold leading-6 text-white">Tag name</label>
                           <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            <div class="mt-2.5">
                                <input type="text" name="name" id="name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="col-span-full mt-6 flex justify-center gap-x-6">
                            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add</button>
                        </div>
                    </form>

                    <h1 class="text-lg text-center">List of tags</h1>
                    @foreach($tags as $tag)
                        <a href="{{route('tags.edit', $tag->id)}}">    <li> {{ $tag->name }}</li> </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
