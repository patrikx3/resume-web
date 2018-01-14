<?php
use P3x\Language;

$l = array();
$l['welcome-1'] = 'Tonnányi';
$l['welcome-2'] = 'ÜDVÖZLET!';
$l['welcome-3'] = 'Örülök a találkozásnak ...';

$l['slogan-1-1'] = 'befogadás';
$l['slogan-1-2'] = 'fejlesztés';
$l['slogan-1-3'] = 'haladás';
$l['slogan-1-mix'] = ' - ';

$l['slogan-2-1'] = 'működés';
$l['slogan-2-2'] = 'művészet';
$l['slogan-2-mix'] = '&';
$age = date('Y') - 1978;
$language = Language::$Language;
$pascal = "https://hu.wikipedia.org/wiki/Pascal_(programoz%C3%A1si_nyelv)";
$java = "https://hu.wikipedia.org/wiki/Java_(programoz%C3%A1si_nyelv)";
$android
    = "https://hu.wikipedia.org/wiki/Android_(oper%C3%A1ci%C3%B3s_rendszer)";
$dotnet = 'https://hu.wikipedia.org/wiki/.NET_keretrendszer';
$doom = 'https://hu.wikipedia.org/wiki/Doom';
$assembly = 'https://hu.wikipedia.org/wiki/Assembly';
$profile_class = 'label label-default';
$content_label = 'label label-default';

$l['content-title'] = 'Rólam';

$l['content']
    = <<<EOT
    <ul class="list-group profile-list">
        <li class="list-group-item">
            Szóval most már tudja a nevem ... <span class="{$content_label}">László Patrik</span> ...
        </li>
        <li class="list-group-item">
            <span class="{$profile_class}">{$age}</span> éves vagyok.
        </li>
        <li class="list-group-item">
                <span class="{$profile_class}">2016</span> - Egy veterán programozó vagyok. Jelenleg, tapasztalt szoftver rendszer műszaki építész, fejlesztési műveletek mérnök (DevOps) és hacker vagyok a Sygnusnál.
        </li>
        <li class="list-group-item">
            <span class="{$profile_class}">2010</span> - <span class="{$profile_class}">2015</span>-ig egy nagyobb munkám volt a <a target="_blank" href="http://www.gosignmeup.com/">GoSignMeUp</a> cégnél.
        </li>            
        <li class="list-group-item">
            <span class="{$profile_class}">2005</span> - <span class="{$profile_class}">2010</span> Hazajöttem Magyarországra Los Angeles-ből, majd dolgoztam az <a target="_blank" href="https://www.epam.com/">Epam</a>-nak és a <a target="_blank" href="https://www.microsoft.com/{$language}-us/dynamics/">Microsoft</a>-nak, közben vállalkoztam.
        </li>
        <li class="list-group-item">
            <span class="{$profile_class}">1999</span> - <span class="{$profile_class}">2005</span> Los Angeles-ben dolgoztam web és asztali projecteket csináltam vállalkozónként. Leggyakrabban <a target="_blank" href="https://{$language}.wikipedia.org/wiki/PHP">PHP</a> / <a target="_blank" href="{$java}">Java</a> / <a target="_blank" href="{$dotnet}">.NET</a> használtam.
        </li>
        <li class="list-group-item">
            <span class="{$profile_class}">1998</span>-ban az egyetemen elkezdtem <a target="_blank" href="https://{$language}.wikipedia.org/wiki/HTML">HTML</a>-t web oldalakat csinálni.
        </li>
        <li class="list-group-item">
            <span class="{$profile_class}">1996</span>-ban megjött az <a target="_blank" href="https://{$language}.wikipedia.org/wiki/Internet">internet</a>.
        </li>                 
        <li class="list-group-item">
            <span class="{$profile_class}">1992</span>-ban már elkeztem a PC-vel programozni, kb. ekkor jött ki a <a target="_blank" href="{$doom}">Doom</a> játék, ami nagyon tetszett. Először Amőbát, majd <a target="_blank" href="https://{$language}.wikipedia.org/wiki/Reversi">Otelló</a>-t írtam <a target="_blank" href="{$pascal}">Pascal</a>-ban, melyek lényege az volt, hogy a gép játszott velem.
            A legnagyobb sikerem volt, hogy csináltam egy 3D modell szerkesztőt. 
        </li>
        <li class="list-group-item">
            <span class="{$profile_class}">1988</span>-ban apukámtól kaptam egy <a target="_blank" href="https://{$language}.wikipedia.org/wiki/Amiga">Amiga 500</a>-at. 11 éves voltam, már használtam a BASIC-et és elkezdtem megtanulni az Assembly-t egy <a target="_blank" href="https://{$language}.wikipedia.org/wiki/Motorola_68000">Motorola 68000</a>-al. Nagyon sok grafikai alkalmazást használtam és már kódoltam egyszerű <a target="_blank" href="https://{$language}.wikipedia.org/wiki/Demoscene">demo</a> programokat.
        </li>
        <li class="list-group-item">
            <span class="{$profile_class}">1986</span>-ban kaptam anyukámtól egy <a target="_blank" href="https://{$language}.wikipedia.org/wiki/Commodore_Plus/4">Commodore Plus/4</a>-et, de még csak hackeltem az <a target="_blank" href="{$assembly}">Assembly</a>-t, nem igazán tudtam mit csináltam benne. Sok BASIC könyvet olvastam és használtam. 
        </li>
        <li class="list-group-item">
            <span class="{$profile_class}">1984</span>-ban egy jó barátommal kezdtünk el játékból programozni egy <a target="_blank" href="https://{$language}.wikipedia.org/wiki/ZX81">Sinclair ZX81</a>-el <a target="_blank" href="https://{$language}.wikipedia.org/wiki/BASIC">BASIC</a>-ben.
        </li>                         
        <li class="list-group-item">
            <span class="{$profile_class}">1978</span>. December 8-án születtem, <a target="_blank" href="https://{$language}.wikipedia.org/wiki/Balassagyarmat">Balassagyarmat</a>-on.
        </li> 
    </ul>

EOT;

