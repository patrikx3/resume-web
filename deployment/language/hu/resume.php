<?php
use P3x\Str;

$l = array();
$l['title'] = 'Önéletrajz';

$l['data-since'] = '%s óta';
$l['data-since-pdf'] = '%s óta' . PROJECT_DIVIDER . 'kb. %s év';

$l['tab-cover'] = 'Címlap';
$l['tab-personal'] = 'Személyes';
$l['tab-skills'] = 'Ismeretek';
$l['tab-education'] = 'Tanulmányok';
$l['tab-employment'] = 'Munkáltató';

$l['tab-cover-id'] = Str::ToUrl($l['tab-cover']);
$l['tab-personal-id'] = Str::ToUrl($l['tab-personal']);
$l['tab-skills-id'] = Str::ToUrl($l['tab-skills']);
$l['tab-education-id'] = Str::ToUrl($l['tab-education']);
$l['tab-employment-id'] = Str::ToUrl($l['tab-employment']);


$l['tab-data-cover']
    = <<<EOF
Jelenleg, elsősorban mikroszervízekre, webes és Electron asztali alkalmazásokra (és Ionic telefonra / tablettákra is) összpontosítok.
<br/><br/>    
Gyerekkorom óta használok grafikai programokat és kódolok. Nagyon szeretem a szép animációt és a strukturált programozást.
<br/><br/>
Kb. 2000 óta használom az objektumorientált és funkcionális fejlesztést. 2001 óta tervezek diagramokat és modelleket. Szeretem a tervező és Microsoft eszközeket.
<br/><br/>
Általában web alapú rendszereket építek, de más alkalmazásokkal is foglalkozok. Legjobban a szerver, kliens, desktop, mobil, adatbázis és komponens módszerek kedvelem.  Olyan egyszerű megoldásokat tervezek, amely független az operációs rendszertől, nyelvtől és keretrendszertől.
<br/><br/>
Amit szeretek és csinálok: elemzés, tervezés, tesztelés, építés, folyamatos integráció, kód stílus, kód felülvizsgálat, dokumentáció, telepítés, kód lefedettség, feladatkezelés, fejlesztési műveletek (DevOps), elosztott - kooperatív rendszerek és fejlesztés.
EOF;

$l['tab-data-personal'] = [
    [
        'field' => 'Név',
        'content' => 'László Patrik'
    ],
    [
        'field' => 'Születési idő',
        'content' => '1978. December 8.'
    ],
    [
        'field' => 'Web',
        'content' => URL,
        'type' => 'url'
    ],
    [
        'field' => 'GitHub',
        'content' => 'https://github.com/patrikx3',
        'type' => 'url'
    ],
    [
        'field' => 'NPM',
        'content' => 'https://www.npmjs.com/~patrikx3',
        'type' => 'url'
    ],
    [
        'field' => 'Travis',
        'content' => 'https://travis-ci.org/patrikx3/',
        'type' => 'url'
    ],
    [
        'field' => 'E-mail / G-Talk',
        'content' => EMAIL,
        'type' => 'email'
    ],
    [
        'field' => 'Skype',
        'content' => 'nanoneuron',
    ],
    [
        'field' => 'Mobil',
        'content' => PHONE,
    ],
    [
        'field' => 'Ipar',
        'content' => 'Informatika, Távközlés'
    ],
    [
        'field' => 'Munkakör',
        'content' => 'Kooperatív rendszerek, Rendszer Építés, Fejlesztési Műveletek (DevOps) és hacking',
    ],
    [
        'field' => 'Használt nyelvek',
        'content' => 'Magyar és Angol'
    ],
    [
        'field' => 'Programozás',
        'content' => '1984',
        'type' => 'since',
    ],
    [
        'field' => 'Vállalkozás',
        'content' => '1998',
        'type' => 'since',
    ]
];

$l['tab-data-skills'] = [
    [
        'field' => 'Keretrendszerek',
        'type' => 'badge',
        'content' => 'Electron, AngularJs, Angular TS, WebPack, SocketIO, Grunt, J2EE, .NET, ASP, ASP.NET/MVC, jQuery, ExtJs, CodeIgniter, Yii, SASS, LESS, NodeJs, Bootstrap, AngularJs Material, Angular Material 2',
    ],
    [
        'field' => 'Nyelv / Jelölőnyelv',
        'type' => 'badge',
        'content' => 'TypeScript, Javascript, Java, PHP, C#, C, HTML, CSS, VBScript, C++, SQL, Visual Basic, Android, Basic, Assembly, Pascal, Perl, XPath, XSL, XML, JSON, NoSQL',
    ],
    [
        'field' => 'Módszerek',
        'type' => 'badge',
        'content' => 'UML, tervezési minták (design patterns), web, mobil, desktop, szerver, teszt alapú fejlesztés, model alapú fejlesztés, szervíz központú rendszerek, extrém programozás, pár programozás, aszinkron programozás, folyamatos integráció'
    ],
    [
        'field' => 'Adatbázisok',
        'type' => 'badge',
        'content' => 'Redis, MongoDb, MySQL, MariaDB, Microsoft SQL Server, PostgreSQL, Tamino XML Server',
    ],
    [
        'field' => 'Alkalmazások',
        'type' => 'badge',
        'content' => ' Docker, Jenkins, Enterprise Architect, Microsoft Project, Eclipse, Visual Studio, IntelliJ IDEA, Photoshop, Illustrator'
    ],
    [
        'field' => 'Folyamatfejlesztés',
        'content' => 'Scrum, Agile, Rational Unified Process, Iterative, Fejlesztési Műveletek (Dev Ops)',
        'type' => 'badge'
    ],
];

$l['tab-data-education'] = [
    [
        'name' => 'Bánki Donát Főiskola',
        'faculty' => 'Informatika szak',
        'date-end' => 1999
    ],
    [
        'name' => 'Budapesti Műszaki Egyetem',
        'faculty' => 'Villamosmérnök szak',
        'date-start' => 1997,
        'date-end' => 1999
    ]
];

$l['company-info'] = [
    'sygnus' => [
        'info' => 'Ko-operatív rendszerek. Új generációs integrált vállalatirányítási rendszer. Támogatom a fejlesztőkeket és építek. Sok komponens. Beépítettem a folyamatos integrációt - Jenkins / Mocha / Protractor és automatikus telepitéseket. Átnézem a teljes rendszert és fejlesztek.',
    ],
    'clickandlike' => [
        'info' => 'Különböző platformok, nyelvek és keretek között dolgoztam PHP, NodeJs, Java és Android. Mentorálás.',
    ],
    'corifeus' => [
        'info' => 'Vállalkozó vagyok. Több nyelven dolgozok - szkriptek és bináris platformokon. Általában 2-3 projektek és a csapat körülbelül 5 fő. A költségvetés között 500 - 50.000 dollár. Rational Unified Process és UML.',
    ],
    'grosvenor-enterprises' => [
        'info' => 'Vállalkozónak dolgoztam Microsoft rendszereken (ASP, VBScript, .NET, C), SQL Server és Java.',
    ],
    'infomatix' => [
        'info' => 'Mint tapasztalt fejlesztőnek dolgoztam. Microsot Excel / SQL Analysis integrációt csináltunk.',
    ],
    'epam' => [
        'info' => 'Voltam fejlesztő, csapatvezető és projekt menedzser. Java, .NET használtunk és Scrum.',
    ],
];