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
        <h1><strong>Website | Mail verstuurd niet </strong></h1>
        <br>
        <p><strong>Bedrijf: </strong> {{ $form->project->company_name }}</p>
        <p><strong>Klant naam: </strong> {{ $form->project->name }}</p>
        <p><strong>Website Url:</strong> {{ $form->project->website_url }}</p>
        <br><br>
        <h3><strong>WP Access:</strong></h3>
        <p>User: Developer</p>
        <p>Pass: Dev123Sup123!</p>
        <br>
        <p>Zorg dat je een SMTP plugin installeert en de volgende email hieraan koppelt. Je kan dit heel simpel uitzoeken hoe dit moet door te googlen: "{{ $form->email_provider }} SMTP"</p>
        <br>
        <p><strong>Email Provider: </strong>{{ $form->email_provider }}</p>
        <p><strong>Mail: </strong>{{ $form->email_address }}</p>
        <p><strong>Wachtwoord: </strong>{{ $form->password }}</p>
      </div>
    </div>
  </main>
</body>
</html>