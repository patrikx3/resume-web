<?php
$l = [];
$l['title'] = 'Játék';

$l['title-url'] = 'Link';
$l['title-summary'] = 'Összefoglaló';
$l['title-image'] = 'Kép';
$l['title-flash'] = 'Flash';

$l['flash-info'] = 'Néha, a Flash link csak akkor működik, ha kétszer klikkelsz rá';

$l['fyi']
    = <<<EOF
<span class="label label-info note">Info:</span> Néhány projekt elavult és törölve van, így lehetséges, hogy néhány link már nem található.
EOF;

$l['playground'] = [

    [
        'summary' => 'A jövőben, a játszótéren, minden új program a GitHub-on van.',
    ],

    [
        'summary' => '📡 P3X Redis UI technológiai: Socket.IO, AngularJs Material és IORedis statisztikái, konzol - terminal, fa kulcsok, sötét mód, lehetséges több nyelvű UI, több kapcsolatok, web and Electron.',
    ],

    [
        'summary' => 'Ez egy async/await Promise alapú Freenom API csomag ennek az ingyenes DNS-nek, autómatikusan megújítja a domaineket amik lejárnak.',
    ],

    [
        'summary' => 'Ez egy P3X Gitlist al-modulokkal, webes munkással (web worker), szerkesztő - Code Mirror, uglify-es, webpack, toast, tiszta Bootstrap 3 és plusz sminkkel és frissítve PHP 7-re és minden csomag is frissítve van.',
    ],

    [
        'title' => 'LEDE / OpenWrt Álmatlanság',
        'summary' => 'LEDE / OpenWrt Álmatlanság a Linksys WRT és Rasberry PI Docker alapú építő plusz funkciókkal és pár hiba nem működött, plusz a saját LEDE csomagok is építelve vannak. Mind a LEDE stabil forrásból van.',
    ],

    [
        'summary' => 'LEDE / OpenWrt alapú Redis a stabil forrásból.',
    ],

    [
        'summary' => 'LEDE alapú MariaDB 10.',
    ],
    [
        'summary' => 'Onenote-t használok. Szeretem. Linuxben még nincs meg, úgyhogy csináltam egyet. Kicsit még lassú, cache kell neki. Csak nincs időm mindenre.',
    ],
    [
        'title' => 'RAM disk',
        'summary' => 'Egy Linux / Unix / BSD / OSX, ami tartós RAM disk - HDD. Nagyon gyors',
    ],
    [
        'title' => 'AES kódolásához / dekódolásához titkosítás',
        'summary' => 'Bekódolni egy mappát 256 bit-os AES-al vagy dekódoláshoz kibontani egy fájlt.',
    ],
    [
        'title' => 'SystemD Menedzser',
        'summary' => 'A Linux SystemD eseményeket elküldi e-mailben és menedzser is.',
    ],
    [
        'title' => 'Angular dinamikus fordító',
        'summary' => 'Ddinamikusan Angular komponens html-ből (AOT + JIT) csinál.',
    ],
    [
        'title' => 'Corifeus Szoftver Architektúra',
        'summary' => 'Érdekel az architektúra. Elemzés, tervezés, tervezés, ismétlődő, xyz vezetés, telepítés és végül: termék. Elkezdtem egy teljesen új platformot. Technológiák: Angular TypeScript, Angular Material/Components, Socket.IO, MongoDB, Express',
        'url' => [
            'GitHub' => 'https://github.com/patrikx3/corifeus',
            'Név' => 'http://www.kislexikon.hu/korifeus.html',
            'Corifeus oldalok' => 'http://corifeus.com',
        ],
    ],
    [
        'title' => 'Önéletrajz',
        'summary' => 'Csináltam egy újabb önéletrajzot a legfiresseb technológiák: PHP 7, PHP Unit, Node Js, Mocha, Composer, Docker, Travis, Scrutinizer, GitHub, Uglify, Grunt, PHP Doc, Yui Doc, Karma, PhantomJS. <a data-toggle="modal" data-target="#layout-status-modal" p3x-ajax-href="/modal/status" href="/modal/status">Nézze meg a web oldal telepítése.</a>.',
    ],
    [
        'title' => 'Szerencse süti',
        'url' => [
            'Facebook' => 'https://apps.facebook.com/szerencse-suti/',
            'GitHub' => 'https://github.com/patrikx3/fortune-cookie'
        ],
        'summary' => 'Csak szeretem a szerencse sütit, ezért csináltam egy Facebook appot.',
    ],
    [
        'title' => 'Címjegyzék',
        'url' => [
            'Élő' => 'http://address-book.patrikx3.com/?locale=hu',
            'GitHub' => 'https://github.com/patrikx3/address-book'
        ],
        'summary' => 'Volt időm és csináltam egy tiszta SOA - AJAX web oldalat ahol csak egy oldal volt.'
    ],
    [
        'title' => 'Service Manager Tray for Windows',
        'summary' => 'Csináltam egy Windows app-ot, hogy lehet kedvenc Windows szolgáltatások, hogy könnyűn lehet leállítani és inditani szolgáltatások.'
    ],
    [
        'title' => 'Corifeus web oldalak',
        'summary' => '<span class="label-fix label label-default">1999</span> - <span class="label-fix label label-default">2005</span> között csináltam egy pár web rendszeret, itt vannak a képek, amiket csináltam.'
    ],
    [
        'title' => 'Corifeus grafikai',
        'summary' => '<span class="label-fix label label-default">1999</span> - <span class="label-fix label label-default">2005</span> között csináltam. Nagyon szeretem a GUI-t és a grafikát, itt van néha kép amit csináltam.'
    ],
    [
        'title' => 'Corifeus',
        'summary' => '<span class="label-fix label label-default">1999</span> - <span class="label-fix label label-default">2005</span> között csináltam egy pár web rendszeret, és volt egy cégem Los Angeles-ben, amiben volt egy web oldalam, ami megmaradt.'
    ],
    [
        'title' => 'Flash / Shockwave',
        'summary' => '<span class="label-fix label label-default">1999</span>-ben az első Flash - Shockwave web oldalam. Old school :)'
    ]
];

$l['playground'] = \Config\PlayGround::PlaygroundFiller($l['playground']);
