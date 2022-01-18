<p>Beste {{ $project->user->name }},</p>

<p>Er zijn nieuwe antwoorden beschikbaar voor: {{ $project['project_name'] }} </p>
<p>Klik hier om de antwoorden te bekijken: 
    @switch($project['space'])
        @case(1)
            <a href="{{ route('website', $project['id']) }}">{{ route('website', $project['id']) }}</a>    
        @break
        
        @case(2)
            <a href="{{ route('custom_website', $project['id']) }}">{{ route('custom_website', $project['id']) }}</a>    
        @break
        
        @case(3)
            <a href="{{ route('webshop.show', $project['id']) }}">{{ route('webshop.show', $project['id']) }}</a>    
        @break

        @case(4)
            <a href="{{ route('custom_webshop.show', $project['id']) }}">{{ route('custom_webshop.show', $project['id']) }}</a>    
        @break    
    @endswitch
</p>

<p>Met vriendelijke groet,</p>
<p>IQ Script</p>