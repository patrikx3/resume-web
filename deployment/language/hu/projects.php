<?php

use Config\Projects;

$l = [];

$l['title-note']
    = <<<EOF
<span class="label label-info note">Info:</span> Kérem, lépjen kapcsolatba velem, hogy megkapja a legfrissebb önéletrajzomat.
EOF;

$l['format-date'] = 'Y. m. d.';

$l['title-jump-employer'] = 'Ugrás a céghez';

$l['title'] = 'Munkák';

$l['title-project'] = 'Projekt';
$l['title-company'] = 'Cég';
$l['title-location'] = 'Helyszín';
$l['title-date'] = 'Dátum';
$l['title-role'] = 'Beosztás';
$l['title-task'] = 'Feladatok';
$l['title-technology'] = 'Technológia';
$l['title-url'] = 'Link';
$l['title-youtube'] = 'Youtube';
$l['title-summary'] = 'Összefoglaló';
$l['title-image'] = 'Kép';
$l['title-flash'] = 'Flash';
$l['title-in-progress'] = 'Ez a munka még folyamatban van';


$l['projects'] = [
    'era-2020' => [
        'title' => '2020 - Most',
        'items' => [
            [
                'location' => 'Magyarország, Dunaújváros',
                'role' => 'Szenior Full-stack Fejlesztő',
                'tasks' => 'Tervezés, automatizálás, fejlesztés, fejlesztői támogatás',
                'summary' => 'Az NGIVR Sygnus-on alapuló vállalati erőforrás-tervezési rendszerfejlesztés.',
            ],
            [
                'project' => 'NGIVR v2 Portál Adony',
                'location' => 'Hungary, Dunaújváros',
                'role' => 'Teknikai tervező',
                'tasks' => 'Tervezés, Fejlesztés',
                'summary' => 'Sygnus NGIVR v2 alapú stack alapú partner portál IVR rendszer.',
            ],
            [
                'location' => 'Magyarország, Dunaújváros',
                'role' => 'Programozó',
                'tasks' => 'Kutatás, Fejlesztés',
                'summary' => 'Egy Raspberry PI alapó robot, ami kiszámítja a raktár méretét és mennyire üres. Egy robot, egy REST/Socket.IO alapú web kliens és egy NodeJs szerver C++ és WebGL-ell.',
                'technology' => 'NodeJs, AngularJs, AngularJs Material, MongoDB, JavaScript, Socket.IO, mesterséges intelligencia, WebGL, C++, OpenCV, ArrayFire',

            ],
            [
                'project' => 'NGIVR v1',
                'location' => 'Magyarország, Dunaújváros',
                'role' => 'Szenior Full-stack Fejlesztő',
                'tasks' => 'Tervezés, automatizálás, fejlesztés, fejlesztői támogatás',
                'summary' => 'Az NGIVR Sygnus-on alapuló vállalati erőforrás-tervezési rendszerfejlesztés.',
            ],
            [
                'location' => 'Magyarország, Dunaújváros',
                'role' => 'Szenior Full-stack Fejlesztő',
                'tasks' => 'Tervezés, automatizálás, fejlesztés, fejlesztői támogatás',
                'summary' => 'Az NGIVR Sygnus-on alapuló vállalati erőforrás-tervezési rendszerfejlesztés.',
            ],
            [
                'location' => 'Magyarország, Dunaújváros',
                'role' => 'Vállalati  teknikai tervező',
                'tasks' => 'Tervezés, Automatizálás, Fejlesztők támogatása, Fejlesztés',
                'summary' => 'Új generációs integrált vállalatirányítási rendszereket építünk. Támogatom a fejlesztőkeket. Komponens alapú rendszereket írunk. Folyamatos integrációt és automatikus telepitéseket használunk. Átnézem a teljes rendszereket és fejlesztek.'
            ],
        ]
    ],
    'era-2015' => [
        'title' => '2015 - 2020',
        'items' => [
            [
                'location' => 'Magyarország, Dunaújváros',
                'role' => 'Szenior Frontend vállalkozó',
                'tasks' => 'Frontend fejlesztés, diagramok, video',
                'summary' => 'Vállalati frontend tanácsadás.',
            ],

            [
                'location' => 'Magyarország, Dunaújváros',
                'role' => 'Szenior Frontend Fejlesztő',
                'tasks' => 'Web oldal',
                'summary' => 'Nem volt több ingyenes domain-em és segítettem a FreeDns Afraid rendszernek, így 5 évig plusz 50 ingyenes al-domain / domain-t kaptam.',
            ],
            [
                'location' => 'Magyarország, Dunaújváros',
                'role' => 'Szenior Full-stack Fejlesztő',
                'tasks' => 'Karbantartás',
            ],
            [
                'location' => 'Magyarország, Dunaújváros',
                'role' => 'Szenior Full-stack Fejlesztő',
                'tasks' => 'Karbantartás',
                'summary' => 'Több integrációt csináltam, mint Blackboard, Canvas, Google, Haiku, Lti. Mind REST, de Blackboard az Java, ezért segíteni kell, mert ott mindenki .NET-es. Több, mint 3 és fél évig alkalmazott voltam.'
            ],
            [
                'location' => 'Magyarország, Dunaújváros',
                'role' => 'Szenior Full-stack Fejlesztő',
                'tasks' => 'Bank kalkulációk, Drupal modul, Adatbázis tervezés, Frontend, Backend',
                'summary' => 'Összehasonlítani több bankokat, mint bankszámla, hitel, kölcsön és megtakarítás. A hitel kalkuláció viszonylag komplex, mert nincs lineáris képlet. Volt egy végeredmeny és egy funkció, ennek kellett megtalálni a nulla végeredményét (célérték keresése - goal seek).'
            ],
            [
                'location' => 'Magyarország, Dunaújváros',
                'role' => 'Szenior Full-stack Fejlesztő',
                'tasks' => 'Magyarítások, Chat, Anonym feltöltés',
                'summary' => 'Az Alfresco rendszer csak angolul működött jól, ráadásul úgy kellett megcsinálni, hogy csak mi tudjuk magyarul működjön. A másik megoldás az volt, hogy kellett egy belső rendszer, ahol chatelni tudtak. Az EJabbered XMPP szervert használtam és integráltam Alfresco-t a JavaScript ConverseJS klienssel úgy hogy minden automatikus lett, csak klikkelni kellett. A másik feladat volt, hogy tudjanak feltölteni az Alfresco-ba egy linkkel, hogy ne kelljen belépni, de titkos legyen. 256-bitos AES kódot csináltam.'
            ],
            [
                'location' => 'Magyarország, Dunaújváros',
                'role' => 'Szenior Full-stack Fejlesztő',
                'tasks' => 'GUI, Stream, figyelmeztetés',
                'summary' => 'Az volt a feladatom, hogy megcsináljam a Rádió 1 stream-t. Kellett egy Android info sáv, ami ráadásul lezárt telefonnal is működjön és 16 Mb memóriában is.',
            ],
            [
                'location' => 'Magyarország, Dunaújváros',
                'role' => 'Szenior Full-stack Fejlesztő',
                'tasks' => 'Hibák, új funkciók',
            ],
            [
                'location' => 'Magyarország, Dunaújváros',
                'role' => 'Szenior Full-stack Fejlesztő',
                'tasks' => 'Hibák, új funkciók',
                'summary' => 'Humánerőforrás adatok információs portál / alkalmazás.',
            ],
            [
                'location' => 'Magyarország, Dunaújváros',
                'role' => 'Szenior Full-stack Fejlesztő',
                'tasks' => 'Hibák, új funkciók',
            ]
        ]
    ],
    'era-2010' => [
        'title' => '2010 - 2015',
        'items' => [
            [
                'location' => 'Magyarország, Balassagyarmat - Dunaújváros',
                'role' => 'Nagyvállalati tervező',
                'task-normal' => 'Meglévő oktatási rendszer modernizálása, AJAX és Ext/jQuery kombinációval',
            ],
            [
                'location' => 'Magyarország, Dunaújváros',
                'role' => 'Szenior Szoftver Mérnök',
                'tasks' => 'Backend fejlesztés',
                'summary' => 'Annak érdekében, hogy a fejlesztés a 4CSX termék, a kapcsolódó projektek és kísérleti funkciók. Főbb feladatok és felelősségi: termelés új funkciók, hibákat bármely termék, tesztelés létező vagy újonnan kifejlesztett funkciókat, általános szoftverfejlesztési feladatokat, beleértve az adatbázisokat, webes alkalmazások, back-end rendszerek és integrált elemek.'
            ],
            [
                'location' => 'Magyarország, Dunaújváros',
                'role' => 'Szenior Szoftver Mérnök',
                'tasks' => 'Modulok tervezése és fejlesztése',
            ]
        ]
    ],
    'era-2005' => [
        'title' => '2005 - 2010',
        'items' => [
            [
                'location' => 'Magyarország, Dunaújváros',
                'role' => 'Vállalkozó',
                'task-normal' => 'A web oldal megtervezése és kifejlesztése mind vizuális és szoftver oldalról',
            ],
            [
                'location' => 'Magyarország, Dunaújváros',
                'role' => 'Vállalkozó',
                'task-normal' => 'Webdialogue Joomla site karbantartás, www.community-intelligence.com karbantartás és upgrade, http://www.euro-intelligence.eu/ site design, a cég klienseinek kiszolgálása',
            ],
            [
                'location' => 'Magyarország, Dunaújváros',
                'role' => 'Vállalkozó',
                'task-normal' => 'Egy SOA alapú bank rendszer adminisztációs oldal AJAX-al teljes egészében.',
            ],
            [
                'location' => 'USA / Magyarország',
                'role' => 'Vállalkozó',
                'task-normal' => 'Projektek kivitelezése, kapcsolattartás és kommunikáció a kliensekkel, a MédiaBlend termékeinek fejlesztése és tervezése,   (GoSignMeUp, GoSiteBuilder, GoWebStore), A GoSignMeUp, továbbiakban GSMU, rendszer integrációja a Blackboard rendszerrel (oktatási rendszerek), LDAP és GSMU integrácó és az NBC Universal rendszereinek a fejlesztése, BlackBoard integráció.',
            ],
            [
                'location' => 'Magyarország, Budapest',
                'role' => 'Szenior Fejlesztő Mérnök',
                'task-normal' => 'A Hugo Bossnak egy textil színét felismerő alkalmazás fejlesztésre színfelismerés automatizálására.',
                'technology' => 'ASP.NET 3.5, Hardware programozás, Web 2.0',
            ],
            [
                'location' => 'Magyarország, Budapest',
                'role' => 'Szenior Szoftver Fejlesztő',
                'task-normal' => 'A mérnökök segítsége és támogatása, bonyolult feladatok megoldása, excel add-in-ek készítése a kliensnek, OLAP döntés támogató rendszerek.',
            ],
            [
                'location' => 'Magyarország, Budapest',
                'role' => 'Szoftver Fejlesztő Mérnök',
                'tasks' => 'Karbantartás, fejlesztés',
                'summary' => 'Repülőgép biztosítási rendszer.'
            ],
            [
                'location' => 'Magyarország, Budapest',
                'role' => 'Szoftver Fejlesztő Mérnök',
                'task-normal' => 'Kivitelezés.',
                'summary' => 'Welcome center funkció a Visual Studio 2008 (Orcas) termékhez.'
            ],
            [
                'location' => 'Dánia, Vedbæk',
                'role' => 'Szoftver Fejlesztő Mérnök / Vezető Fejlesztő',
                'summary' => 'Microsoft Business Framework GUI fejlesztő.',
                'task-normal' => 'Analízis, tervezés, fejlesztés, prototípúsok tervezése a Microsoft Dynamics üzleti rendszerhez',
            ],
            [
                'location' => 'Magyarország, Budapest',
                'role' => 'Szoftver Fejlesztő Mérnök / Projekt felügyelet',
                'summary' => 'SOA biztosítási rendszer.',
                'tasks' => 'Karbantartás, fejlesztés, átadás, tréning, projekt tervezése, szaktanácsadás',
            ],
            [
                'location' => 'Magyarország, Budapest',
                'role' => 'Szoftver Fejlesztő Mérnök',
                'summary' => 'J2ME alapú casino game.',
                'tasks' => 'Minőségbiztosítás, problémamegoldás',
            ]
        ]
    ],
    'era-1998' => [
        'title' => '1998 - 2005',
        'items' => [
            [
                'location' => 'USA, Kalifornia',
                'role' => 'Rendszer tervező / Kivitelező',
                'task-normal' => 'A cég e-commerce rendszerének integrációja a Mas90 pénzügyi rendszerrel, a webes e-commerce rendszer kibővítése, automatizálás, karbantartás.',
            ],
            [
                'location' => 'USA, Kalifornia',
                'role' => 'Rendszer tervező / Kivitelező',
                'task-normal' => '.NET kliens kivitelezése egy SOA alkalmazáshoz.',
            ],
            [
                'location' => 'USA, Kalifornia',
                'role' => 'Munka vezető',
                'task-normal' => 'Reklám, arculattervezés, magyar arculattervező bevonásával',
            ],
            [
                'location' => 'USA, Kalifornia',
                'role' => 'Vállalkozó',
                'task-normal' => 'Égészségügyi rendszer integrációjához adat kovertáló GUI rendszer',
            ],
            [
                'location' => 'USA, Kalifornia',
                'role' => 'Munka vezető',
                'task-normal' => 'Reklám, arculattervezés, magyar erőforrás alkalmazása a kivitelezéshez',
            ],
            [
                'location' => 'USA, Kalifornia',
                'role' => 'Rendszer tervező',
                'task-normal' => 'Rendszertervezés, kivitelezés,dokumentáció, tesztelés, támogatás a cég belső rendszeréhez mely a GMAC amerikai rendszerével integrálódik, 3 helyi fejlesztő bevonásával ',
            ],
            [
                'location' => 'USA, Kalifornia',
                'role' => 'Munka vezető',
                'task-normal' => 'J2EE alapú marketing rendszer',
            ],
            [
                'location' => 'USA, Kalifornia',
                'role' => 'Szoftver Fejlesztő Mérnök',
                'task-normal' => 'Real Estate agent search engine web application',
            ],
            [
                'location' => 'USA, Kalifornia',
                'role' => 'Munka vezető',
                'task-normal' => 'Reklám, prezentáció, új webes arculat magyar erőförrások alkalmazásával',
            ],
            [
                'location' => 'USA, Kalifornia',
                'role' => 'Programozó',
                'task-normal' => 'UML alapú tervezés, portal rendszerek kivitelzése (kereső, adatbányászás, chat rendszer, társkereső rendszer).',
            ],
            [
                'location' => 'USA, Kalifornia',
                'role' => 'IT vezető',
                'task-normal' => 'Hálózati infrastruktúra fejlesztése, gyártási folyamatok automatizálása.',
            ],
            [
                'location' => 'Magyarország, Budapest ',
                'role' => 'Y2K Projekt Koordinátor',
                'task-normal' => 'Projektek kivitelezése, jelentés a vállalati vezetőknek.',
            ],
            [
                'location' => 'Magyarország, Budapest ',
                'role' => 'Projekt Mérnök',
                'task-normal' => 'Projekt tervezése és kivitelezése (minőségbiztosítás), jelentés a Magyar Államkincstár és a Takarékbank részére',
            ]
        ]
    ]
];

$l['projects'] = Projects::ProjectFiller($l['projects']);
