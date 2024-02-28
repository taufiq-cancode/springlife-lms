@foreach($comments as $comment)
    <div class="comment">
        <p>{{ $comment->content }}</p>
        <p>Posted by: {{ $comment->user->name }}</p>
        
        {{-- Display replies recursively --}}
        @if(count($comment->replies) > 0)
            <div class="replies">
                @include('partials.comments', ['comments' => $comment->replies])
            </div>
        @endif

        {{-- Reply form --}}
        <form action="{{ route('reply.store', ['courseId' => $course->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
            <textarea name="content" placeholder="Reply to this comment"></textarea>
            <button type="submit">Reply</button>
        </form>
    </div>
@endforeach
