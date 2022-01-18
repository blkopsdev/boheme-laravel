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
        <h1><strong>Website |</strong> Onboarding</h1>
        
        <p>Please go through the following step-by-step plan:</p>
        <br>
        <p>Please go to this <a href="https://docs.google.com/spreadsheets/u/1/d/1wMhRNTDWITpInFXPlHMUTyB9y9o1oP0YekBoxn6f8ys/edit#gid=0">link.</a></p>
        <br><br>
        <p>Check here a subdomain which is free (green color). </p>
        <br><br>
        {{-- <p>The client chose the following demo:  
          <strong>
            @if ($data->layout == 0)
              Consulting
            @elseif($data->layout == 1)
              Estate
            @elseif($data->layout == 2)
              Business
            @elseif($data->layout == 3)
              Eco
            @elseif($data->layout == 4)
              Shipping
            @elseif($data->layout == 5)
              Agency
            @elseif($data->layout == 6)
              Corporate
            @elseif($data->layout == 7)
              Webshop
            @elseif($data->layout == 8)
              Webshop 2
            @elseif($data->layout == 9)
              Restaurant
            @endif
          </strong>
        </p> --}}
        <p>Please download the All In One WP Migration files of the demo's here:</p>
        <p><a href="http://portal.iqscript.nl/wp-content/uploads/2020/12/demo-install-files.zip">http://portal.iqscript.nl/wp-content/uploads/2020/12/demo-install-files.zip</a></p>
        <p>You can login into the demo (after installing it on the testing server) with:</p>
        <p><strong>URL: </strong>we have changed the wp-admin URL to :/iqscript</p>
        <p><strong>User: </strong>support</p>
        <p><strong>Password: </strong>Test20.000_@@!</p>
        <p>Please import this demo with All in One WP Migration.</p>
        
        <p>If needed you can download here the Unlimited version:</p>
        <p><a href="http://portal.iqscript.nl/wp-content/uploads/2020/07/all-in-one-wp-migration-unlimited-extension.zip">http://portal.iqscript.nl/wp-content/uploads/2020/07/all-in-one-wp-migration-unlimited-extension.zip</a></p>
        <br>
        <p>Please setup the Company name in wordpress to: {{ $data->project->company_name }}</p>
        <br>
        <p>Please see the answer of the client about the colors for the website:</p>
        @if ($data->website_color == 1)
          <p><strong>Answer:</strong> @lang('form.no_decision_color')</p>
        @else
          @if ($data->use_logo_color == 1)
            <p><strong>Answer:</strong> @lang('form.use_logo_color')</p>
          @else
          <p><strong>Main color: </strong> {{ $data->main_color }}</p>
          <p><strong>Sub color 1: </strong> {{ $data->sub_color_1 }}</p>
          <p><strong>Sub color 1: </strong> {{ $data->sub_color_2 }}</p>
          @endif
        @endif
        <p>You can setup the colors in theme options > Global options</p>
        <br><br>
        <p><strong>Please setup this sitemap:</strong></p>
        <ul>
          <li>Home</li>
          @if ($data->menu_item_1)
          <li>
            {{$data->menu_item_1}}
            @if ($data->submenu_item_1 && $data->submenu_item_1 != 'null')
              <ul>
                @foreach (json_decode($data->submenu_item_1) as $sub1_item)
                    @if ($sub1_item)
                    <li>{{ $sub1_item }}</li>     
                    @endif
                @endforeach
              </ul>
            @endif
          </li>
          @endif
          @if ($data->menu_item_2)
          <li>
            {{$data->menu_item_2}}
            @if ($data->submenu_item_2 && $data->submenu_item_2 != 'null')
              <ul>
                @foreach (json_decode($data->submenu_item_2) as $sub2_item)
                    @if ($sub2_item)
                    <li>{{ $sub2_item }}</li>     
                    @endif
                @endforeach
              </ul>
            @endif
          </li>
          @endif
          @if ($data->menu_item_3)
          <li>
            {{$data->menu_item_3}}
            @if ($data->submenu_item_3 && $data->submenu_item_3 != 'null')
              <ul>
                @foreach (json_decode($data->submenu_item_3) as $sub3_item)
                    @if ($sub3_item)
                    <li>{{ $sub3_item }}</li>     
                    @endif
                @endforeach
              </ul>
            @endif
          </li>
          @endif
          @if ($data->menu_item_4)
          <li>
            {{$data->menu_item_4}}
            @if ($data->submenu_item_4 && $data->submenu_item_4 != 'null')
              <ul>
                @foreach (json_decode($data->submenu_item_4) as $sub4_item)
                    @if ($sub4_item)
                    <li>{{ $sub4_item }}</li>     
                    @endif
                @endforeach
              </ul>
            @endif
          </li>
          @endif
          @if ($data->menu_item_5)
          <li>
            {{$data->menu_item_5}}
            @if ($data->submenu_item_5 && $data->submenu_item_5 != 'null')
              <ul>
                @foreach (json_decode($data->submenu_item_5) as $sub5_item)
                    @if ($sub5_item)
                    <li>{{ $sub5_item }}</li>     
                    @endif
                @endforeach
              </ul>
            @endif
          </li>
          @endif
          @if ($data->menu_item_6)
          <li>
            {{$data->menu_item_6}}
            @if ($data->submenu_item_6 && $data->submenu_item_6 != 'null')
              <ul>
                @foreach (json_decode($data->submenu_item_6) as $sub6_item)
                    @if ($sub6_item)
                    <li>{{ $sub6_item }}</li>     
                    @endif
                @endforeach
              </ul>
            @endif
          </li>
          @endif
          <li>Contact</li>
        </ul>
        @if ($data->menu_comment)
        <br>
        <p>Note of client: {{ $data->menu_comment }}</p>
        @endif
        <br>
        <p>Make sure you create the pages already! You can use existing layouts of other pages.</p>

        <p>Integrate this logo in the theme options:</p>
        @if ($data->logo_file)
          <a href="{{asset('uploads/' . $data->logo_file->media_name)}}" target="_blank">{{asset('uploads/' . $data->logo_file->media_name)}}</a>
          <br>
        @endif
        <br><br>
        <p>Please integrate the following contact details in the: footer, contact page and topbar(optional)</p>
        <p><strong>Phone: </strong>{{ $data->contact_phone }}</p>
        <p><strong>Mail: </strong>{{ $data->contact_mail }}</p>
        <p><strong>Address: </strong>{{ $data->contact_address }}</p>
        <br><br>
        <p>Please integrate these social media channels into the website:</p>
        @if ($data->social_links && countArray(json_decode($data->social_links)) > 0)
        <ul>
          @foreach (json_decode($data->social_links) as $social_link)
            <li>{{ $social_link }}</li>
          @endforeach
        </ul>
        @endif
        
        <br><br>
        <p class="next"></p>
        <p>Other information: </p>

        <h2><strong>1. Domeinnaam:</strong></h2>
        <p><strong>Domeinnaam: </strong> {{ $data->domain_name }}</p>
        <br><br>
        <h3><strong>1a. Inlog gegevens domein provider:</strong></h3>
        <p><strong>Provider Naam:</strong> {{ $data->domain_provider }}</p>
        <p><strong>Username/mail:</strong> {{ $data->domain_username }}</p>
        <p><strong>Password:</strong> {{ $data->domain_password }}</p>
        <br><br>
        <h2><strong>2. Website inspiratie:</strong></h2>
        @if ($data->ref_websites && $data->ref_websites != 'null')
        <ol>
            @foreach (json_decode($data->ref_websites) as $ref_website)
            @if ($ref_website)
            <li>{{ $ref_website }}</li>
            @endif
            @endforeach
          </ol>
        @endif
          <br><br>
        <h2><strong>3. Zoekwoorden voor Google:</strong></h2>
        @if ($data->seo_keywords && $data->seo_keywords != 'null')
         <ol>
            @foreach (json_decode($data->seo_keywords) as $keyword)
            @if ($keyword)
            <li>{{ $keyword }}</li>
            @endif
            @endforeach
          </ol>
        @endif
        <br><br>
        
        <h2><strong>4. Images for the website</strong></h2>
        <p>
          @if ($data->image_source == 0)
          - Ik lever mijn eigen foto's aan
          @elseif($data->image_source == 1)
          - Ik wil gebruik maken van jullie fotodatabase
          @else
          - Ik wil dat jullie de foto's voor mij uitkiezen (+ €59,-)
          @endif
        </p>
        <br><br>
        {{-- <h2><strong>5. Notes of the client for Demo:</strong></h2>
        <p>{{ $data->layout_comment }}</p>
        <br><br> --}}
        <h2><strong>6. Goal of the website:</strong></h2>
        <p>Notes of client: {{ $data->purpose_comment }}</p>
        <br><br>
        <h2><strong>7. Call To Action: </strong></h2>
        <p>Notes of client: {{ $data->focus_comment }}</p>
      </div>
    </div>
  </main>
</body>
</html>