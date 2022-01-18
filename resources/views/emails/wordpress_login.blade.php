
<p>Beste {{ $project['name'] }},</p>
<p>Ik heb net geprobeerd in te loggen in de Wordpress omgeving, maar ik krijg een foutmelding. Het lijkt erop dat de inloggegevens niet correct zijn.</p>
<p>Ik wil u dan ook graag verzoeken om mij nogmaals de inloggegevens toe te sturen. Bij voorbaat dank!</p>
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