<?php
$l = [];
$l['title'] = 'Play';

$l['title-url'] = 'Link';
$l['title-summary'] = 'Summary';
$l['title-image'] = 'Picture';
$l['title-flash'] = 'Flash';


$l['playground'] = [
    [
        'summary' => 'The future is on GitHub.',
    ],

    [
        'summary' => 'This is an async/await Promise based Freenom API package for the free DNS, it auto renews the domains that are about to be expired.',
    ],

    [
        'summary' => 'Gitlist with web workers, multiple themes (dark/light), editor - Code Mirror, sub-modules, uglify-es, webpack, toast, pure Bootstrap 3 and upgraded to PHP7.1 with all components.',
    ],

    [
        'summary' => 'LEDE Insomnia is a Linksys WRT and Rasberry PI Docker based build with addons and fix, plus my LEDE packages are as well built from the stable source.',
    ],

    [
        'summary' => 'This is the LEDE based Redis of stable source.',
    ],

    [
        'summary' => 'This is the LEDE based MariaDB 5.5.',
    ],

    [
        'summary' => 'I haven\'t had more free domains, so I helped the FreeDns Afraid system, so I got more free 50 sub-domains / domain.',
    ],
    [
        'title' => 'Linux Onenote',
        'summary' => 'I use Onenote. I love it. There is no alternative in Linux, so I created. It is slow, needs cache. Don\'t have time for everything. Life is short.',
    ],
    [
        'title' => 'RAM disk',
        'summary' => 'Persistent RAM disk. Works with suspend. Configurable of saving the RAM to HDD. Very fast',
    ],
    [
        'title' => 'AES Encrypt / Decrypt',
        'summary' => 'Encrypt a folder or decrypt a file into a folder with AES 256 security.',
    ],
    [
        'title' => 'SystemD Manager',
        'summary' => 'It is a Linux based SystemD manager. Notifies via e-mail with NodeMailer, it polls via an interval, it also has a wrapper for DBus to manage services and via events as well if you do not like polling.',
    ],
    [
        'title' => 'Angular Dynamic Compile',
        'summary' => 'Works with AOT + JIT Angular dynamic component compilator (service + directive/attribute)..',
    ],
    [
        'title' => 'Corifeus Software Architecture',
        'summary' => 'I am interested in software and building. Analysis, design, architecture, iterative, xyz driven, deployment and in the end: product. A started building a platform. Technologies: Angular TypeScript, Angular Material 2, SocketIO, MongoDB, Express',
        'url' => [
            'GitHub' => 'https://github.com/patrikx3/corifeus',
            'Name' => 'https://en.wikipedia.org/wiki/Coryphaeus',
            'Corifeus pages' => 'http://pages.corifeus.com',
        ],

    ],
    [
        'title' => 'Resume',
        'summary' => 'I have created an updated new resume with the latest technologies: PHP 7, PHP Unit, Node Js, Mocha, Composer, Docker, Travis, Scrutinizer, GitHub, Uglify, Grunt, PHP Doc, Yui Doc, Karma, PhantomJS. <a data-toggle="modal" data-target="#layout-status-modal" p3x-ajax-href="/modal/status" href="/modal/status">Check out the web site deployment status</a>.',
    ],
    [
        'title' => 'Fortune cookie',
        'url' => [
            'Facebook' => 'https://apps.facebook.com/new-fortune-cookie/',
            'GitHub' => 'https://github.com/patrikx3/fortune-cookie'
        ],
        'summary' => 'I just like Furtune cookies so I created a small Facebook application.',
    ],
    [
        'title' => 'Address-book',
        'url' => [
            'Live' => 'http://address-book.patrikx3.com/?locale=en',
            'GitHub' => 'https://github.com/patrikx3/address-book'
        ],
        'summary' => 'I created a full SOA/Ajax web site with one page.'
    ],
    [
        'title' => 'Service Manager Tray for Windows',
        'summary' => 'Do you spend lots of time starting up the service manager? Do you debug a lot and start/stop/restart services? If so, you came to the right place!'
    ],
    [
        'title' => 'Corifeus sites',
        'summary' => 'In <span class="label label-default label-fix">1999</span> - <span class="label label-default  label-fix">2005</span> I created a few web systems and here are the pictures.'
    ],
    [
        'title' => 'Corifeus graphics',
        'summary' => 'In <span class="label label-default label-fix">1999</span> - <span class="label label-default label-fix">2005</span> I love GUI and graphics, here is what I did - old school.'
    ],
    [
        'title' => 'Corifeus',
        'summary' => 'In <span class="label label-default label-fix">1999</span> - <span class="label label-default label-fix">2005</span> I had a company in Los Angeles and I had my first web corporate site.'
    ],
    [
        'title' => 'Flash / Shockwave',
        'summary' => 'In <span class="label label-default label-fix">1999</span> I made my first Flash - Shockwave site. Old school :)'
    ]
];

$l['playground'] = \Config\PlayGround::PlaygroundFiller($l['playground']);