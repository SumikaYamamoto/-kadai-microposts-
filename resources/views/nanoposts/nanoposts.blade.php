<ul class="media-list">
@foreach ($nanoposts as $nanopost)
    <?php $user = $nanopost->user; ?>
    <li class="media">
        <div class="media-left">
            <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
        </div>
        <div class="media-body">
            <div>
                {!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!} <span class="text-muted">posted at {{ $nanopost->created_at }}</span>
            </div>
            <div>
                <p>{!! nl2br(e($nanopost->content)) !!}</p>
            </div>
            <div>
                @if (Auth::id() == $nanopost->user_id)
                    {!! Form::open(['route' => ['nanoposts.destroy', $nanopost->id], 'method' => 'delete']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </li>
@endforeach
</ul>
{!! $nanoposts->render() !!}