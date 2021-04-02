<div class="p-6 bg-white border-b border-gray-200">
    <div class="flex justify-between">
        <div>
            <div class="text-lg text-gray-800">{{ $poll->title }}</div>
            <small class="text-gray-400">{{ $poll->user->name .' | '. $poll->deadline }}</small>
        </div>
        @if(auth()->user()->role == 'admin')
            <form action="{{ route('polls.destroy', $poll->id) }}" method="post">
                @csrf
                @method('delete')
                <x-button onclick="return confirm('Are you sure wanna delete this poll?')">Delete</x-button>
            </form>
        @endif
    </div>

    <p style="line-height: 3;">{{ $poll->description }}</p>

    <?php 
        for ($i=0; $i < count($poll->choices); $i++) { 
            $choicePoints[$i] = 0;
        }
    
        foreach ($divisions as $division) {
            $votesForEachChoice = [];
            $num = 0;
            
            foreach ($poll->choices as $choice) {
                $votesForEachChoice[$num++] = count($poll->votes->where('division_id', $division->id)->where('choice_id', $choice->id));
            }

            $highestVote = max($votesForEachChoice);
            $allHighestVotes = 0;

            foreach ($votesForEachChoice as $vote) {
                if ($vote == $highestVote && $highestVote != 0) {
                    $allHighestVotes++;
                }
            }

            for ($i=0; $i < count($poll->choices); $i++) {
                if ($votesForEachChoice[$i] == $highestVote && $highestVote != 0) {
                    $choicePoints[$i] += 1/$allHighestVotes;
                }
            }
        }

        $AlreadyVoted = false;
        foreach ($poll->votes as $vote) {
            if ($vote->user_id == auth()->id()) {
                $AlreadyVoted = true;
                break;
            }else $AlreadyVoted = false;
        }

     ?>


    @if(auth()->user()->role != 'admin' && !$AlreadyVoted)
        @foreach($poll->choices as $choice)
            <form action="{{ route('votes.store', [$poll->id, $choice->id]) }}" method="post" class="inline-block my-4">
                @csrf
                <x-button>{{ $choice->name }}</x-button>
            </form>
        @endforeach
    @endif

    @if(auth()->user()->role == 'admin' || $AlreadyVoted)
        @for($i = 0; $i < count($poll->choices); $i++)
            <div class="my-4">
                <span>{{ $poll->choices[$i]->name }} :</span>
                <span class="relative">
                    <span class="bg-gray-200 rounded absolute top-2 left-2" style="width: 100px; height: 8px;"></span>
                    <span class="bg-gray-800 rounded absolute top-2 left-2" style="width: {{ $choicePoints[$i] == 0 ? 0 : number_format( $choicePoints[$i]/array_sum($choicePoints)*100 ) }}px; height: 8px;"></span>
                </span>
                <span style="margin-left: 120px;">{{ $choicePoints[$i] == 0 ? 0 : number_format( $choicePoints[$i]/array_sum($choicePoints)*100, 2, '.' ) }}%</span>
            </div>
        @endfor
    @endif

</div>