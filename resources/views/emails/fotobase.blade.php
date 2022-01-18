
<p>Beste {{ $project['name'] }},</p>

<p>U ontvangt dit mailtje omdat u heeft aangegeven gebruik te willen maken van een foto database. Wij raden aan om gebruik te maken van de volgende websites hiervoor (deze zijn volledig gratis):</p>
<p><a href="https://www.pexels.com/nl-nl/">https://www.pexels.com/nl-nl/</a></p>
<p><a href="https://unsplash.com/">https://unsplash.com/</a></p>
<p><a href="https://www.freepik.com/">https://www.freepik.com/</a></p>

<p>Mocht u hierover nog vragen hebben kunt u ons altijd een mail sturen!</p>

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