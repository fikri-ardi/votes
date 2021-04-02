<div x-data="{ display: @if($errors->any()) true @else false @endif }">

    <div x-show="display" class="fixed top-0 right-0 w-full h-full bg-black bg-opacity-20 flex">

        <div @click.away="display=false" class="m-auto bg-white py-5 px-10 w-1/2 rounded">
            <h1 class="text-lg">Create Poll</h1>

            <x-auth-validation-errors :errors="$errors" />

            <form action="{{ route('polls.store') }}" method="post" novalidate>
                @csrf
                <div class="mt-4">
                    <x-label for="title" :value="__('Title')" />
                    <x-input id="title" class="block mt-1 w-full" type="text" name="title" required autocomplete="title" />
                </div>

                <div class="mt-4">
                    <x-label for="description" :value="__('Description')" />
                    <x-textarea id="description" class="block mt-1 w-full resize-none" type="text" name="description" required autocomplete="description" />
                </div>

                <div class="mt-4">
                    <x-label for="deadline" :value="__('Deadline')" />
                    <x-input id="deadline" class="block mt-1 w-full" type="date" name="deadline" required autocomplete="deadline" />
                </div>

                <div x-data="{ fields:[0], index:1 }">
                    <template x-for="field in fields" :key="field">
                        <x-choice />
                    </template>
                </div>

                <div class="flex justify-end">
                    <x-button class="mt-5">
                        Add
                    </x-button>
                </div>

            </form>

        </div>

    </div>

    <x-button @click="display=true" class="fixed bottom-20 right-20">
        Create Poll
    </x-button>

</div>