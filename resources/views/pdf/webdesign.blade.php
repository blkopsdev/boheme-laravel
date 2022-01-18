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
    .selected {
      border: 4px solid rgb(5, 192, 5);
    }
    .unselected {
      border: 4px solid rgb(192, 192, 192);
    }
    .compare-image {
      margin: 0 5px;
    }
  </style>
</head>
<body style="font-family: sans-serif;">
  <header><img src="{{asset('assets/img/logo.png')}}" width="150" alt=""></header>
  <footer><span style="float:right">Copyright IQ Script ©</span></footer>
  <main>
    <div class="content">
      <div class="container-fluid">
        <h1><strong>Website :</strong> Briefing eerste versie</h1>
        <p><strong>Bedrijf</strong>: {{$data->project->company_name}}</p>
        <p><strong>Client</strong>: {{$data->project->name}}</p>
        <br><br>
        <p><em>Please note: If needed you can use Google Translate to translate the questions given by the client:</em></p><br><br>
        <h2><strong>1. Describe your industry</strong></h2>
        <p>{{ $data->industry }}</p>
        <br><br>
        <h2><strong>2. Purpose of website: 
          @if ($data->purpose == 0)
            Actie gericht
          @elseif($data->purpose == 1)
            Informatief
          @elseif($data->purpose == 2)
            Lead generator
          @elseif($data->purpose == 3)
            Overig
          @endif
        </strong> 
        </h2>
        <p><em>Please note: Check the purpose carefully; for example when the purpose is lead generator the webdesign need to be very conversion optimized. But when it is informative it need to be displaying lots of information and look very nice.</em></p>
        <p><span><strong>Notes from the client:</strong> {{$data->purpose_description? $data->purpose_description: ''}}</span></p>
        <br><br>
        <h2>
            <strong>3. What should be the focus on: 
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
            </strong>
        </h2>
        <p><em>Please note: please use the answer of the client for the call to action. For example: when the focus is "Appointment" the button text need to be: Make appointment.</em></p>
        <p><span><strong>Notes from the client:</strong> {{$data->focus_description? $data->focus_description: ''}}</span></p>
        <br><br>
        <h3><strong>4. How does your website need to be look like?:</strong></h3>
        @if($data->type)
        <p>{{implode(', ', json_decode($data->type))}}</p>
        @endif
        <br><br>
        <h2><strong>5. Unique Selling points: </strong></h2>
        <p>Integrate the following USP's in the webdesign with icons. You can use google Translate to understand the points better:</p>
        <ol>
          @foreach (json_decode($data->usp) as $item)
            @if ($item)
            <li>{{ $item }}</li>
            @endif
          @endforeach
        </ol>
        <br><br>
        <h2><strong>6. Contact details for the website:</strong></h2>
        <p><strong>Please use these contact details for the footer etc.</strong></p>
        <p><strong>Telefoon:</strong> {{ $data->contact_phone ? $data->contact_phone : ''}}</p>
        <p><strong>Mail:</strong> {{ $data->contact_email ? $data->contact_email : ''}} </p>
        <p><strong>Adres:</strong> {{ $data->contact_address ? $data->contact_address : ''}}</p>
        <br><br>
        <h2><strong>7. Please use the following font for the webdesign: {{ $data->font ? $data->font : '' }}</strong></h2>
        
        @if ($data->font != null)
        <br><br>
          @if ($data->font == 'Open Sans and Roboto')
          <div class="images">
            <img src="{{ asset('assets/img/opensans.png') }}" width="400">
          </div>
          @elseif ($data->font == 'Playfair Display and Montserrat')
          <div class="images">
            <img src="{{ asset('assets/img/playfair.png') }}" width="400">
          </div>
          @elseif ($data->font == 'Lora and Alegreya')
          <div class="images">
            <img src="{{ asset('assets/img/lora.png') }}" width="400">
          </div>
          @elseif ($data->font == 'Merriweather and Lato')
          <div class="images">
            <img src="{{ asset('assets/img/merriweather.png') }}" width="400">
          </div>
          @elseif ($data->font == 'Amatic SC and Josefin Slab')
          <div class="images">
            <img src="{{ asset('assets/img/amaticsc.png') }}" width="400">
          </div>
          @elseif ($data->font == 'PT Sans Narrow and PT Sans')
          <div class="images">
            <img src="{{ asset('assets/img/ptsans.png') }}" width="400">
          </div>
          @endif
        @else
        <p>{{ $data->font_description ? $data->font_description : '' }}</p>
        @if ($data->file('font_file'))
            <a href="{{ asset('uploads/' . $data->file('font_file')->media_name) }}" target="_blank">{{ asset('uploads/' . $data->file('font_file')->media_name) }}</a>
        @endif
        @endif
        <br><br>
        <h2><strong>8. Website preference (white header vs. transparent header):</strong></h2>
        <p><em>Please check the preference of the client. For example when the client chose left they want to have a white header at the webdesign.</em></p>
        <br><br>
        <div class="images">
          <img src="{{ asset('assets/img/webdesign-1-0.png') }}" width="300" class="{{ $data->appeal_1 == 0 ? 'selected' : 'unselected' }}">
          <img src="{{ asset('assets/img/webdesign-1-1.png') }}" width="300" class="{{ $data->appeal_1 == 1 ? 'selected' : 'unselected' }}">
        </div>
        <br><br>
        <h3><strong>9. Website preference (Round shape vs. Angular shapes):</strong></h3>
        <p><em>Please check the preference of the client. For example when the client chose left they want to have a round shapes at the webdesign.</em></p>
        <br><br>
        <div class="images">
          <img src="{{ asset('assets/img/webdesign-2-0.png') }}" width="300" class="{{ $data->appeal_2 == 0 ? 'selected' : 'unselected' }}">
          <img src="{{ asset('assets/img/webdesign-2-1.png') }}" width="300" class="{{ $data->appeal_2 == 1 ? 'selected' : 'unselected' }}">
        </div>
        <br><br>
        <h3><strong>10. Website preference (Calm vs. Busy):</strong></h3>
        <p><em>Please check the preference of the client. For example when the client chose left they want to have a calm and clean webdesign.</em></p>
        <br><br>
        <div class="images">
          <img src="{{ asset('assets/img/webdesign-3-0.png') }}" width="300" class="{{ $data->appeal_3 == 0 ? 'selected' : 'unselected' }}">
          <img src="{{ asset('assets/img/webdesign-3-1.png') }}" width="300" class="{{ $data->appeal_3 == 1 ? 'selected' : 'unselected' }}">
        </div>
        <br><br>
        {{-- <p class="next"></p> --}}
        <h3><strong>11. Website preference (Lots of white vs. Lots of images):</strong></h3>
        <p><em>Please check the preference of the client. for example when the client chose left they want to have a lots of white at the webdesign.</em></p>
        <br><br>
        <div class="images">
          <img src="{{ asset('assets/img/webdesign-4-0.png') }}" width="300" class="{{ $data->appeal_4 == 0 ? 'selected' : 'unselected' }}">
          <img src="{{ asset('assets/img/webdesign-4-1.png') }}" width="300" class="{{ $data->appeal_4 == 1 ? 'selected' : 'unselected' }}">
        </div>
        <br><br>
        <h2><strong>12. Examples of websites the client like: </strong></h2>
        <ol>
          @foreach (json_decode($data->reference) as $reference)
            @if ($reference)
            <li>{{ $reference }}</li>
            @endif
          @endforeach
        </ol>
        <br><br>
        <h2><strong>13. Team section: {{ $data->team == 1 ? 'Yes': 'No'}}</strong></h2>
        <p>If the client wants a team section, please integrate this also in the webdesign.</p>
        <br><br>
        <div class="imags">
          <img src="{{ asset('assets/img/Image 15.png') }}" width="350" alt="">
        </div>
        <br><br>
        
        <h2><strong>14. Review section: {{ $data->review == 1 ? 'Yes' : 'No' }}</strong></h2>
        <p>If the client wants a review section, please integrate this also in the webdesign.</p>
        <br><br>
        <div class="imags">
          <img src="{{ asset('assets/img/Image 22.png') }}" width="350" alt="">
        </div>
        <br><br>
        <h2><strong>15. Portfolio section: {{ $data->portfolio == 1 ? 'Yes' : 'No' }}</strong></h2>
        <p>If the client wants a portfolio section, please integrate this also in the webdesign.</p>
        <br><br>
        <div class="imags">
          <img src="{{ asset('assets/img/Image 25.png') }}" width="350" alt="">
        </div>
        <br><br>
        <h2><strong>16. Blog section/page: {{ $data->blog == 1 ? 'Yes' : 'No' }}</strong></h2>
        <p>If the client wants a blog section, please integrate this also in the webdesign.</p>
        <br><br>
        <div class="imags">
          <img src="{{ asset('assets/img/Image 23.png') }}" width="350" alt="">
        </div>
        <br><br>
        <h2><strong>17. Nieuwsbrief subscription section: {{ $data->newsletter == 1 ? 'Yes' : 'No' }}</strong></h2>
        <p>If the client wants a newsletter subscription section, please integrate this also in the webdesign.</p>
        <br><br>
        <div class="imags">
          <img src="{{ asset('assets/img/Image 27.png') }}" width="350" alt="">
        </div>
        <br><br>
        <h2><strong>18. Services which need to be added in the webdesign: </strong></h2>
        <p><em>Please highlight the following service pages as well in the homepage</em></p>
        <ol>
          @foreach (json_decode($data->service_highlight) as $highlight)
            @if ($highlight)
            <li>{{ $highlight }}</li>
            @endif
          @endforeach
        </ol>
        <br><br>

        <h2><strong>19. Logo:</strong></h2>
        @if ($data->file('logo_file'))
          <a href="{{asset('uploads/' . $data->file('logo_file')->media_name)}}" target="_blank">{{asset('uploads/' . $data->file('logo_file')->media_name)}}</a>
          <br>
        @endif
        <br><br>

        <h3><strong>20. Colors for the website:</strong></h3>
        <p>Please use Google Translate in order to understand the answer provided by the client.</p>
        @if ($data->website_color == 1)
          <p><strong>Ik weet het nog niet, verras me!</strong> </p>
        @endif
        @if ($data->use_logo_color == 1)
        <p><strong>Gebuik de kleuren van mijn logo</strong></p>
        @endif
        @if($data->main_color)
          <p><strong>Main color:</strong>{{$data->main_color}}</p>
          <p><strong>Sub color:</strong>{{$data->sub_color_1}}</p>
          <p><strong>Sub color 2:</strong>{{$data->sub_color_2}}</p>
        @endif
        @if ($data->logo_notes)
          <p>Notes of client: {{ $data->logo_notes }}</p>            
        @endif
      </div>
    </div>
  </main>
</body>
</html>