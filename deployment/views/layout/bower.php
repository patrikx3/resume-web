<?php

use Config\Route;

list($folder_source, $folder_source_scripts, $folder_source_css, $folder_production, $folder_production_css, $folder_production_script) = Route::Folders();
?>
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

    <script>
        p3x = {
            Gui: {
                Bootstrap: {}
            }
        };
    </script>

    <!-- injector:P3x:source:js -->
    <script src="js-components/resume-js-common/Ajax.js"></script>
    <script src="js-components/resume-js-common/AjaxHrefInterface.js"></script>
    <script src="js-components/resume-js-common/Analytics.js"></script>
    <script src="js-components/resume-js-common/Boot.js"></script>
    <script src="js-components/resume-js-common/Config.js"></script>
    <script src="js-components/resume-js-common/DataCache.js"></script>
    <script src="js-components/resume-js-common/Debug.js"></script>
    <script src="js-components/resume-js-common/Event.js"></script>
    <script src="js-components/resume-js-common/Growl.js"></script>
    <script src="js-components/resume-js-common/Icon.js"></script>
    <script src="js-components/resume-js-common/Id.js"></script>
    <script src="js-components/resume-js-common/jQuery.js"></script>
    <script src="js-components/resume-js-common/Language.js"></script>
    <script src="js-components/resume-js-common/Layout.js"></script>
    <script src="js-components/resume-js-common/Mobile.js"></script>
    <script src="js-components/resume-js-common/Object.js"></script>
    <script src="js-components/resume-js-common/Overlay.js"></script>
    <script src="js-components/resume-js-common/Periodical.js"></script>
    <script src="js-components/resume-js-common/ProtocolValid.js"></script>
    <script src="js-components/resume-js-common/Router.js"></script>
    <script src="js-components/resume-js-common/String.js"></script>
    <script src="js-components/resume-js-common/Template.js"></script>
    <script src="js-components/resume-js-common/Uri.js"></script>
    <script src="js-components/resume-js-bootstrap/Accordion.js"></script>
    <script src="js-components/resume-js-bootstrap/Config.js"></script>
    <script src="js-components/resume-js-bootstrap/Tab.js"></script>
    <!-- endinjector -->

    <!-- injector:P3x:source:css -->
    <!-- endinjector -->


<?php else : ?>
    <link rel="stylesheet" href="<?= $folder_production_css ?>production.bower.css">
<?php endif; ?>
