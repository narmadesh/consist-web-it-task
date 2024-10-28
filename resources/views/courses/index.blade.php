<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Courses') }}
            </h2>
            <a href="{{ route('courses.create') }}">
                <x-primary-button>Add new course</x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-auto">
                        <table class="table-fixed min-w-full divide-y divide-gray-200 text-left">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Name</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Description</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Instructor</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($courses) > 0)
                                    @foreach ($courses as $course)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">{{ $course->title }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">{{ $course->description }}</td>
                                            <td>{{$course->instructor->instructor->name}}</td>
                                            <td>
                                                <div class="flex gap-4">
                                                    <a href="{{route('courses.edit',['course' => $course])}}">
                                                        <x-primary-button>Edit</x-primary-button>
                                                    </a>
                                                    <form action="{{route('courses.destroy',['course' => $course])}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <x-danger-button>Delete</x-danger-button>
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
    </div>
</x-app-layout>
