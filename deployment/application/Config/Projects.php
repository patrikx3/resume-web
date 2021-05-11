<?php

namespace Config;


use DateTime;

/**
 * Class Projects
 * @package Config
 */
class Projects
{
    /**
     * @param $locale_projects
     * @return array
     */
    public static function ProjectFiller($locale_projects)
    {
        $projects = static::Config();

        /*
        if (!isset($_REQUEST['full'])) {
            unset($projects['era-2020']);
        }
        */

        foreach ($projects as $era => $era_data) {
            $projects[$era]['title'] = $locale_projects[$era]['title'];
            for ($index = 0; $index < count($era_data['items']); $index++) {
                $projects[$era]['items'][$index] = array_merge($projects[$era]['items'][$index], $locale_projects[$era]['items'][$index]);
            }
        }
        return $projects;
    }

    /**
     * @return array
     */
    public static function Config()
    {
        $projects = [
            'era-2020' => [
                'items' => [
                    [
                        'index' => 3,
                        'project' => 'NGIVR v1',
                        'company' => 'Sygnus Kikötő',
                        'date-start' => new DateTime('2020-10-12'),
                        'technology' => 'NodeJs, AngularJs, AngularJs Material, MongoDB, JavaScript, Socket.IO, Observable, Redis, NGINX, GIT',
                        'country' => 'hu',

                        //   'full' => isset($_REQUEST['full']) || isset($_REQUEST['sygnus']),
                    ],
                    [
                        'index' => 2,
                        'company' => 'Adony Logisztikai Központ',
                        'date-start' => new DateTime('2020-08-24'),
                        'country' => 'hu',
                        'technology' => 'NodeJs, AngularJs, AngularJs Material, MongoDB Replication, JavaScript, Socket.IO, Distributed queues, Distributed clusters, Redis, Distributed document locks',
                        'image' => [
                            'files/projects/era-2020/ngivr-portal-adony/1.png',
                            'files/projects/era-2020/ngivr-portal-adony/2.png',
                            'files/projects/era-2020/ngivr-portal-adony/3.png',
                            'files/projects/era-2020/ngivr-portal-adony/4.png',
                        ],
                        //   'full' => isset($_REQUEST['full']) || isset($_REQUEST['sygnus']),
                    ],
                    [
                        'index' => 2,
                        'project' => 'NGIVR v1 Thermo Range',
                        'company' => 'DuóVill',
                        'date-start' => new DateTime('2018-12-11'),
                        'country' => 'hu',
                        'image' => [
                            'files/projects/era-2020/thermo/1.png',
                            'files/projects/era-2020/thermo/2.png',
                            'files/projects/era-2020/thermo/3.png',
                        ],
                        //   'full' => isset($_REQUEST['full']) || isset($_REQUEST['sygnus']),
                    ],
                    [
                        'index' => 3,
                        'company' => 'Adony Logisztikai Központ',
                        'date-start' => new DateTime('2018-11-13'),
                        'technology' => 'NodeJs, AngularJs, AngularJs Material, MongoDB, JavaScript, Socket.IO, Observable, Redis, NGINX, GIT',
                        'country' => 'hu',
                        'image' => [
                            'files/projects/era-2020/adony/1.jpg',
                            'files/projects/era-2020/adony/2.jpg',
                        ],
                        //   'full' => isset($_REQUEST['full']) || isset($_REQUEST['sygnus']),
                    ],
                    [
                        'index' => 4,
                        'project' => 'NGIVR v1',
                        'company' => 'DuóVill',
                        'date-start' => new DateTime('2018-04-01'),
                        // 'date-end' => new DateTime('2019-09-30'),
                        'technology' => 'NodeJs, AngularJs, AngularJs Material, MongoDB, JavaScript, Jenkins, Socket.IO, Observable, Redis, NGINX, GIT',
                        'country' => 'hu',
                        'image' => [
                            'files/projects/era-2020/duovill/1.jpg',
                            'files/projects/era-2020/duovill/2.jpg',
                        ],
                        //     'full' => isset($_REQUEST['full']) || isset($_REQUEST['duovill']),
                    ],
                    [
                        'index' => 5,
                        'project' => 'NGIVR v1',
                        'company' => 'Sygnus',
                        'date-start' => new DateTime('2016-10-20'),
                        'technology' => 'NodeJs, AngularJs, AngularJs Material, MongoDB, JavaScript, ES.Next, Babel, Jenkins, Upsource, Docker, Socket.IO, Observable, Redis, NGINX, GIT, Ubuntu, NPM, Verdaccio, Electron',
                        'country' => 'hu',
                        'image' => [
                            'files/projects/era-2020/ngivr/1.jpg',
                            'files/projects/era-2020/ngivr/2.jpg',
                            'files/projects/era-2020/ngivr/3.jpg',
                            'files/projects/era-2020/ngivr/4.jpg',
                            'files/projects/era-2020/ngivr/5.jpg',
                        ],
                        //   'full' => isset($_REQUEST['full']) || isset($_REQUEST['sygnus']),
                    ],
                ]
            ],
            'era-2015' => [
                'items' => [
                    [
                        'index' => 1,
                        'project' => 'Nuaxia & elementary-ai',
                        'company' => 'Corifeus',
                        'date-start' => new DateTime('2019-01-19'),
                        'date-end' => new DateTime('2020-07-24'),
                        'country' => 'gb',
                        'technology' => 'Angular, Angular Material, Highcharts, Web worker, Deferred rendering, Vertical scaling',
                     //   'full' => isset($_REQUEST['full']) || isset($_REQUEST['nuaxia']),
                    ],
                    [
                        'index' => 6,
                        'project' => 'Afraid FreeDNS',
                        'date-start' => new DateTime('2017-05-01'),
                        'date-end' => new DateTime('2017-08-01'),
                        'company' => 'Corifeus',
                        'country' => 'us',
                        'url' => [
                            'Afraid P3X' => 'https://afraid.patrikx3.com/',
                            //    'Live' => 'https://freedns.afraid.org/',
                        ],
                    ],
                    [
                        'index' => 7,
                        'project' => 'FruitMarketing',
                        'company' => 'Corifeus',
                        'date-start' => new DateTime('2015-08-01'),
                        'date-end' => new DateTime('2016-10-19'),
                        'technology' => 'PHP, MySQL, Joomla',
                        'country' => 'hu',
                        'url' => [
                            'http://ezerkert.hu/',
                            'http://fruitinfo.hu/',
                            'http://fruitmarketing.hu/'
                        ],
                        'image' => [
                            'files/projects/era-2015/fruitmarketing/1.jpg',
                            'files/projects/era-2015/fruitmarketing/2.jpg',
                        ]
                    ],
                    [
                        'index' => 8,
                        'project' => 'GoSignMeUp',
                        'company' => 'Corifeus',
                        'date-start' => new DateTime('2015-08-01'),
                        'date-end' => new DateTime('2016-10-19'),
                        'technology' => 'JAVA, .NET, Blackboard',
                        'country' => 'us',
                        'image' => [
                            'files/projects/era-2015/gosignmeup/1.jpg',
                            'files/projects/era-2015/gosignmeup/2.jpg',
                        ]
                    ],
                    [
                        'index' => 9,
                        'project' => 'Bank360',
                        'company' => 'ClickAndLike',
                        'date-start' => new DateTime('2016-07-29'),
                        'date-end' => new DateTime('2016-10-19'),
                        'technology' => 'PHP, Drupal, MySQL, JavaScript',
                        'country' => 'hu',
                        'image' => [
                            'files/projects/era-2015/bank360/1.jpg',
                            'files/projects/era-2015/bank360/2.jpg',
                            'files/projects/era-2015/bank360/3.jpg',
                            'files/projects/era-2015/bank360/4.jpg',
                            'files/projects/era-2015/bank360/5.jpg',
                        ],
                    ],
                    [
                        'index' => 10,
                        'project' => 'Valdemor Alfresco CMS',
                        'company' => 'ClickAndLike',
                        'date-start' => new DateTime('2016-06-01'),
                        'date-end' => new DateTime('2016-10-19'),
                        'technology' => 'J2EE, Java, PostgreSQL, EJabbered, Alfresco Community, ConverseJs',
                        'image' => [
                            'files/projects/era-2015/alfresco/1.png',
                            'files/projects/era-2015/alfresco/2.png',
                            'files/projects/era-2015/alfresco/3.png',
                            'files/projects/era-2015/alfresco/4.png',
                            'files/projects/era-2015/alfresco/5.png'
                        ],
                        'country' => 'hu',
                    ],
                    [
                        'index' => 11,
                        'url' => [
                            'Radio1 Google' => 'https://play.google.com/store/apps/details?id=radio1.radio1streamapplication'
                        ],
                        'project' => 'Radio 1 Android Stream',
                        'company' => 'ClickAndLike',
                        'date-start' => new DateTime('2016-05-01'),
                        'date-end' => new DateTime('2016-09-18'),
                        'technology' => 'Android',
                        'image' => [
                            'files/projects/era-2015/radio1android/1.png',
                            'files/projects/era-2015/radio1android/2.png',
                            'files/projects/era-2015/radio1android/3.png',
                            'files/projects/era-2015/radio1android/4.png',
                        ],
                        'country' => 'hu',
                    ],
                    [
                        'index' => 12,
                        'project' => 'RHExpat',
                        'company' => 'ClickAndLike',
                        'date-start' => new DateTime('2016-03-01'),
                        'date-end' => new DateTime('2016-06-21'),
                        'technology' => 'PHP, CodeIgniter, MySQL, jQuery, Bootstrap',
                        'country' => 'fr',
                    ],
                    [
                        'index' => 13,
                        'project' => 'Bikemaraton Bicycle',
                        'company' => 'ClickAndLike',
                        'date-start' => new DateTime('2016-04-01'),
                        'date-end' => new DateTime('2016-06-09'),
                        'technology' => 'PHP, Yii2, MySQL, jQuery, Bootstrap, Android',
                        'country' => 'hu',
                    ],
                    [
                        'index' => 14,
                        'project' => 'Treeday.NET',
                        'company' => 'ClickAndLike',
                        'date-start' => new DateTime('2016-04-01'),
                        'date-end' => new DateTime('2016-05-01'),
                        'technology' => 'NodeJs, AngularJs, PostgreSQL',
                        'country' => 'at',
                    ]
                ]
            ],
            'era-2010' => [
                'items' => [
                    [
                        'project' => 'GoSignMeUp',
                        'date-start' => new DateTime('2011-08-01'),
                        'date-end' => new DateTime('2015-02-01'),
                        'technology' => 'Ext/Sencha, ASP, VBScript, SOA, JSON, JavaScript, AJAX, .NET, C#, SQL Server, JAVA',
                        'image' => [
                            'files/projects/era-2010/gosignmeup/1.png',
                            'files/projects/era-2010/gosignmeup/2.png',
                            'files/projects/era-2010/gosignmeup/3.png',
                            'files/projects/era-2010/gosignmeup/4.png',
                            'files/projects/era-2010/gosignmeup/5.png',
                        ],
                        'country' => 'us',
                        'youtube' => 'https://www.youtube.com/watch?v=PHZpXK3er48',
                    ],
                    [
                        'project' => 'Dotbox',
                        'date-start' => new DateTime('2011-02-01'),
                        'date-end' => new DateTime('2012-07-01'),
                        'technology' => 'C#, SQL, .NET, MVC 4, Azure, Lucene.NET',
                        'country' => 'us',
                        'youtube' => 'https://www.youtube.com/watch?v=zEkOa67OWpQ',
                    ],
                    [
                        'project' => 'MadTatu',
                        'company' => 'Corifeus',
                        'location' => 'Hungary, Dunaújváros',
                        'date-start' => new DateTime('2009-08-01'),
                        'date-end' => new DateTime('2010-10-01'),
                        'technology' => 'Javascript, jQuery, PostgreSQL, MySQL, CodeIgniter',
                        'country' => 'hu',
                    ]
                ]
            ],
            'era-2005' => [
                'items' => [
                    [
                        'project' => 'Saw4U',
                        'company' => 'Corifeus',
                        'date-start' => new DateTime('2009-09-01'),
                        'date-end' => new DateTime('2009-10-01'),
                        'technology' => 'Javascript, jQuery, PHP, MySQL',
                        'youtube' => 'https://www.youtube.com/watch?v=kIARa4hG6yQ',
                        'country' => 'fr',
                    ],
                    [
                        'project' => 'Webdialogue.eu',
                        'company' => 'Corifeus',
                        'location' => 'Hungary, Dunaújváros',
                        'date-start' => new DateTime('2009-08-01'),
                        'date-end' => new DateTime('2010-03-01'),
                        'technology' => 'Javascript, jQuery, PHP, Joomla, MySQL',
                        'url' => [
                            'http://www.community-intelligence.com',
                            'http://www.euro-intelligence.eu'
                        ],
                        'youtube' => 'http://www.youtube.com/watch?v=1hFc0_9mB1c',
                        'country' => 'be',
                    ],
                    [
                        'project' => 'International Regency',
                        'company' => 'Grosvenor Enterprises',
                        'date-start' => new DateTime('2008-11-01'),
                        'date-end' => new DateTime('2009-05-01'),
                        'technology' => 'Javascript, jQuery, VBScript, SOA, JSON',
                        'youtube' => 'http://www.youtube.com/watch?v=3o-vLvw4tSA',
                        'country' => 'us',
                    ],
                    [
                        'project' => 'Grosvenor Enterprises',
                        'date-start' => new DateTime('2001-06-01'),
                        'date-end' => new DateTime('2010-06-01'),
                        'technology' => 'C/C++, ASP, VBScript, Visual Basic,.Net, Java, C#, IIS, JavaScript, HTML, CSS, COM, AJAX, SOA, Web 2.0',
                        'country' => 'us',
                    ],
                    [
                        'project' => 'Natific',
                        'company' => 'Infomatix',
                        'date-start' => new DateTime('2008-10-01'),
                        'date-end' => new DateTime('2008-10-04'),
                        'country' => 'ch',
                    ],
                    [
                        'project' => 'Procter & Gamble',
                        'company' => 'Infomatix',
                        'date-start' => new DateTime('2008-08-01'),
                        'date-end' => new DateTime('2008-10-01'),
                        'technology' => 'SQL Analysis Server 2000, MDX, .NET 2.0, Visual Studio Tools for Office',
                        'country' => 'hu',
                    ],
                    [
                        'project' => 'Global Aerospace Canada',
                        'company' => 'EPAM',
                        'date-start' => new DateTime('2007-07-01'),
                        'date-end' => new DateTime('2008-03-01'),
                        'technology' => '.NET, nHibernate, SQL Server, SVN, AJAX',
                        'country' => 'ca',
                    ],
                    [
                        'project' => 'Microsoft Visual Studio Orcas Welcome Center',
                        'company' => 'EPAM',
                        'date-start' => new DateTime('2007-04-01'),
                        'date-end' => new DateTime('2007-07-01'),
                        'technology' => 'Visual C++ Orcas',
                        'country' => 'us',
                    ],
                    [
                        'project' => 'Microsoft Dynamics Controls',
                        'company' => 'EPAM',
                        'date-start' => new DateTime('2005-11-01'),
                        'date-end' => new DateTime('2006-04-01'),
                        'technology' => '.Net 2.0, Microsoft Business Framework, Visual Studio 2005, Microsoft SQL Server 2005, SNAP, SCRUM',
                        'country' => 'dk',
                    ],
                    [
                        'project' => 'Wild.NET Insurance Platform Global Aerospace',
                        'company' => 'EPAM',
                        'date-start' => new DateTime('2005-06-01'),
                        'date-end' => new DateTime('2007-06-01'),
                        'technology' => 'J2EE, Tamino XML Db, XML, XSL, Visual Basic, Windows Server Technologies, JRun, Eclipse, AJAX',
                        'country' => 'us',
                    ],
                    [
                        'project' => 'Rakit Inc. Casino Game',
                        'company' => 'Corifeus',
                        'date-start' => new DateTime('2005-08-01'),
                        'date-end' => new DateTime('2005-10-01'),
                        'technology' => 'J2ME framework, Nokia, Ericsson, Motorola',
                        'country' => 'hu',
                    ]
                ]
            ],
            'era-1998' => [
                'items' => [
                    [
                        'project' => 'One Source Industries',
                        'company' => 'Corifeus',
                        'date-start' => new DateTime('2004-01-01'),
                        'date-end' => new DateTime('2004-08-01'),
                        'technology' => 'Microsoft IIS, Microsoft SQL Server, Windows 2003 Server, ASP/VBScript, ADO, JavaScript, HTML, CSS',
                        'country' => 'us',
                    ],
                    [
                        'project' => 'Bizware Online Applications',
                        'company' => 'Corifeus',
                        'date-start' => new DateTime('2003-01-01'),
                        'date-end' => new DateTime('2003-03-01'),
                        'technology' => 'Microsoft .Net',
                        'country' => 'us',
                    ],
                    [
                        'project' => 'Aqua Software',
                        'company' => 'Corifeus',
                        'date-start' => new DateTime('2002-07-01'),
                        'date-end' => new DateTime('2002-09-01'),
                        'technology' => 'Flash, Director',
                        'country' => 'us',
                    ],
                    [
                        'project' => 'EMS Consulting',
                        'company' => 'Corifeus',
                        'date-start' => new DateTime('2002-07-01'),
                        'date-end' => new DateTime('2002-08-01'),
                        'technology' => 'Java, SWING',
                        'image' => [
                            'files/projects/era-1998/ems-consulting/1.png',
                        ],
                        'country' => 'us',
                    ],
                    [
                        'project' => 'Hobson Seats',
                        'company' => 'Corifeus',
                        'date-start' => new DateTime('2002-06-01'),
                        'date-end' => new DateTime('2002-08-01'),
                        'technology' => 'ASP, VBScript, Access, JavaScript, HTML, CSS',
                        'country' => 'us',
                        'flash' => [
                            [
                                'files/projects/era-1998/hobson/hobson-banner.swf',
                                468,
                                60
                            ]
                        ]
                    ],
                    [
                        'project' => 'Quality Service Certification Inc. V2',
                        'company' => 'Corifeus',
                        'date-start' => new DateTime('2002-01-01'),
                        'date-end' => new DateTime('2002-12-01'),
                        'technology' => 'Windows 2000 Server, Microsoft SQL Server, Access, Excel, IIS, C#, .Net, N-tier, JavaScript, HTML, CSS',
                        'country' => 'us',
                    ],
                    [
                        'project' => 'Infiniti of Montclair',
                        'company' => 'Corifeus',
                        'date-start' => new DateTime('2001-09-01'),
                        'date-end' => new DateTime('2001-10-01'),
                        'technology' => 'Flash, J2EE, Windows 2000 Server, Resin Server, JavaScript, HTML, CSS',
                        'image' => [
                            'files/projects/era-1998/infiniti-of-montclair/1.png',
                        ],
                        'country' => 'us',
                    ],
                    [
                        'project' => 'Quality Service Certification Inc.',
                        'company' => 'Corifeus',
                        'date-start' => new DateTime('2001-06-01'),
                        'date-end' => new DateTime('2002-02-01'),
                        'technology' => 'ASP, VBScript, Access, JavaScript, HTML, CSS',
                        'image' => [
                            'files/projects/era-1998/qsc/1.jpg',
                        ],
                        'country' => 'us',
                    ],
                    [
                        'project' => 'EmployCo Inc.',
                        'company' => 'Corifeus',
                        'date-start' => new DateTime('2001-01-01'),
                        'date-end' => new DateTime('2001-03-01'),
                        'technology' => 'Flash, Director, HTML, JavaScript',
                        'country' => 'us',
                    ],
                    [
                        'project' => 'Vista View Imagery',
                        'company' => 'Corifeus',
                        'date-start' => new DateTime('2000-10-01'),
                        'date-end' => new DateTime('2002-10-01'),
                        'technology' => 'PHP, Perl, C/C++, MySQL, FreeBSD, Linux, Windows, PostgreSQL, Java, JavaScript, HTML, CSS, UML',
                        'country' => 'us',
                    ],
                    [
                        'project' => 'IT Manager',
                        'company' => 'Stamp',
                        'date-start' => new DateTime('1999-08-01'),
                        'date-end' => new DateTime('2000-08-01'),
                        'technology' => 'Windows, AIMS, QuickBooks, PHP, MySQL',
                        'image' => [
                            'files/projects/era-1998/stamp/1.jpg',
                            'files/projects/era-1998/stamp/2.jpg',
                            'files/projects/era-1998/stamp/3.jpg',
                        ],
                        'country' => 'us',
                    ],
                    [
                        'project' => 'Y2K KJS',
                        'company' => 'Kraft Jacobs Suchard',
                        'date-start' => new DateTime('1998-10-01'),
                        'date-end' => new DateTime('1999-02-01'),
                        'technology' => 'HP-Ux, Novell NetWare, Windows family, DOS',
                        'country' => 'hu',
                    ],
                    [
                        'project' => 'Y2K',
                        'company' => 'Trilobita Software',
                        'date-start' => new DateTime('1998-06-01'),
                        'date-end' => new DateTime('1998-10-01'),
                        'technology' => 'Dec Unix, HP-Ux, AIX, Sco UNIX, Novell NetWare, Mac OS, Linux, Sun Solaris, Windows family, DOS',
                        'country' => 'hu',
                    ]
                ]
            ]
        ];
        return $projects;
    }
}
