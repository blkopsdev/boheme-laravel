<p>Beste {{ $project['name'] }},</p>

<p>Het webdesign is gebouwd! U kunt het gebouwde webdesign bekijken op: <a href="{{ $project['testing_url'] }}">{{ $project['testing_url'] }}</a>. </p>
<p>Ik wil eerst de homepagina helemaal in orde maken voordat we verder gaan met de rest van de website. Hiervoor wil ik u verzoeken om via de onderstaande link feedback op het webdesign te geven. Soms kan het namelijk toch anders eruit zien nadat het gebouwd is.</p>

<p>U kunt de feedback via de volgende link naar ons sturen: <a href="{{ route('first_home', ['id' => $form['id'], 'token' => $form['token']]) }}">{{ route('first_home', ['id' => $form['id'], 'token' => $form['token']]) }}</a></p>

<p>Mocht u geen feedback hebben zou u dit mij dan kunnen laten weten? Dan kan ik namelijk beginnen om de rest van de pagina’s te bouwen.</p>

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