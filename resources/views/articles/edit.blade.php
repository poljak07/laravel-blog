<x-layout>

<x-heading> Edit article "{{$article->title}}"</x-heading>
    <form action="{{route('articles.update', $article->id)}}" method="POST">
        @csrf
        @method('PATCH')
        <div>
            <label for="title" class="block text-sm font-semibold leading-6 text-gray-900">Title</label>
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
            <div class="mt-2.5">
                <input type="text" name="title" id="title" value="{{$article->title}}" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
        </div>

        <div class="sm:col-span-3">
            <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
            <div class="mt-2">
                <select id="category" name="category" autocomplete="category" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-span-full">
            <label for="content" class="block text-sm font-semibold leading-6 text-gray-900">Content</label>
            <x-input-error :messages="$errors->get('content')" class="mt-2" />
            <div class="mt-2">
                <textarea id="content" name="content" rows="10" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{$article->content }}</textarea>
            </div>
        </div>

        <div class="col-span-full">
            <label for="cover-photo" class="block text-sm font-semibold leading-6 text-gray-900">Cover photo</label>
            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                    </svg>
                    <div class="mt-4 flex text-sm leading-6 text-gray-600">
                        <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                            <span>Upload a file</span>
                            <input id="file-upload" name="file-upload" type="file" class="sr-only">
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                </div>
            </div>
        </div>

        <div class="mt-10 space-y-10">
            <fieldset>
                <legend class="text-sm font-semibold leading-6 text-gray-900">Tags include</legend>

                <div class="mt-6 space-y-6">
                    @foreach($tags as $tag)
                        <div class="relative flex gap-x-3">
                            <div class="flex h-6 items-center">
                                <input
                                    id="tag-{{ $tag->id }}"
                                    name="tags[]"
                                    type="checkbox"
                                    value="{{ $tag->id }}"
                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                    @checked(in_array($tag->id, $selectedTags))
                                >
                            </div>
                            <div class="text-sm leading-6">
                                <label for="tag-{{ $tag->id }}" class="font-medium text-gray-900">{{ $tag->name }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </fieldset>

        <div class="col-span-full mt-6 flex justify-center gap-x-6">
            <a  href="{{ route('articles.index') }}"type="button" class="text-sm font-semibold leading-6 text-red-600">Cancel</a>
            <button form="delete-form" class="text-sm font-semibold leading-6 text-red-600">Delete this article</button>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>



    <form method="POST" action="{{route('articles.destroy', $article->id)}}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</x-layout>
