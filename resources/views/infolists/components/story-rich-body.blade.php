<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div>
        @php
            $story = $getRecord();
        @endphp
        <div class="py-12">
            <div class="max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
                    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                        <h1 class="mt-8 text-2xl font-medium text-gray-900">
                            {{ $story->title }}
                        </h1>
                    </div>
                    
                    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-12 md:grid-cols-12 gap-6 lg:gap-8 p-6 lg:p-8 place-items-center">
                        <div>
                            @php
                                $iindex = 0;
                            @endphp
                            @foreach ($story->paragraphs as $pindex => $paragraph)
                            <div class="grid w-full place-items-center text-gray-900 text-2xl leading-relaxed">
                                @if($paragraph && $pindex && isset($story->images[$iindex]))
                                <img class="rounded-lg mb-4" src="{{ $story->images[$iindex]->getUrl() }}" />
                                @php
                                    $iindex++;
                                @endphp
                                @endif
                                <p class="mb-10 p-10"> </p>
                                <p class="mb-10 p-10">{{ $paragraph }}</p>
                                <p class="mb-10 p-10"> </p>
                                <hr />
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dynamic-component>
