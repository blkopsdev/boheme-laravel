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
    h2 {
      font-weight: 500;
    }
    .images {
      display: block;
      width: 100%;
      float: left
    }
    h1, h2, h2, h4, h5 {
      font-family: sans-serif !important;
    }
  </style>
</head>
<body style="font-family: sans-serif;">
  <header><img src="{{asset('assets/img/logo.png')}}" width="150" alt=""></header>
  <footer><span style="float:right">Copyright IQ Script ©</span></footer>
  <main>
    <div class="content">
      <div class="container-fluid">
        <h1><strong>Website :</strong> Webteksten briefing</h1>
        <br><br>
        <p><em>Please note: If needed you can use Google Translate to translate the questions given by the client:</em></p><br><br>

        <h2><strong>1. Beschrijf de markt waarin u actief bent:</strong></h2>
        <p>{{ $data->market ? $data->market : ''}}</p>
        <br><br>

        <h2><strong>2. Wat zijn de USP’s (Unique Selling Points) van uw bedrijf?</strong></h2>
        @if ($data->usp && $data->usp != 'null')
          <ol>
            @foreach (json_decode($data->usp) as $item)
              @if($item)
              <li>{{ $item }}</li>
              @endif
            @endforeach
          </ol>  
        @endif
        <br><br>
        
        <h2><strong>3. Wat zijn  uw concurrenten?</strong></h2>
        @if ($data->competitors && $data->competitors != 'null')
          <ol>
            @foreach (json_decode($data->competitors) as $competitor)
              @if($competitor)
              <li><a href="{{$competitor}}" target="_blank">{{ $competitor }}</a></li>
              @endif
            @endforeach
          </ol>  
        @endif
        <br><br>

        <h2><strong>4. Waar moet de focus op liggen?</strong></h2>
        <p>
          @if ($data->focus == 0)
            Contact opnemen
          @elseif($data->focus == 1)
            Offerte aanvragen
          @elseif($data->focus == 2)
            Afspraak maken
          @elseif($data->focus == 3)
            Overig
          @elseif($data->focus == 4)
            Uw portfolio
          @endif
        </p>
        <br><br>

        <h2><strong>5. Beschrijf uw klanten:</strong></h2>
        <p>{{ $data->customers ? $data->customers : '' }}</p>
        <br><br>

        <h2><strong>6. Wat zijn hun wensen en behoeften?</strong></h2>
        <p>{{ $data->wishes ? $data->wishes : '' }}</p>
        <br><br>

        <h2><strong>7. Uw antwoord: hoe speelt u daar concreet op in?</strong></h2>
        <p>{{ $data->concrete ? $data->concrete : '' }}</p>
        <br><br>

        <h2><strong>8. Uw belofte: En hoe maakt u die belofte waar in uw producten, dienstverlening, service en communicatie?</strong></h2>
        <p>{{ $data->promise ? $data->promise : '' }}</p>
        <br><br>

        <h2><strong>9. Richtlijnen voor iedere pagina</strong></h2>
        <p><strong>Let op: dit is gelijk ook een overzicht voor welke pagina’s je teksten moet schrijven!</strong></p>
        <br>
        @if ($data->page_names && $data->page_names != 'null')
          @php
            $pages = json_decode($data->page_names);
            $guidelines = json_decode($data->guidelines);
            $files = json_decode($data->page_files);
          @endphp
            @for ($i = 0; $i < count($pages); $i++)
              <h3>{{ $i + 1 }}. Pagina: {{ $pages[$i] }}</h3> 
              <p>{{ $guidelines[$i] ? $guidelines[$i] : '' }}</p>
              <p><strong>Bestandsnaam:</strong> 
                @if ($data->file($i))
                  <a href="{{ asset('uploads/' . $data->file($i)->media_name) }}" target="_blank">{{ $data->file($i)->media_name }}</a>
                @endif
              </p>
              <br>
            @endfor
        @endif
        <br>
        <h2><strong>10. Omschrijf hier uw werkwijze</strong></h2>
        <p>{{ $data->working_method ? $data->working_method : '' }}</p>
        <br><br>

        <h2><strong>11. Wat is de tone of voice:</strong></h2>
        <p>{{ $data->visitor_description ? $data->visitor_description : '' }}</p>
        <br><br>
      </div>
    </div>
  </main>
</body>
</html>