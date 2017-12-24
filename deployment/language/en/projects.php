<?php
use Config\Projects;

$l = [];

$l['title-note']
    = <<<EOF
<span class="label label-info note">Note:</span> This is an overview and doesn’t include the complete list. Some of the programming (mostly e-commerce) and most of the visual design and animation related projects have been taken out to make the list “shorter”. We are usually running multiple projects simultaneously which extends the list fast.
EOF;

$l['format-date'] = 'm/d/Y';

$l['title'] = 'Projects';

$l['title-jump-employer'] = 'Jump to the employer';

$l['title-project'] = 'Project';
$l['title-company'] = 'Employer';
$l['title-location'] = 'Location';
$l['title-date'] = 'Date';
$l['title-role'] = 'Role';
$l['title-task'] = 'Tasks';
$l['title-technology'] = 'Technology';
$l['title-url'] = 'Link';
$l['title-youtube'] = 'Youtube';
$l['title-summary'] = 'Summary';
$l['title-image'] = 'Picture';
$l['title-flash'] = 'Flash';
$l['title-in-progress'] = 'The project is still in progress';

$l['projects'] = [
    'era-2015' => [
        'title' => '2015 - Now',
        'items' => [
            [
                'location' => 'Hungary, Dunaújváros',
                'role' => 'Senior Software Systems Architect, Development Operations Engineer (DevOps) and hacker',
                'tasks' => 'Mentoring, Planning, Automation, Development, Developer support',
                'summary' => 'New generation integrated enterprise management system. I support the developers and architect.  Lots of components. I implemented continuous integration - Jenkins / Mocha / Protractor and build deployments. I overview the system and develop.',
            ],
            [
                'location' => 'Hungary, Dunaújváros',
                'role' => 'Contractor',
                'tasks' => 'Maintenance ',
            ],
            [
                'location' => 'Hungary, Dunaújváros',
                'role' => 'Contractor',
                'tasks' => 'Maintenance',
                'summary' => 'I have implemented multiple integration like Blackboard, Canvas, Google, Haiku, Lti. They all use REST, except Blackboard which is Java based and the programmers use are .NET , so I have to help them. I worked them as a employee for over 3 and a half years.'
            ],
            [
                'location' => 'Hungary, Dunaújváros',
                'role' => 'Senior Software Engineer',
                'tasks' => 'Bank calculations, Drupal module, Database design, Frontend, Backend',
                'summary' => 'To compare several banks, such as bank account, credit, loans and savings. The credit calculation is relatively complex, because there is no linear formula. There was a final result and formula, we had to find the zero outcome (goal seek).'
            ],
            [
                'location' => 'Hungary, Dunaújváros',
                'role' => 'Senior Software Engineer',
                'tasks' => 'Hungarian translation, Chat, Anonymous upload',
                'summary' => '
                There was only english Alfresco working well. I had to create the new translations in hungarian. Also it was only availbale for our clients, not everyone, private. The other solution was to create an internal system for chatting. I used EJabbered XMPP server where I integrated Alfresco using the ConverseJS JavaScript client so that everything became automatic. The other task was to make the user to be able to upload files without login with a URL. I created a key that was to validate the URL using AES 256 bit.'
            ],
            [
                'location' => 'Hungary, Dunaújváros',
                'role' => 'Senior Software Engineer',
                'tasks' => 'GUI, Stream services, notification',
                'summary' => 'I was appointed to create the Radio 1 Stream using a notification bar that can be done with the lock GUI as well. I had to squeeze the program into 16MB memory.',
            ],
            [
                'location' => 'Hungary, Dunaújváros',
                'role' => 'Senior Software Engineer',
                'tasks' => 'Bugs, new features',
            ],
            [
                'location' => 'Hungary, Dunaújváros',
                'role' => 'Senior Software Engineer',
                'tasks' => 'Bugs, new features',
                'summary' => 'Human Resources data information portal / application.',
            ],
            [
                'location' => 'Hungary, Dunaújváros',
                'role' => 'Senior Software Engineer',
                'tasks' => 'Bugs, new features',
            ]
        ]
    ],
    'era-2010' => [
        'title' => '2010 - 2015',
        'items' => [
            [
                'location' => 'Hungary, Balassagyarmat - Dunaújváros',
                'role' => 'Software Architect',
                'task-normal' => 'Architect the next generation of class management system on top of the existing in SOA and re-design the ASP system in .NET MVC with a choice of freely chosen tools',
            ],
            [
                'location' => 'Hungary, Dunaújváros',
                'role' => 'Senior Software Engineer',
                'tasks' => 'Backend development',
                'summary' => 'To help in the development of the 4CSX product, related projects and experimental features. Key responsibilities and accountabilities: Producing new features, Fixing bugs in any product, Testing existing or newly developed features, General software development tasks including databases, web applications, back-end systems and integrated components.'
            ],
            [
                'location' => 'Hungary, Dunaújváros',
                'role' => 'Senior Software Engineer',
                'tasks' => 'Module development and development',
            ]
        ]
    ],
    'era-2005' => [
        'title' => '2005 - 2010',
        'items' => [
            [
                'location' => 'Hungary, Dunaújváros',
                'role' => 'Contractor',
                'task-normal' => 'Design the web look and debug the web application',
            ],
            [
                'location' => 'Hungary, Dunaújváros',
                'role' => 'Contractor',
                'task-normal' => 'Webdialogue Joomla site maintenance www.community-intelligence.com maintenance and upgrade, http://www.euro-intelligence.eu site design',
            ],
            [
                'location' => 'Hungary, Dunaújváros',
                'role' => 'Contractor',
                'task-normal' => 'A full AJAX-SOA application to administer a bank system web site.',
            ],
            [
                'location' => 'USA / Magyarország',
                'role' => 'Contractor',
                'task-normal' => 'MediaBlend products– GoSignMeUp, GoSiteBuilder, GoWebStore - maintenance and development, product and API design, Blackboard integration with MediaBlend GoSignMeUp educational system , LDAP Integration of GSMU, NBC Universal, Blackboard integration',
            ],
            [
                'location' => 'Hungary, Budapest',
                'role' => 'Senior Software Engineer',
                'task-normal' => 'Develop a color textile color recognition system for clothing manufacturing for Hugo Boss.',
                'technology' => 'ASP.NET 3.5, Hardware programming, Web 2.0',
            ],
            [
                'location' => 'Hungary, Budapest',
                'role' => 'Senior Software Engineer',
                'task-normal' => 'Help and support the software engineers, complex tasks, Excel add-in development, OLAP decision support systems',
            ],
            [
                'location' => 'Hungary, Budapest',
                'role' => 'Software Development Engineer',
                'tasks' => 'Maintenance, development, bug fixing, system design improvements',
                'summary' => 'Aerospace insurance system.'
            ],
            [
                'location' => 'Hungary, Budapest',
                'role' => 'Software Development Engineer',
                'task-normal' => 'Implement a secure welcome center feature for the latest Visual Studio product.',
                'summary' => 'Welcome center feature for Visual Studio Orcas.'
            ],
            [
                'location' => 'Denmark, Vedbæk',
                'role' => 'Software Development Engineer / Team leader',
                'summary' => 'Microsoft Business Framework controls development.',
                'task-normal' => 'Analysis, design, development and testing of controls as a consultant',
            ],
            [
                'location' => 'Hungary, Budapest',
                'role' => 'Software Development Engineer / Project Manager',
                'summary' => 'System consists of 3 servers: application, document and database server.',
                'task-normal' => 'Maintenance, development, bug fixing, project delivery, customer relationship management, training',
            ],
            [
                'location' => 'Hungary, Budapest',
                'role' => 'Contractor',
                'summary' => 'J2ME based casino game.',
                'tasks' => 'Analysis, quality assurance',
            ]
        ]
    ],
    'era-1998' => [
        'title' => '1998 - 2005',
        'items' => [
            [
                'location' => 'USA, California',
                'role' => 'Contractor',
                'task-normal' => 'Integration with Mas90 accounting, extensions, automation, bug fixing.',
            ],
            [
                'location' => 'USA, California',
                'role' => 'Contractor',
                'task-normal' => 'Design and implementation of a .Net client library.',
            ],
            [
                'location' => 'USA, California',
                'role' => 'Project manager',
                'task-normal' => 'Advertisement, branding, marketing presentation development utilizing cheap overseas resources',
            ],
            [
                'location' => 'USA, California',
                'role' => 'Contractor',
                'task-normal' => 'Health insurance data integration',
            ],
            [
                'location' => 'USA, California',
                'role' => 'Project manager',
                'task-normal' => 'Advertisement, branding, box design, outsourcing',
            ],
            [
                'location' => 'USA, California',
                'role' => 'System Architect',
                'task-normal' => 'Design, implementation, documentation, test, deployment, support of system, integration with major GMAC real estate companies, RUP / UML, CVS, management of 3 additional developers',
            ],
            [
                'location' => 'USA, California',
                'role' => 'Project Manager',
                'task-normal' => 'Design, implement a Flash mailer that connects to a J2EE application for mass mailing',
            ],
            [
                'location' => 'USA, California',
                'role' => 'Software Development Engineer',
                'task-normal' => 'Real Estate agent search engine web application',
            ],
            [
                'location' => 'USA, California',
                'role' => 'Project manager',
                'task-normal' => 'Advertisement, Flash presentation, new web based look utilizing cheap overseas resources',
            ],
            [
                'location' => 'USA, California',
                'role' => 'Software Development Engineer',
                'task-normal' => 'Multi-lingual portal web applications (search engine, chat, matchmaking), internationalization, data mining applications, general purpose Java Swing libraries, Mnogosearch search engine bug fixes.',
            ],
            [
                'location' => 'USA, California',
                'role' => 'IT Manager',
                'task-normal' => 'Network support, systems development, accounting, apparel design and development, manufacturing.',
            ],
            [
                'location' => 'Hungary, Budapest',
                'role' => 'Y2K Project Coordinator',
                'task-normal' => 'Project coordination, testing and reporting.',
            ],
            [
                'location' => 'Hungary, Budapest',
                'role' => 'Project Engineer',
                'task-normal' => 'Project development, implementation, testing, quality assurance and reporting. Hardware testing and software testing of National bank systems (Hungarian State Treasury and Savings Bank)',
            ]
        ]
    ]
];

$l['projects'] = Projects::ProjectFiller($l['projects']);

