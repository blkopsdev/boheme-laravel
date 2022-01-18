
<p>Beste {{ $project['name'] }},</p>

<p>U heeft aangegeven dat er extra functionaliteiten op de website moeten komen. Ik wil u graag verzoeken om alle informatie hierover via het onderstaand formulier naar ons toe te sturen.</p>

<p><a href="{{ route('extra_function', ['id' => $form['id'], 'token' => $form['token']]) }}">{{ route('extra_function', ['id' => $form['id'], 'token' => $form['token']]) }}</a></p>

@if ($project['testing_url'])
<p>U kunt de website bekijken op: <a href="{{ $project['testing_url'] }}">{{ $project['testing_url'] }}</a></p>
@endif

<p>Voor vragen kunt u mij altijd mailen of bellen.</p>

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