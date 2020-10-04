<?php

use P3x\Language;

$l = array();
$l['welcome-1'] = 'Tons of';
$l['welcome-2'] = 'WELCOME!';
$l['welcome-3'] = 'Pleasure to meet you ...';

$l['slogan-1-1'] = 'adopt';
$l['slogan-1-2'] = 'd e v e l o p';
$l['slogan-1-3'] = 'advance';
$l['slogan-1-mix'] = '-';

$l['slogan-2-1'] = 'functionality';
$l['slogan-2-2'] = 'a r t';
$l['slogan-2-mix'] = '&';

$age = date('Y') - 1978;
$language = Language::$Language;
$pascal = "https://en.wikipedia.org/wiki/Pascal_(programming_language)";
$java = "https://en.wikipedia.org/wiki/Java_(programming_language)";
$android = "https://en.wikipedia.org/wiki/Android_(operating_system)";
$dotnet = 'https://en.wikipedia.org/wiki/.NET_Framework';
$doom = 'https://en.wikipedia.org/wiki/Doom_(1993_video_game)';
$assembly = 'https://en.wikipedia.org/wiki/Assembly_language';
$profile_class = 'label label-default';
$content_label = 'label label-default';

$l['content-title'] = 'About me';

$l['content']
    = <<<EOT

    <ul class="list-group profile-list">
        <li class="list-group-item">
            So, now, you know my name ...  <span class="{$content_label}">Patrik Laszlo</span> ...
        </li>
        <li class="list-group-item">
            I am <span class="{$profile_class}">{$age}</span> years old.
        </li>
        <li class="list-group-item">
            You could find me on <strong><a target="_blank" href="https://github.com/patrikx3">GitHub</a></strong> and you may check out my micro-services on <strong><a target="_blank" href="https://corifeus.com">Corifeus</a></strong>. Usually, I build enterprise systems using NodeJs/C++ and Angular Material ...
        </li>
        <li class="list-group-item">
            Sometimes, I blog @ <a href="https://blog.patrikx3.com/about/" target="p3x-blog">https://blog.patrikx3.com/about/</a>
        </li>
        <li class="list-group-item">
            <span class="{$profile_class}">2016</span> -  I am a full-stack programmer.
        </li>
        <li class="list-group-item">
            <span class="{$profile_class}">2010</span> - <span class="{$profile_class}">2015</span> I got a bigger client <a target="_blank" href="http://www.gosignmeup.com/">GoSignMeUp</a>. I had no other projects.
        </li>
        <li class="list-group-item">
            <span class="{$profile_class}">2005</span> - <span class="{$profile_class}">2010</span> I worked for <a target="_blank" href="https://www.epam.com/">Epam</a> and <a target="_blank" href="https://www.microsoft.com/{$language}-us/dynamics/">Microsoft</a> in Hungary. I moved back from Los Angeles to Hungary . I was a contractor as well.
        </li>
          <li class="list-group-item">
            <span class="{$profile_class}">1999</span> - <span class="{$profile_class}">2005</span> I lived in Los Angeles and I worked on web and desktop projects as a contractor. I usually used <a target="_blank" href="https://{$language}.wikipedia.org/wiki/PHP">PHP</a> / <a target="_blank" href="{$java}">Java</a> / <a target="_blank" href="{$dotnet}">.NET</a>, but a few others as well.
        </li>
        <li class="list-group-item">
            <span class="{$profile_class}">1998</span> At the university, I started to play with <a target="_blank" href="https://{$language}.wikipedia.org/wiki/HTML">HTML</a> creating web sites.
        </li>
         <li class="list-group-item">
            <span class="{$profile_class}">1996</span> The big time, the <a target="_blank" href="https://{$language}.wikipedia.org/wiki/Internet">internet</a> works in Hungary, Balassagyarmat.
        </li>
        <li class="list-group-item">
            <span class="{$profile_class}">1992</span> I started to program with a PC, about when <a target="_blank" href="{$doom}">Doom</a> came out. I liked it a lot. Firstly, I created an Amoeba game, and later an <a target="_blank" href="https://{$language}.wikipedia.org/wiki/Reversi">Othello</a> in <a target="_blank" href="{$pascal}">Pascal</a>, my games were intelligent and played with me.
            My best fantastic program was a 3D modeller and wrote 3D demo scene code.
        </li>
        <li class="list-group-item">
            <span class="{$profile_class}">1988</span> I got an <a target="_blank" href="https://{$language}.wikipedia.org/wiki/Amiga">Amiga 500</a> from my father. I was 11 years old, I used BASIC and started to learn Assembly with on a <a target="_blank" href="https://{$language}.wikipedia.org/wiki/Motorola_68000">Motorola 68000</a> CPU. I used a quite of many graphical applications and <a target="_blank" href="https://{$language}.wikipedia.org/wiki/Demoscene">demo scene</a> code.
        </li>
         <li class="list-group-item">
            <span class="{$profile_class}">1986</span> I received a <a target="_blank" href="https://{$language}.wikipedia.org/wiki/Commodore_Plus/4">Commodore Plus/4</a> computer from my mother . I started to check out <a target="_blank" href="{$assembly}">Assembly</a>, but I was just hacking and cracking, I did not really know what I was doing. I usually played with BASIC and I read programming books.
        </li>
        <li class="list-group-item">
            <span class="{$profile_class}">1984</span> With a good friend of mine, we started to program together on a <a target="_blank" href="https://{$language}.wikipedia.org/wiki/ZX81">Sinclair ZX81</a> using <a target="_blank" href="https://{$language}.wikipedia.org/wiki/BASIC">BASIC</a>.
        </li>
        <li class="list-group-item">
            <span class="{$profile_class}">1978</span> I was born on the 8th of December in <a target="_blank" href="https://{$language}.wikipedia.org/wiki/Balassagyarmat">Balassagyarmat</a>.
        </li>
    </ul>
EOT;

