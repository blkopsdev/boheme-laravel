<html>
<head>
  <style>
    @page { margin: 100px 25px; }
    
    header { position: fixed; top: -60px; left: 0px; right: 0px; text-align:right; }
    footer {position: fixed; bottom: -90px; left: 0px; right: 0px; height: 50px; text-align:center; border-top: 1px solid blue; width: 100%;padding-top: 10px;}
    p {font-size: 16px;}
    .page-number:before {
      content: "Page " counter(page);
    }
    p.next {
      page-break-after: always;
    }
    h3 {
      font-weight: 500;
    }
    .images {
      display: block;
      width: 100%;
      float: left
    }
  </style>
</head>
<body style="font-family: sans-serif;">
  <header><img src="{{asset('assets/img/logo.png')}}" width="150" alt=""></header>
  <footer><span style="float:right">Copyright IQ Script ©</span></footer>
  <main>
    <div class="content">
      <div class="container-fluid">
        <h1><strong>Website :</strong> Hosting</h1>
        <p><strong>Bedrijf:</strong> {{$project->company_name}}</p>
        <p><strong>Klant naam:</strong> {{$project->name}}</p>
        <p><strong>Testserver URL:</strong>  <a href="{{$project->testing_url}}" target="_blank">{{$project->testing_url}}</a></p><br><br>

        <p><em>Please note: If needed you can use Google Translate to translate the questions given by the client:</em></p><br><br>
        
        <h3><strong>1. Wilt u de website bij ons hosten?: @if($data->hosting == 1) Ja @elseif($data->hosting == 2) Nee @endif</strong></h3>
        @if ($data->hosting == 1)
          <p>
            <strong>Pakket: </strong>
            @if ($data->type == 1)
              Basic
            @elseif($data->type == 2)
              Premium
              @elseif($data->type == 3)
              Professional
            @endif
          </p>
          <h4><strong>Automatische incasso</strong></h4>
          <p><strong>Bankreking:</strong> {{ $data->bank_info }}</p>
          <p><strong>T.A.V:</strong> {{ $data->tav }}</p>
          <p><strong>Ik ga akkoord met de Algemene Voorwaarden: </strong> {{ $data->agree_terms == 1? 'akkoord': '' }}</p>
          <p><strong>Ik ga akkoord met de maandelijkse incasso:</strong> {{ $data->agree_fee == 1? 'akkoord': '' }}</p>
        @elseif ($data->hosting == 2)
          <h4><strong> Heeft u een wordpress website: {{ $data->have_site == 1? 'Ja': 'Nee'}}</strong></h4>
          @if ($data->have_site == 1)
          <p><strong>Inloggegevens wordpress:</strong></p>
          <p><strong>Url inlogscherm: </strong>{{ $data->wp_url }}</p>
          <p><strong>Gebruikersnaam / email: </strong>{{ $data->wp_username }}</p>
          <p><strong>Wachtwoord: </strong>{{ $data->wp_password }}</p>
          @else
          <p><strong>Ik ben mij bewust van extra kosten: </strong> {{ $data->aware_cost = '1'? 'Ja':'Nee' }}</p>
          @endif
        @endif
        <br><br>

        <h3><strong>2. Domeinnaam: {{ $data->domain_name }}</strong></h3>
        <p><strong>Inloggegevens provider:</strong></p>
        <p><strong>Naam provider: </strong>{{ $data->domain_provider }}</p>
        <p><strong>Gebruikersnaam: </strong>{{ $data->domain_username }}</p>
        <p><strong>Wachtwoord: </strong>{{ $data->domain_password }}</p>
        <br><br>
        <h3><strong>3. Google Analytics: {{ $data->google_analytics == 1 ? 'Ja' : 'Nee' }}</strong></h3>
        @if ($data->google_analytics == 1)
        <p><strong>Gmail: </strong>{{ $data->gmail_account }}</p>
        @endif
        <br><br>

        <h4><strong>Stappenplan website online zetten:</strong></h4>
        <p>Stap 1: Ga naar de domein provider (zie vraag 2) en login.</p>
        <p>Stap 2: Ga naar de DNS instellingen van het domein.</p>
        <p>Stap 3: Zorg dat je een screenshot maakt van de instellingen en deze upload in de project pagina.</p>
        <p>Stap 4: Hierna moet je alle AAA records verwijderen mochten deze zijn ingesteld. Bij alle A records verander je alleen het IP adres naar: 149.210.188.218</p>
        <p>Stap 5: Ga naar <a href="https://server.anewday.nl:2222/">https://server.anewday.nl:2222/</a> en login met de volgende gegevens: User: dropjobr , Ww: zeIOa6VR</p>
        <p>Stap 6: Navigeer naar -> List users -> Create User… Zorg dat je hier een herkenbare username gebruikt (bijv: de bedrijfsnaam), voor de email gebruik: bedrijfsnaam@dropjob.nl, Zorg dat je het wachtwoord opschrijft in de project pagina.</p>
        <p>Stap 7:  Ga weer terug naar de “List users” -> zoek het aangemaakt account op en klik op “Login as &lt;name&gt;”</p>
        <p>Stap 8: Ga naar “Domain setup” -> klik op de domeinnaam -> Zorg dat je bij “private_html setup for &lt;name&gt;” de optie selecteerd: “Use a symbolic link from private_html to …. https” & selecteer ook de laatste PHP versie (7.2)  LET OP: je moet na elke aangepaste optie op “save” drukken.</p>
        <p>Stap 9: Ga naar installatron -> Applications Browser -> Selecteer Wordpress -> Install this application -> Selecteer het domein (Let op: Directory dient leeg te zijn, verwijder blog) -> Zorg dat je bij “Settings” de volgende inlog zet: Username: admin, Password: Test20.000!</p>
        <p>Stap 10: Zorg dat je bij de nieuwe wordpress installatie de volgende plugins installeerd: All-in one WP migration (deze kun je vinden in de plugin directory) & <a href="http://portal.iqscript.nl/wp-content/uploads/2020/07/all-in-one-wp-migration-unlimited-extension.zip">http://portal.iqscript.nl/wp-content/uploads/2020/07/all-in-one-wp-migration-unlimited-extension.zip</a></p>
        <p>Stap 11: Ga naar de testomgeving en exporteer de website naar een “File”</p>
        <p>Stap 12: Upload het geexporteerde bestand naar de nieuwe wordpress installatie</p>
        <p>Stap 13: Ga nu weer terug naar <a href="https://server.anewday.nl:2222/">https://server.anewday.nl:2222/</a> en ga weer naar het juiste klant account -> Kies dan “SSL Certificates” -> Selecteer het tweede vinkje -> “Free & Automatic certificate from Let’s Encrypt”</p>
        <p>Stap 14: Ga terug naar Wordpress en installeer de plugin: Really Simple SSL</p>
        <p>Stap 15: Check dan de website op de volgende onderwerpen: Staat er geen “My Blog” meer in het tablad, doen de contact formulieren het?</p>
        <p>Stap 16: Zorg dat je Google Analytics koppelt aan de website. Let op: als de klant heeft aangegeven om ook Google Analytics te willen in zien dan moet je deze toevoegen als gebruiker. </p>
      </div>
    </div>
  </main>
</body>
</html>