@if($errors->{ $bag ?? 'default' }->any())
    <ul class="list-unstyled">
        @foreach($errors->{ $bag ?? 'default' }->all() as $error)
            <li class="text-danger">{{ $error }}</li>
        @endforeach
    </ul>
@endif
