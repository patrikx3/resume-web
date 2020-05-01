<?php

use Config\Route;

list($folder_source, $folder_source_scripts, $folder_source_css, $folder_production, $folder_production_css, $folder_production_script) = Route::Folders();
?>
<script>
    p3x = {
        Gui: {
            Bootstrap: {}
        }
    };
</script>
<?php if (DEBUG) : ?>
    <!-- bower:css -->
    <link rel="stylesheet" href="bower_components/jGrowl/jquery.jgrowl.css" />
    <link rel="stylesheet" href="bower_components/components-font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="bower_components/lity/dist/lity.min.css" />
    <link rel="stylesheet" href="bower_components/p3x-stackicons/css/stackicons-social.css" />
    <!-- endbower -->

    <!-- bower:js -->
    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/jGrowl/jquery.jgrowl.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
    <script src="bower_components/lity/dist/lity.min.js"></script>
    <script src="bower_components/swfobject/swfobject/swfobject.js"></script>
    <script src="bower_components/js-cookie/src/js.cookie.js"></script>
    <script src="bower_components/handlebars/handlebars.js"></script>
    <script src="bower_components/date-format/dist/date-format.js"></script>
    <script src="bower_components/sprintf/dist/sprintf.min.js"></script>
    <script src="bower_components/latinize/latinize.js"></script>
    <!-- endbower -->



    <!-- injector:P3x:source:js -->
    <script src="js-components/resume-js-common/src/Ajax.js"></script>
    <script src="js-components/resume-js-common/src/AjaxHrefInterface.js"></script>
    <script src="js-components/resume-js-common/src/Analytics.js"></script>
    <script src="js-components/resume-js-common/src/Boot.js"></script>
    <script src="js-components/resume-js-common/src/Config.js"></script>
    <script src="js-components/resume-js-common/src/DataCache.js"></script>
    <script src="js-components/resume-js-common/src/Debug.js"></script>
    <script src="js-components/resume-js-common/src/Event.js"></script>
    <script src="js-components/resume-js-common/src/Growl.js"></script>
    <script src="js-components/resume-js-common/src/Icon.js"></script>
    <script src="js-components/resume-js-common/src/Id.js"></script>
    <script src="js-components/resume-js-common/src/jQuery.js"></script>
    <script src="js-components/resume-js-common/src/Language.js"></script>
    <script src="js-components/resume-js-common/src/Layout.js"></script>
    <script src="js-components/resume-js-common/src/Mobile.js"></script>
    <script src="js-components/resume-js-common/src/Object.js"></script>
    <script src="js-components/resume-js-common/src/Overlay.js"></script>
    <script src="js-components/resume-js-common/src/Periodical.js"></script>
    <script src="js-components/resume-js-common/src/ProtocolValid.js"></script>
    <script src="js-components/resume-js-common/src/Router.js"></script>
    <script src="js-components/resume-js-common/src/String.js"></script>
    <script src="js-components/resume-js-common/src/Template.js"></script>
    <script src="js-components/resume-js-common/src/Uri.js"></script>
    <script src="js-components/resume-js-bootstrap/src/Accordion.js"></script>
    <script src="js-components/resume-js-bootstrap/src/Config.js"></script>
    <script src="js-components/resume-js-bootstrap/src/Tab.js"></script>
    <!-- endinjector -->

    <!-- injector:P3x:source:css -->
    <!-- endinjector -->


<?php else : ?>
    <link rel="stylesheet" href="<?= $folder_production_css ?>production.bower.css">
<?php endif; ?>
