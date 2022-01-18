<?php

use Illuminate\Database\Seeder;

class EmailTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_templates')->insert(
            [
                [
                    'subject' => 'Logo design',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Voordat wij de website kunnen gaan ontwikkelen gaan wij eerst aan de slag met het logo en huisstijl. Wij hebben echter nog wel enkele input van uw kant nodig, om een zo goed mogelijk beeld te krijgen van uw wensen.</p>
                    <p>U kunt de input via de volgende link aanleveren: <a href=":FormURL">:FormURL</a></p>
                    <p>Voor vragen kunt u mij altijd mailen of bellen.</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 1,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Eerste versie logo',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Wij hebben de feedback zo goed mogelijk verwerkt in het logo, zie bijlage. Zoals afgesproken heeft u nog één feedback ronde waarin u feedback kunt geven over het logo. Ik wil u dus vriendelijk verzoeken om het logo zo goed mogelijk te analyseren.</p>
                    <p>U kunt de feedback via de volgende link naar ons sturen: <a href=":FormURL">:FormURL</a></p>
                    <p>Voor vragen kunt u mij altijd mailen of bellen.</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 2,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Final feedback logo',
                    'content' => '<p>Beste :ClientName,</p><p>Voordat wij de website kunnen gaan ontwikkelen gaan wij eerst aan de slag met het logo en huisstijl. Wij hebben echter nog wel enkele input van uw kant nodig, om een zo goed mogelijk beeld te krijgen van uw wensen.</p><p>U kunt de input via de volgende link aanleveren: <a href=":FormURL">:FormURL</a></p><p>Voor vragen kunt u mij altijd mailen of bellen.</p><p>Met vriendelijke groet,</p><p style="margin-bottom: 5px;"><strong>:UserName</strong></p><p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p><p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p><p><img src=":UserImg" alt="" width="100"></p>  <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 3,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Logo bestanden',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Hierbij de laatste bestanden van het logo. Wij zijn erg tevreden met het uiteindelijke resultaat. Ik hoop dat u ook erg tevreden bent! Ik heb alle formaten toegevoegd in de bijlage van deze mail.</p>
                    <p>Voor vragen kunt u mij altijd mailen of bellen.</p>
                    <p>Met vriendelijke groet</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 4,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Input voor webdesign',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>We staan op het punt om te beginnen met het webdesign. Ik wil u verzoeken om via de volgende link ons wat meer informatie te verstrekken over de eisen en wensen van het webdesign.</p>
                    <p>U kunt de input voor het webdesign hier sturen: <a href=":FormURL">:FormURL</a></p>
                    <p>Voor vragen kunt u mij altijd mailen of bellen.</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 5,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Input voor webdesign',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>We staan op het punt om te beginnen met het webdesign. Ik wil u verzoeken om via de volgende link ons wat meer informatie te verstrekken over de eisen en wensen van het webdesign.</p>
                    <p>U kunt de input voor het webdesign hier sturen: <a href=":FormURL">:FormURL</a></p>
                    <p>Voor vragen kunt u mij altijd mailen of bellen.</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 6,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Eerste versie webdesign',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>We zijn klaar met de eerste versie van het webdesign! Ik hoop dat dit in de buurt komt van hoe u het zelf in gedachte had. U kunt de feedback over het webdesign via de volgende link aanleveren: <a href=":FormURL">:FormURL</a></p>
                    <p>Voor vragen kunt mij altijd mailen of bellen.</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 7,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Tweede versie webdesign',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Ik heb de feedback zo goed mogelijk proberen door te voeren in het webdesign, zie bijlage. Ik hoor graag of u nog feedback of opmerkingen heeft. Zoals afgesproken heeft u nog één feedback ronde waarin u feedback kunt geven over het webdesign. Mocht u hier gebruik van willen maken kunt u via onderstaande link alle input aanleveren.</p>
                    <p>U kunt de feedback via de volgende link naar ons sturen: <a href=":FormURL">:FormURL</a></p>
                    <p>Voor vragen kunt u mij altijd mailen of bellen.</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 8,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Laatste versie webdesign',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Hierbij de uiteindelijke versie van het webdesign. Ik ga voorbereidingen treffen voor de volgende fase in het project. Ik hoop u hier morgen een mail over te kunnen sturen!</p>
                    <p>Voor vragen kunt u mij altijd mailen of bellen.</p>
                    <p>Met vriendelijke groet</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 9,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Teksten schrijven',
                    'content' => '<p>Beste :ClientName,</p><p>Voordat wij aan de slag gaan met het bouwen van de website gaan wij beginnen om content te creëren voor uw website. U bent zelf het beste thuis in uw bedrijf en branche. Daarom wil ik u verzoeken om via de volgende link ons wat meer informatie te verschaffen, zodat de teksten perfect zullen worden afgestemd op uw bedrijf en branche.</p><p>U kunt de input hier aanleveren: <a href=":FormURL">:FormURL</a></p><p>Ik kijk uit naar de input!</p><p>Met vriendelijke groet,</p><p style="margin-bottom: 5px;"><strong>:UserName</strong></p><p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p><p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p><p><img src=":UserImg" alt=":UserName" width="100"></p><a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 10,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Teksten eerste versie',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Wij zijn hard aan de slag gegaan met de content voor uw website! In de bijlage vindt u een word document met alle teksten. Ik wil u verzoeken om alles goed door te lezen en te kijken of u nog feedback heeft.</p>
                    <p>U kunt de feedback via de volgende link aanleveren: <a href=":FormURL">:FormURL</a></p>
                    <p>Voor vragen kunt u mij altijd mailen of bellen.</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 11,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Teksten tweede versie',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Wij hebben de feedback zo goed mogelijk verwerkt in de teksten, zie bijlage. Zoals afgesproken heeft u nog één feedback ronde waarin u feedback kunt geven over de teksten. Ik wil u dus vriendelijk verzoeken om de teksten nog een keer goed te analyseren en alle feedback naar ons toe te sturen!</p>
                    <p>U kunt de laatste feedback via de volgende link naar ons sturen: <a href=":FormURL">:FormURL</a></p>
                    <p>Voor vragen kunt u mij altijd mailen of bellen.</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 12,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Teksten laatste versie',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Hierbij de laatste versie van de teksten die we gaan gebruiken voor de website. Mocht u zelf nog veranderingen willen aanbrengen dan hoor ik dat graag! Met uw akkoord gaan we beginnen om de website te gaan bouwen!</p>
                    <p>Voor vragen kunt u mij altijd mailen of bellen.</p>
                    <p>Met vriendelijke groet</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 13,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Webdesign bouwen',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Wij staan nu op het punt om het webdesign te gaan bouwen! Echter voordat wij hiermee beginnen zou ik nog wat meer input willen zodat ik het fundament alvast goed kan neerzetten. Hiervoor wil ik u verzoeken om via onderstaande link enkele vragen te beantwoorden omtrent de website.</p>
                    <p>U kunt de vragen via de volgende link beantwoorden: <a href=":FormURL">:FormURL</a></p>
                    <p>Voor vragen kunt u mij altijd mailen of bellen.</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 14,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Eerste versie homepagina',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Het webdesign is gebouwd! U kunt het gebouwde webdesign bekijken op: <a href=":TestingUrl">:TestingUrl</a>. </p>
                    <p>Ik wil eerst de homepagina helemaal in orde maken voordat we verder gaan met de rest van de website. Hiervoor wil ik u verzoeken om via de onderstaande link feedback op het webdesign te geven. Soms kan het namelijk toch anders eruit zien nadat het gebouwd is.</p>
                    <p>U kunt de feedback via de volgende link naar ons sturen: <a href=":FormURL">:FormURL</a></p>
                    <p>Mocht u geen feedback hebben zou u dit mij dan kunnen laten weten? Dan kan ik namelijk beginnen om de rest van de pagina’s te bouwen.</p>
                    <p>Voor vragen kunt u mij altijd mailen of bellen.</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 15,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Eerste versie website',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>We staan nu op het punt om aan de website te beginnen! Echter voordat wij beginnen met de website willen wij altijd zorgen dat we op één lijn zitten. Hiervoor wil ik u verzoeken om via onderstaande link enkele vragen te beantwoorden omtrent uw website en hoe u deze voor u ziet.</p>
                    <p>U kunt de vragen via de volgende link beantwoorden: <a href=":FormURL">:FormURL</a></p>
                    <p>Voor vragen kunt u ons altijd mailen of bellen.</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 16,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Input voor de website',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Wij hebben achter de schermen hard gewerkt aan de website en hebben waar mogelijk alles klaargezet. Wij hebben echter nog wel enkele input van uw kant nodig voordat wij naar de volgende fase van het project gaan. </p>
                    <p>U kunt de input via de volgende link aanleveren: <a href=":FormURL">:FormURL</a></p>
                    <p>Wij kijken uit naar de input!</p>
                    <p>Voor vragen kunt u mij altijd mailen of bellen. </p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 17,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Eerste versie webshop',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Wij staan nu op het punt om de webshop te gaan bouwen! Echter voordat wij beginnen met de webshop willen wij altijd goed in kaart brengen wat uw wensen en eisen zijn voor de website. Hiervoor wil ik u verzoeken om via de onderstaande link enkele vragen te beantwoorden omtrent de webshop.</p>
                    <p>U kunt de vragen via de volgende link beantwoorden: <a href=":FormURL">:FormURL</a></p>
                    <p>Voor vragen kunt u mij altijd mailen of bellen.</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 18,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Input voor de webshop',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Wij hebben achter de schermen hard gewerkt aan de webshop en hebben waar mogelijk alles klaargezet. Wij hebben echter nog wel enkele input van uw kant nodig voordat wij naar de volgende fase van het project gaan.</p>
                    <p>U kunt de input via de volgende link aanleveren: <a href=":TestingUrl">:TestingUrl</a></p>
                    <p>U kunt de input via de volgende link aanleveren: <a href=":FormURL">:FormURL</a></p>
                    <p>Wij kijken uit naar de input!</p>
                    <p>Voor vragen kunt u mij altijd mailen of bellen. </p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                    <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 19,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Eerste feedback ronde',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Wij hebben alle input doorgevoerd op de website. Ik wil u graag verzoeken om alle wijzigingen te bekijken en ons van feedback te voorzien. Wij hebben hiervoor een formulier waarin u duidelijk de feedback per pagina kunt aangeven.</p>
                    <p>U kunt de website bekijken op: <a href=":TestingUrl">:TestingUrl</a></p>
                    <p>Ik wil u graag verzoeken om dit via de volgende link door te geven: <a href=":FormURL">:FormURL</a></p>
                    <p>Voor vragen kunt u ons altijd mailen of bellen. </p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 20,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Extra functionaliteiten',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>U heeft aangegeven dat er extra functionaliteiten op de website moeten komen. Ik wil u graag verzoeken om alle informatie hierover via het onderstaand formulier naar ons toe te sturen.</p>
                    <p><a href=":FormURL">:FormURL</a></p>
                    <p>U kunt de website bekijken op: <a href=":TestingUrl">:TestingUrl</a></p>
                    <p>Voor vragen kunt u mij altijd mailen of bellen.</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                    <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 21,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Final versie website',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Wij hebben alle feedback doorgevoerd! Wij hebben onze uiterste best gedaan om alles op de juiste manier door te voeren.</p>
                    <p>Zoals afgesproken heeft u twee keer de mogelijkheid om feedback door te geven. Via de onderstaande link kunt u de laatste feedback aan ons doorgeven. Ik wil u graag verzoeken om de website een laatste keer goed door te nemen. Uiteraard kunt u na oplevering nog steeds alles zelf aanpassen m.b.v. onze gratis video cursus.
                    </p>
                    <p>Vervolgens kunt u de laatste feedback aan ons doorgeven via de volgende link: <a href=":FormURL">:FormURL</a></p>
                    <p>U kunt de website bekijken op: <a href=":TestingUrl">:TestingUrl</a></p>
                    <p>Voor vragen kunt u mij altijd mailen of bellen.</p> 
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                    <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 22,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Laatste stappen website',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Wij zijn aan de slag gegaan met de laatste feedback ronde en hebben alle feedback doorgevoerd. Wij willen graag de website online gaan zetten en ook de laatste details in orde maken! Hiervoor verzoek ik u, om ons te laten weten welke stappen u wilt maken met betrekking tot de hosting.</p>
                    <p>Alles m.b.t. de hosting wordt in dit formulier toegelicht, aan het einde kunt u vervolgens uw voorkeur doorgeven. U kunt alles in orde maken via de volgende link: <a href=":FormURL">:FormURL</a></p>
                    <p>Voor vragen kunt u ons altijd mailen of bellen.</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 23,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Website staat live!',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Wij hebben ook de laatste stappen in orde gemaakt. U kunt de website zien op : <a href=":WebsiteUrl">:WebsiteUrl</a></p>
                    <p>We hebben ook een aanvraag ingediend bij Google om de website zo snel mogelijk goed te indexeren. Houd er echter wel rekening mee dat het 2-4 weken kan duren voordat Google de website heeft geïndexeerd en dat de resultaten hiervan zichtbaar zijn.</p>
                    <p>Tot nu toe ervaren wij het als een prettige samenwerking en hopen dit samen de komende jaren door te zetten. Uiteraard streven we er ook in de toekomst naar om u zo goed mogelijk te helpen hiervoor zijn we altijd bereikbaar van 09:00 tot 18:00 op doordeweekse dagen. In het weekend en de avond uren kunt u ons wel altijd bereiken voor spoed gevallen.</p>
                    <p>We bieden ook een vervolg traject aan waarin we het maximale uit uw website gaan halen. Hierin gaan we met de website aan de slag waarin wij gaan zorgen dat we de juiste doelgroep met de website gaan bereiken. Ik hoor graag of u daar interesse in zou hebben.</p>
                    <p>Als laatste hebben wij een Wordpress cursus gemaakt waarin wij u stap voor stap uitleggen hoe u zelf de website kunt beheren/aanpassen. U kunt inloggen op de cursus met de volgende gegevens:</p>
                    <p><strong>Link:</strong> <a href="http://uitleg.iqscript.nl/">http://uitleg.iqscript.nl/</a></p>
                    <p><strong>Gebruiker:</strong> iqscript</p>
                    <p><strong>Ww: </strong> Welkom01!</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 24,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Bent u tevreden over onze diensten?',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Bedankt voor de tot nu toe prettige samenwerking! Wij zijn erg tevreden met het uiteindelijke resultaat en wij hopen uiteraard dat dit ook wederzijds is.</p>
                    <p>Daarom vragen wij of u één minuut de tijd wilt nemen om een review achter te laten. Wij geloven namelijk sterk in tevreden klanten en willen dit ook met trots tonen.</p>
                    <p>Wij streven ernaar om beoordelingen te krijgen op twee verschillende plaatsen: Google en TrustPilot, zie de linkjes hieronder. Wij willen u alvast erg bedanken voor de moeite en hopen de samenwerking op goede voet voort te zetten.</p>
                    <p>Google: <a href="https://bit.ly/2IQSeZY" target="_blank">https://bit.ly/2IQSeZY </a></p>
                    <p>Trustpilot: <a href="https://bit.ly/3lRMhtO" target="_blank">https://bit.ly/3lRMhtO</a></p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => 25,
                    'error_message_id' => null,
                    'type' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Verkeerde bestanden logo',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Tijdens het proces ben ik erachter gekomen dat het logo niet in het goede formaat/onscherpe kwaliteit is aangeleverd.</p>
                    <p>Graag ontvang ik het logo in het volgende formaat:</p>
                    <ul>
                      <li>Als mogelijk een .eps of .svg bestand</li>
                      <li>Wanneer dit niet mogelijk is wil ik u graag verzoeken om een transparante versie van het logo aan te leveren.</li>
                      <li>Let ook op de scherpte van het logo</li>
                    </ul>
                    <p>Mocht u dit niet kunnen aanleveren is dit geen ramp, dan gebruik ik het huidige logo! Dit staat echter wel minder professioneel. Mocht u willen dat wij het logo proberen te optimaliseren kunt u hier ook voor kiezen, echter brengt dit wel extra kosten met zich mee. </p>
                    <p>Ik kijk uit naar uw reactie.</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => null,
                    'error_message_id' => 1,
                    'type' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Slechte kwaliteit foto’s',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Met het invoeren van de foto’s ben ik erachter gekomen dat de aangeleverde foto’s een te klein formaat hebben en dus van onscherpe kwaliteit zijn.</p>
                    <p>Ik wil u graag verzoeken om ons foto’s toe te sturen van hogere kwaliteit (voorkeursformaat: 1900x1200 px).</p>
                    <p>Ik kijk uit naar uw reactie!</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => null,
                    'error_message_id' => 2,
                    'type' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Mails aangekomen?',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Ik heb al een tijdje geleden een mail gestuurd maar ik heb nog geen reactie ontvangen. Dus ik vroeg mij af of mijn vorig mail in goede orde is ontvangen? </p>
                    <p>Ik hoor graag van u!</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => null,
                    'error_message_id' => 3,
                    'type' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Verkeerde inlog Wordpress',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Ik heb net geprobeerd in te loggen in de Wordpress omgeving, maar ik krijg een foutmelding. Het lijkt erop dat de inloggegevens niet correct zijn.</p>
                    <p>Ik wil u dan ook graag verzoeken om mij nogmaals de inloggegevens toe te sturen. Bij voorbaat dank!</p>
                    <p>Met vriendelijke groet,</p> 
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => null,
                    'error_message_id' => 4,
                    'type' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Verkeerde inlog Hosting',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Ik heb net enkele pogingen gedaan om in te loggen bij de domein provider, maar ik krijg een foutmelding. Het ziet er naar uit dat de inloggegevens niet correct zijn. </p>
                    <p>Ik wil u graag verzoeken om te kijken of u wel de juiste inloggegevens heeft gegeven. Zo niet zou u dan de goede inloggevens willen mailen? Bij voorbaat dank! </p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => null,
                    'error_message_id' => 5,
                    'type' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Extra werkzaamheden',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>U heeft aangegeven dat er extra wensen zijn voor de website. Ik wil u graag verzoeken om alle informatie hierover via het onderstaand formulier naar ons toe te sturen. Ik wil u graag verzoeken om een kleine beschrijving naar ons toe te sturen via de onderstaande link. Hier kunt u ook relevante bestanden toevoegen. </p>
                    <p>U kunt via de volgende link alles aanleveren: <a href=":FormURL">:FormURL</a></p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => null,
                    'error_message_id' => 6,
                    'type' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Foto’s aanleveren website',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Ik was met het project bezig en ik kwam erachter dat er nog te weinig foto’s waren aangeleverd van uw kant om de website goed op te kunnen vullen. Ik wil u dan graag verzoeken om nogmaals via de mail extra foto’s naar mij op te sturen.</p>
                    <p>Let er wel op dat u de pagina benoemd in de bestandsnaam:</p>
                    <p>Bijvoorbeeld: Home.jpeg, home1.jpeg, over_ons.jpeg</p>
                    <p>Bij voorbaat dank! </p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => null,
                    'error_message_id' => 7,
                    'type' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Zakelijke mail instellen',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Om de zakelijke mail in te gaan stellen heb ik wat informatie nodig van jullie kant. Ik wil jullie verzoeken om alle informatie aan te leveren via de volgende link: <a href=":FormURL">:FormURL</a></p>
                    <p>Mochten jullie hier nog vragen over hebben kunnen jullie ons altijd telefonisch bereiken!</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => null,
                    'error_message_id' => 8,
                    'type' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Mail probleem website',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Ik heb vernomen dat er geen mail vanuit de website wordt verstuurd. Ik heb dit even bekeken en om dit probleem te kunnen verhelpen moet ik de email koppelen aan de website. Hierdoor worden voortaan alle mails vanuit de website verstuurd vanuit uw mail.</p>
                    <p>Ik wil u graag verzoeken om de inloggegevens van uw mail via een beveiligd formulier naar ons toe te sturen zodat ik dit probleem snel kan verhelpen.</p>
                    <p>U kunt alle informatie via de volgende link aanleveren: <a href=":FormURL">:FormURL</a></p>
                    <p>Voor vragen kunt u mij altijd mailen of bellen.</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => null,
                    'error_message_id' => 9,
                    'type' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Feedback logo',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Ik wil u verzoeken om verdere feedback over het logo naar ons te sturen via het volgende formulier: <a href=":FormURL">:FormURL</a></p>
                    <p>Voor vragen kunt mij altijd mailen of bellen.</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                     <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => null,
                    'error_message_id' => 10,
                    'type' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Feedback text',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Ik wil u verzoeken om verdere feedback naar ons te sturen via het volgende formulier: <a href=":FormURL">:FormURL</a></p>
                    <p>Voor vragen kunt mij altijd mailen of bellen.</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                    <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => null,
                    'error_message_id' => 11,
                    'type' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'subject' => 'Website feedback',
                    'content' => '<p>Beste :ClientName,</p>
                    <p>Ik wil u verzoeken om verdere feedback over de website naar ons te sturen via het volgende formulier: <a href=":FormURL">:FormURL</a></p>
                    <p>Voor vragen kunt mij altijd mailen of bellen.</p>
                    <p>Met vriendelijke groet,</p>
                    <p style="margin-bottom: 5px;"><strong>:UserName</strong></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">:UserRole</p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><em>:UserPhone</em></p>
                    <p><img src=":UserImg" alt=":UserName" width="100"></p>
                    <a href=":UserUrl">:UserUrl</a>',
                    'status_id' => null,
                    'error_message_id' => 12,
                    'type' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );
    }
}
