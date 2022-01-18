<p>Beste {{ $project['name'] }},</p>
<p>Wij hebben ook de laatste stappen in orde gemaakt. U kunt de website zien op : <a href="{{ $project['website_url'] }}">{{ $project['website_url'] }}</a></p>
<p>We hebben ook een aanvraag ingediend bij Google om de website zo snel mogelijk goed te indexeren. Houd er echter wel rekening mee dat het 2-4 weken kan duren voordat Google de website heeft geïndexeerd en dat de resultaten hiervan zichtbaar zijn.</p>
<p>Tot nu toe ervaren wij het als een prettige samenwerking en hopen dit samen de komende jaren door te zetten. Uiteraard streven we er ook in de toekomst naar om u zo goed mogelijk te helpen hiervoor zijn we altijd bereikbaar van 09:00 tot 18:00 op doordeweekse dagen. In het weekend en de avond uren kunt u ons wel altijd bereiken voor spoed gevallen.</p>
<p>We bieden ook een vervolg traject aan waarin we het maximale uit uw website gaan halen. Hierin gaan we met de website aan de slag waarin wij gaan zorgen dat we de juiste doelgroep met de website gaan bereiken. Ik hoor graag of u daar interesse in zou hebben.</p>
<p>Als laatste hebben wij een Wordpress cursus gemaakt waarin wij u stap voor stap uitleggen hoe u zelf de website kunt beheren/aanpassen. U kunt inloggen op de cursus met de volgende gegevens:</p>
<p><strong>Link:</strong> <a href="http://uitleg.iqscript.nl/">http://uitleg.iqscript.nl/</a></p>
<p><strong>Gebruiker:</strong> iqscript</p>
<p><strong>Ww: </strong> Welkom01!</p>
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