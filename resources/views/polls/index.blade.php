<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if(auth()->user()->role == 'admin')
                    <x-fab />
                @endif
                
                @forelse($polls as $poll)
                    @if($poll->deadline >= date('Y-m-d H:i:s'))
                        <x-poll :poll="$poll" :divisions="$divisions" />
                    @endif
                @empty

                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
