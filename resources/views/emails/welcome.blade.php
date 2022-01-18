
<p>Beste {{ $project['name'] }},</p>

<p>Ik wil u van harte welkom heten namens het gehele team bij IQ Script!</p>

<p>Bij IQ Script bieden wij met trots alle online diensten aan voor het MKB en ZZP: van uw website tot online marketing! Onze klanten staan altijd centraal in onze organisatie. Wij werken dan ook zeven dagen per week om ervoor te zorgen dat wij al uw projecten naar 100% tevredenheid opleveren. Zolang u klant bij ons bent staan wij altijd voor u klaar.</p>

<p>Bij deze wil ik u informeren dat ik uw primaire aanspreekpunt voor het bedrijf zal zijn en ik moedig u aan om op elk gewenst moment contact met mij op te nemen met uw vragen of opmerkingen. Verder werken wij via IQ-formulieren om alle input voor het project zo goed mogelijk in kaart te brengen. Wij koppelen vervolgens deze input aan uw project en zorgen zo dat wij optimaal te werk kunnen gaan om uw wensen en eisen tot werkelijkheid te brengen.</p>

<p>Wij kijken uit naar een prettige samenwerking, en zullen altijd 100% inzet geven om samen het gewenste resultaat te behalen.</p>

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