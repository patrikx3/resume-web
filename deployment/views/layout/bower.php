<?php
use Config\Route;

list($folder_source, $folder_source_scripts, $folder_source_css, $folder_production, $folder_production_css, $folder_production_script) = Route::Folders();
?>
<?php if (DEBUG) : ?>
    <!-- bower:css -->
    <link rel="stylesheet" href="bower_components/jGrowl/jquery.jgrowl.css" />
    <link rel="stylesheet" href="bower_components/lity/dist/lity.min.css" />
    <link rel="stylesheet" href="bower_components/components-font-awesome/css/font-awesome.css" />
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
    <script src="bower_components/p3x-resume/src/Ajax.js"></script>
    <script src="bower_components/p3x-resume/src/AjaxHrefInterface.js"></script>
    <script src="bower_components/p3x-resume/src/Analytics.js"></script>
    <script src="bower_components/p3x-resume/src/Boot.js"></script>
    <script src="bower_components/p3x-resume/src/Config.js"></script>
    <script src="bower_components/p3x-resume/src/DataCache.js"></script>
    <script src="bower_components/p3x-resume/src/Debug.js"></script>
    <script src="bower_components/p3x-resume/src/Event.js"></script>
    <script src="bower_components/p3x-resume/src/Growl.js"></script>
    <script src="bower_components/p3x-resume/src/Icon.js"></script>
    <script src="bower_components/p3x-resume/src/Id.js"></script>
    <script src="bower_components/p3x-resume/src/jQuery.js"></script>
    <script src="bower_components/p3x-resume/src/Language.js"></script>
    <script src="bower_components/p3x-resume/src/Layout.js"></script>
    <script src="bower_components/p3x-resume/src/Mobile.js"></script>
    <script src="bower_components/p3x-resume/src/Object.js"></script>
    <script src="bower_components/p3x-resume/src/Overlay.js"></script>
    <script src="bower_components/p3x-resume/src/Periodical.js"></script>
    <script src="bower_components/p3x-resume/src/ProtocolValid.js"></script>
    <script src="bower_components/p3x-resume/src/Router.js"></script>
    <script src="bower_components/p3x-resume/src/String.js"></script>
    <script src="bower_components/p3x-resume/src/Template.js"></script>
    <script src="bower_components/p3x-resume/src/Uri.js"></script>
    <script src="bower_components/p3x-resume-bootstrap/src/Accordion.js"></script>
    <script src="bower_components/p3x-resume-bootstrap/src/Config.js"></script>
    <script src="bower_components/p3x-resume-bootstrap/src/Tab.js"></script>
    <!-- endinjector -->

    <!-- injector:P3x:source:css -->
    <link rel="stylesheet" href="bower_components/p3x-resume/src/css/p3x.css">
    <!-- endinjector -->


<?php else : ?>
    <link rel="stylesheet" href="<?= $folder_production_css ?>production.bower.css">
<?php endif; ?>