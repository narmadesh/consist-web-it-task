<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add new course') }}
            </h2>
            <a href="{{ route('courses.index') }}">
                <x-primary-button>Back</x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('courses.store') }}" method="post" class="flex flex-col gap-4">
                        @csrf
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <x-textarea-input id="description" name="description" type="text"
                                class="mt-1 block w-full"></x-textarea-input>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="instructor" :value="__('Instructor')" />
                            <x-select id="instructor" name="instructor" class="mt-1 block w-full">
                                <option value="">Select</option>
                                @if (count($instructors) > 0)
                                    @foreach ($instructors as $instructor)
                                        <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                                    @endforeach
                                @endif
                            </x-select>
                            <x-input-error :messages="$errors->get('instructor')" class="mt-2" />
                        </div>
                        <div>
                            <x-primary-button>Submit</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
