
<p>Beste {{ $project['name'] }},</p>

<p>Voordat wij aan de slag gaan met het bouwen van de website gaan wij beginnen om content te creëren voor uw website. U bent zelf het beste thuis in uw bedrijf en branche. Daarom wil ik u verzoeken om via de volgende link ons wat meer informatie te verschaffen, zodat de teksten perfect zullen worden afgestemd op uw bedrijf en branche.</p>

<p>U kunt de input hier aanleveren: <a href="{{ route('text_writing', ['id' => $form['id'], 'token' => $form['token']]) }}">{{ route('text_writing', ['id' => $form['id'], 'token' => $form['token']]) }}</a></p>

<p>Ik kijk uit naar de input!</p>

<p>Met vriendelijke groet,</p>


<p style="margin-bottom: 5px;"><strong>{{ $user['name'] }}</strong></p>
<p style="margin-top: 5px; margin-bottom: 5px;">{{ $user['occupation'] }}</p>
<p style="margin-top: 5px; margin-bottom: 5px;"><em>{{$user['phone']}}</em></p>
<p><img src="{{ asset('uploads/users/' . $user['image_name']) }}" alt="{{ $user['name'] }}" width="100"></p>
@if (strpos($user['website_url'], 'http') !== false) 
  <a href="{{ $user['website_url'] }}">{{$user['website_url']}}</a>
@else
  <a href="http://{{ $user['website_url'] }}">{{$user['website_url']}}</a>
@endif