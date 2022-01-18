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
        <h1><strong>Website :</strong> Webteksten feedback eerste versie</h1>
        <br><br>
        
        <h3><strong>Bedrijf: {{ $data->project->company_name }}</strong></h3>
        <p><strong>Klant naam: </strong>{{ $data->project->name }}</p>
        <br>
        <p><em>Please note: If needed you can use Google Translate to translate the questions given by the client:</em></p><br><br>
        
        @php
          $pages = json_decode($data->page_names);
          $page_feedbacks = json_decode($data->page_feedbacks);
        @endphp
          @for ($i = 0; $i < count($pages); $i++)
            <h2><strong>{{ $i + 1 }}. Pagina: {{ $pages[$i] }}</strong></h2>
            <h4><strong>Feedback: </strong></h4>
            <p>{!! $page_feedbacks[$i] ? $page_feedbacks[$i] : '' !!}</p>
            <p><strong>Bijgevoegde bestanden:</strong> </p>
            <p>
              @if ($data->file($i))
                <a href="{{ asset('uploads/' . $data->file($i)->media_name) }}" target="_blank">{{ $data->file($i)->media_name }}</a>
              @endif
            </p>
            <br>
          @endfor
        <br>
      </div>
    </div>
  </main>
</body>
</html>