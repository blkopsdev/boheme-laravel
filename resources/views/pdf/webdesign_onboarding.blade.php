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
        <h1><strong>Website :</strong> Webdesign onboarding</h1>
        <p><strong>Bedrijf</strong>: {{$data->project->company_name}}</p>
        <p><strong>Client</strong>: {{$data->project->name}}</p>
        <br><br>
        <p><em>Please note: If needed you can use Google Translate to translate the questions given by the client:</em></p><br><br>
        <h2><strong>1. Describe your industry</strong></h2>
        <p>{{ $data->industry }}</p>
        <br><br>
        <h3><strong>2. How does your website need to be look like?:</strong></h3>
        @if($data->type)
        <p>{{implode(', ', json_decode($data->type))}}</p>
        @endif
        <br><br>
        <h2><strong>3. Unique Selling points: </strong></h2>
        <p>Integrate the following USP’s in the webdesign (you can add these in the icon boxes in the webdesign). You can use Google Translate to understand the points better:</p>
        <ol>
          @foreach (json_decode($data->usp) as $item)
            @if ($item)
            <li>{{ $item }}</li>
            @endif
          @endforeach
        </ol>
        <br><br>
        <h2><strong>4. Contact details for the website:</strong></h2>
        <p><strong>Please use these contact details for the footer etc.</strong></p>
        <p><strong>Telefoon:</strong> {{ $data->contact_phone ? $data->contact_phone : ''}}</p>
        <p><strong>Mail:</strong> {{ $data->contact_email ? $data->contact_email : ''}} </p>
        <p><strong>Adres:</strong> {{ $data->contact_address ? $data->contact_address : ''}}</p>
        <br><br>
        <h2><strong>5. Please use the following font for the webdesign: {{ $data->font ? $data->font : '' }}</strong></h2>
        
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
        @endif
        <p>{{ $data->font_description ? $data->font_description : '' }}</p>
        @if ($data->file('font_file'))
            <a href="{{ asset('uploads/' . $data->file('font_file')->media_name) }}" target="_blank">{{ $data->file('font_file')->media_name }}</a>
        @endif
        <br><br>
        <h2><strong>6. Website preference (white header vs. transparent header):</strong></h2>
        <p><em>Please check the preference of the client. For example when the client chose left they want to have a white header at the webdesign.</em></p>
        <br><br>
        <div class="images">
          <img src="{{ asset('assets/img/webdesign-5-0.jpg') }}" width="300" class="{{ $data->appeal_1 == 0 ? 'selected' : 'unselected' }}">
          <img src="{{ asset('assets/img/webdesign-5-1.jpg') }}" width="300" class="{{ $data->appeal_1 == 1 ? 'selected' : 'unselected' }}">
        </div>
        <br><br>
        <h3><strong>7. Website preference (Round shape vs. Angular shapes):</strong></h3>
        <p><em>Please check the preference of the client. For example when the client chose {{ $data->2 == 0 ? 'left' : 'right' }} they want to have a round shapes at the webdesign.</em></p>
        <br><br>
        <div class="images">
          <img src="{{ asset('assets/img/webdesign-2-0.png') }}" width="300" class="{{ $data->appeal_2 == 0 ? 'selected' : 'unselected' }}">
          <img src="{{ asset('assets/img/webdesign-2-1.png') }}" width="300" class="{{ $data->appeal_2 == 1 ? 'selected' : 'unselected' }}">
        </div>
        <br><br>
        <h3><strong>8. Website preference (Calm vs. Busy):</strong></h3>
        <p><em>Please check the preference of the client. For example when the client chose left they want to have a calm and clean webdesign.</em></p>
        <br><br>
        <div class="images">
          <img src="{{ asset('assets/img/webdesign-6-0.jpg') }}" width="300" class="{{ $data->appeal_3 == 0 ? 'selected' : 'unselected' }}">
          <img src="{{ asset('assets/img/webdesign-6-1.jpg') }}" width="300" class="{{ $data->appeal_3 == 1 ? 'selected' : 'unselected' }}">
        </div>
        <br><br>
        {{-- <p class="next"></p> --}}
        <h3><strong>9. Website preference (Lots of white vs. Lots of images):</strong></h3>
        <p><em>Please check the preference of the client. for example when the client chose left they want to have a lots of white at the webdesign.</em></p>
        <br><br>
        <div class="images">
          <img src="{{ asset('assets/img/webdesign-7-0.jpg') }}" width="300" class="{{ $data->appeal_4 == 0 ? 'selected' : 'unselected' }}">
          <img src="{{ asset('assets/img/webdesign-7-1.jpg') }}" width="300" class="{{ $data->appeal_4 == 1 ? 'selected' : 'unselected' }}">
        </div>
        <br><br>
        <h2><strong>10. Examples of websites the client like: </strong></h2>
        <ol>
          @foreach (json_decode($data->reference) as $reference)
            @if ($reference)
            <li>{{ $reference }}</li>
            @endif
          @endforeach
        </ol>
        <br><br>
        <h2><strong>11. Team section: {{ $data->team == 1 ? 'Yes': 'No'}}</strong></h2>
        <p>If the client wants a team section, please integrate this also in the webdesign.</p>
        <br><br>
        <div class="imags">
          <img src="{{ asset('assets/img/Image 15.png') }}" width="350" alt="">
        </div>
        <br><br>
        
        <h2><strong>12. Review section: {{ $data->review == 1 ? 'Yes' : 'No' }}</strong></h2>
        <p>If the client wants a review section, please integrate this also in the webdesign.</p>
        <br><br>
        <div class="imags">
          <img src="{{ asset('assets/img/Image 22.png') }}" width="350" alt="">
        </div>
        <br><br>
        {{-- <h2><strong>13. Portfolio section: {{ $data->portfolio == 1 ? 'Yes' : 'No' }}</strong></h2>
        <p>If the client wants a portfolio section, please integrate this also in the webdesign.</p>
        <br><br>
        <div class="imags">
          <img src="{{ asset('assets/img/Image 25.png') }}" width="350" alt="">
        </div>
        <br><br> --}}
        <h2><strong>13. Blog section/page: {{ $data->blog == 1 ? 'Yes' : 'No' }}</strong></h2>
        <p>If the client wants a blog section, please integrate this also in the webdesign.</p>
        <br><br>
        <div class="imags">
          <img src="{{ asset('assets/img/Image 23.png') }}" width="350" alt="">
        </div>
        <br><br>
        <h2><strong>14. Nieuwsbrief subscription section: {{ $data->newsletter == 1 ? 'Yes' : 'No' }}</strong></h2>
        <p>If the client wants a newsletter subscription section, please integrate this also in the webdesign.</p>
        <br><br>
        <div class="imags">
          <img src="{{ asset('assets/img/Image 27.png') }}" width="350" alt="">
        </div>
        <br><br>
        <h2><strong>15. Logo:</strong></h2>
        @if ($data->file('logo_file'))
          <a href="{{asset('uploads/' . $data->file('logo_file')->media_name)}}" target="_blank">{{asset('uploads/' . $data->file('logo_file')->media_name)}}</a>
          <br>
        @endif
        <br><br>

        <h3><strong>16. Colors for the website:</strong></h3>
        @if ($data->main_color)
          <p><strong>Main color:</strong>{{$data->main_color}}</p>
          <p><strong>Sub color:</strong>{{$data->sub_color_1}}</p>
          <p><strong>Sub color 2:</strong>{{$data->sub_color_2}}</p>
        @endif
        @if ($data->user_logo_color == 1)
          <p><strong>Use logo color</strong></p>
        @endif
        @if ($data->website_color == 1)
        <p>Please use Google Translate in order to understand the answer provided by the client.</p>
        <p><strong>Ik weet het nog niet, verras me!</strong> </p>
        @endif
        @if ($data->logo_notes)
          <p>Notes of the client about the color: {{ $data->logo_notes }}</p>
        @endif
      </div>
    </div>
  </main>
</body>
</html>