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
        <h1><strong>Zakelijk email instellen:</strong></h1>
        <p><em>Please note: If needed you can use Google Translate to translate the questions given by the client:</em></p><br><br>
        <h2><strong>Email provider:</strong></h2>
        <p>
          @if ($form->mail_type == 0)
            Gmail
          @elseif($form->mail_type == 1)
            Outlook (Office 365)
          @elseif($form->mail_type == 2)
            IQ Script mail
          @endif
        </p>
        <br>
        <h2><strong>Email accounts die moeten worden toegevoegd:</strong></h2>
        @if ($form->mails && $form->mails != 'null')
          <ul>
            @foreach (json_decode($form->mails) as $mail)
            @if ($mail)
            <li>{{ $mail }}</li>
            @endif
            @endforeach
          </ul>
        @endif
        <br><br>
        <h2><strong>Toegestemd in de kosten:</strong></h2>
        <p>{{ $form->mail_fee == 1 ? 'Ja': 'Nee'}}</p>
        <br><br>
        <h2><strong>Factuur gegevens</strong></h2>
        <p><strong>Voornaam:</strong> {{ $form->mail_first_name ? $form->mail_first_name : ''}}</p>
        <p><strong>Achternaam:</strong> {{ $form->mail_last_name ? $form->mail_last_name : ''}}</p>
        <p><strong>Titel/positie:</strong> {{ $form->mail_title ? $form->mail_title : ''}}</p>
        <p><strong>Telefoon:</strong> {{ $form->mail_phone ? $form->mail_phone : ''}}</p>
        <p><strong>Persoonlijke e-mail:</strong> {{ $form->mail_personal_email ? $form->mail_personal_email : ''}}</p>
        <p><strong>Straatnaam + Huisnr.:</strong> {{ $form->mail_address ? $form->mail_address : ''}}</p>
        <p><strong>Postcode:</strong> {{ $form->mail_zip ? $form->mail_zip : ''}}</p>
        <p><strong>Stad/plaats:</strong> {{ $form->mail_state ? $form->mail_state : ''}}</p>
        <p><strong>Land:</strong> {{ $form->mail_country ? $form->mail_country : ''}}</p>
        <p><strong>KvK nummer:</strong> {{ $form->mail_kvk ? $form->mail_kvk : ''}}</p><br>
        <br><br>
        <h2><strong>Domeinnaam: {{ $form->domain_name? $form->domain_name: '' }}</strong></h2>
        <br><br>
        <h2><strong>Inlog gegevens domein provider:</strong></h2>
        <p><strong>Naam:</strong> {{ $form->domain_provider? $form->domain_provider: '' }}</p>
        <p><strong>Username/mail:</strong> {{ $form->domain_username? $form->domain_username: '' }}</p>
        <p><strong>Password:</strong> {{ $form->domain_password? $form->domain_password: '' }}</p>
        <br><br>
      </div>
    </div>
  </main>
</body>
</html>