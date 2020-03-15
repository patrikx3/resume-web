<?php

use P3x\Str;

$l = array();
$l['title'] = 'Resume';

$l['data-since'] = 'since %s';
$l['data-since-pdf'] = 'since %s' . PROJECT_DIVIDER . 'about %s years';

$l['tab-cover'] = 'Cover';
$l['tab-personal'] = 'Personal';
$l['tab-skills'] = 'Skill';
$l['tab-education'] = 'Education';
$l['tab-employment'] = 'Employer';

$l['tab-cover-id'] = Str::ToUrl($l['tab-cover']);
$l['tab-personal-id'] = Str::ToUrl($l['tab-personal']);
$l['tab-skills-id'] = Str::ToUrl($l['tab-skills']);
$l['tab-education-id'] = Str::ToUrl($l['tab-education']);
$l['tab-employment-id'] = Str::ToUrl($l['tab-employment']);


$l['tab-data-cover']
    = <<<EOF
Right now, I primarily focus on enterprise applications, microservices, web and Electron desktop applications.
<br/><br/>
I have been practicing imaging applications and coding since I was small. I really like beautiful animation and structured programming.
<br/><br/>
Since about 2000, I have been using object-oriented and functional programming. By about 2001, I have been building diagrams and models. I like architect, Microsoft and alike tools.
<br/><br/>
Usually, I engineer web based systems, but I deal with other applications as well.  I like server, client, desktop, mobile, database and component methods.  I architect simple solutions, that are independent of operating system, language and framework.
<br/><br/>
What I like and do: analysis, architecture, test, build, continuous integration, code style, code review, documentation, deployment, code coverage, tasks, developer support, development operations (DevOps), distributed - co-operative systems and development aka <strong>full-stack</strong>.
EOF;


$l['tab-data-personal'] = [
    [
        'field' => 'Full name',
        'content' => 'Patrik Laszlo'
    ],
    [
        'field' => 'Birth date',
        'content' => 'December of 8th 1978.'
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
        'content' => 'https://travis-ci.com/patrikx3/',
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
        'field' => 'Mobile',
        'content' => PHONE,
    ],
    [
        'field' => 'Industry',
        'content' => 'Information Technology, Telecommunication'
    ],
    [
        'field' => 'Role',
        'content' => 'Full-stack  developer aka enterprise architect, sys-admin (DevOps)'
    ],
    [
        'field' => 'Used languages',
        'content' => 'Hungarian and English'
    ],
    [
        'field' => 'Programming',
        'content' => '1984',
        'type' => 'since',
    ],
    [
        'field' => 'Business',
        'content' => '1998',
        'type' => 'since',
    ]
];

$l['tab-data-skills'] = [
    [
        'field' => 'Frameworks',
        'content' => 'Electron, AngularJs, Angular, NodeJs, Bootstrap, AngularJs Material, Angular Material/Components, SASS, LESS, WebPack, Socket.IO, Grunt, J2EE, .NET, ASP, ASP.NET/MVC, jQuery, ExtJs, CodeIgniter, Yii',
        'type' => 'badge'
    ],
    [
        'field' => 'Language / Markup',
        'type' => 'badge',
        'content' => 'Javascript, C++, TypeScript, Java, PHP, C#, C, HTML, CSS, VBScript, SQL, Visual Basic, Android, Basic, Assembly, Pascal, Perl, XPath, XSL, XML, JSON, NoSQL',
    ],
    [
        'field' => 'Methodologies',
        'content' => 'UML, design patterns, web, mobile, desktop, server, test driven development, model driven development, SOA, extreme programming, pair programming, asynchronous programming, continuous integration',
        'type' => 'badge'
    ],
    [
        'field' => 'Databases',
        'content' => 'Redis, MongoDb, MySQL, MariaDB, Microsoft SQL Server, PostgreSQL, Tamino XML Server',
        'type' => 'badge'
    ],
    [
        'field' => 'Applications',
        'content' => 'Docker, Jenkins, Enterprise Architect, Microsoft Project, Eclipse, Visual Studio,IntelliJ IDEA, Photoshop, Illustrator',
        'type' => 'badge'
    ],
    [
        'field' => 'Process development',
        'content' => 'Scrum, Agile, Rational Unified Process, Iterative, Development Operations (Dev Ops)',
        'type' => 'badge'
    ],
];


$l['tab-data-education'] = [
    [
        'name' => 'College of Donát Bánki ',
        'faculty' => 'Computer Science',
        'date-end' => 1999
    ],
    [
        'name' => 'Technical University of Hungary',
        'faculty' => 'Electronic Engineering',
        'date-start' => 1997,
        'date-end' => 1999
    ]
];

$l['company-info'] = [
    'duovill' => [
        'info' => 'We are working with new AI technologies using NodeJs/C++ and Angular Material full-stack systems.',
    ],
    'sygnus' => [
        'info' => 'Co-operative systems. We are creating new generation integrated enterprise management systems. I support the developers and architect. We create component based systems. We implement continuous integration and automatic build deployments. I overview the systems and develop.',
    ],
    'clickandlike' => [
        'info' => 'I have worked various platforms, languages and frameworks including PHP, NodeJs, AngularJs, Java and Android. Mentoring.',
    ],
    'corifeus' => [
        'info' => 'I am an enterprise full-stack consultant. I use multiple languages including from scripts to binary platforms. I use usually 2-3 projects and about 5 people at once. The budget is between $500 - $50,000. I use Rational Unified Process and UML.',
    ],
    'grosvenor-enterprises' => [
        'info' => 'I was a contractor using usually Microsoft (ASP, VbScript, .NET, C), SQL server and Java.',
    ],
    'infomatix' => [
        'info' => 'I was a senior software engineer for Microsot Excel / SQL Analysis integration.',
    ],
    'epam' => [
        'info' => 'My roles included developer, team developer and project manager. I used .NET, Java and Scrum.',
    ],
];
