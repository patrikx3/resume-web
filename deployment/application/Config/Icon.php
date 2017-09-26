<?php
namespace Config;


/**
 * Class Icon
 * @package Config
 */
class Icon
{
    /**
     *
     */
    const ICON_INFO = 'fa fa-info-circle';
    const ICON_INFO_RAW = 'f05a';

    /**
     *
     */
    const ICON_LOGO = 'fa fa-bolt';
    /**
     *
     */
    const ICON_IMAGE = 'fa fa-picture-o';
    /**
     *
     */
    const ICON_IMAGE_RAW = 'f03e';

    /**
     *
     */
    const ICON_YOUTUBE_PLAY = 'fa fa-youtube-play';
    /**
     *
     */
    const ICON_YOUTUBE_PLAY_RAW = 'f16a';

    /**
     *
     */
    const ICON_LINK = 'fa fa-external-link';
    /**
     *
     */
    const ICON_LINK_RAW = 'f08e';

    /**
     *
     */
    const ICON_FLASH = 'fa fa-camera';
    /**
     *
     */
    const ICON_FLASH_RAW = 'f030';

    /**
     *
     */
    const ICON_PROGRESS = 'fa fa-refresh fa-spin';
    /**
     *
     */
    const ICON_PROGRESS_RAW = 'f021';

    /**
     *
     */
    const ICON_CALENDAR = 'fa fa-calendar';

    /**
     *
     */
    const ICON_HOME = 'fa fa-at';
    /**
     *
     */
    const ICON_ABOUT_ME = 'fa fa-angle-double-down';

    /**
     *
     */
    const ICON_RESUME = 'fa fa-rocket';
    /**
     *
     */
    const ICON_RESUME_RAW = 'f135';

    /**
     *
     */
    const ICON_RESUME_COVER = 'fa fa-cube';
    /**
     *
     */
    const ICON_RESUME_COVER_RAW = 'f1b2';

    /**
     *
     */
    const ICON_RESUME_PERSONAL = 'fa fa-bookmark';
    /**
     *
     */
    const ICON_RESUME_PERSONAL_RAW = 'f02e';

    /**
     *
     */
    const ICON_RESUME_SKILLS = 'fa fa-cog';
    /**
     *
     */
    const ICON_RESUME_SKILLS_RAW = 'f013';

    /**
     *
     */
    const ICON_RESUME_EDUCATION = 'fa fa-briefcase';
    /**
     *
     */
    const ICON_RESUME_EDUCATION_RAW = 'f0b1';
    /**
     *
     */
    const ICON_RESUME_EDUCATION_NOTE = 'fa fa-history';
    /**
     *
     */
    const ICON_RESUME_EDUCATION_NOTE_RAW = 'f1da';

    /**
     *
     */
    const ICON_RESUME_EMPLOYMENT = 'fa fa-industry';
    /**
     *
     */
    const ICON_RESUME_EMPLOYMENT_RAW = 'f275';

    /**
     *
     */
    const ICON_RESUME_EMPLOYMENT_CHECKED = 'fa-circle-o';
    /**
     *
     */
    const ICON_RESUME_EMPLOYMENT_UNCHECKED = 'fa-dot-circle-o';

    /**
     *
     */
    const ICON_PROJECTS = 'fa fa-envira';
    /**
     *
     */
    const ICON_PROJECTS_RAW = 'f299';

    /**
     *
     */
    const ICON_PROJECTS_ERA = 'fa fa-clock-o';

    /**
     *
     */
    const ICON_PLAYGROUND = 'fa fa-gamepad';
    /**
     *
     */
    const ICON_CONTACT = 'fa fa-envelope';
    /**
     *
     */
    const ICON_CONTACT_TITLE = 'fa fa-train';
    /**
     *
     */
    const ICON_CONTACT_SUBMIT = 'fa fa-truck';
    /**
     *
     */
    const ICON_CONTACT_SENT = 'fa fa-globe';

    /**
     *
     */
    const ICON_THEME = 'fa fa-toggle-on';

    /**
     *
     */
    const ICON_PDF = 'fa fa-file-pdf-o';
    /**
     *
     */
    const ICON_PHONE = 'fa fa-phone';
    /**
     *
     */
    const ICON_FACEBOOK = 'fa fa-facebook-square';
    /**
     *
     */
    const ICON_TWITTER = 'fa fa-twitter';
    /**
     *
     */
    const ICON_INSTAGRAM = 'fa fa-instagram';
    /**
     *
     */
    const ICON_YOUTUBE = 'fa fa-youtube-square';
    /**
     *
     */
    const ICON_LINKEDIN = 'fa fa-linkedin-square';
    /**
     *
     */
    const ICON_GITHUB = 'fa fa-github';
    /**
     *
     */
    const ICON_WORDPRESS = 'fa fa-wordpress';
    /**
     *
     */
    const ICON_UNDER_CONSTRUCTION = 'fa fa-cog fa-spin';

    /**
     *
     */
    const ICON_404 = 'fa fa-thumbs-down';
    /**
     *
     */
    const ICON_403 = 'fa fa-user';
    /**
     *
     */
    const ICON_403_4 = 'fa fa-lock';

    /**
     *
     */
    const ICON_ERROR = 'fa fa-exclamation-triangle';

    /**
     *
     */
    const ICON_COPYRIGHT = 'fa fa-copyright';

    /**
     * @return array
     */
    public static function GetConstants()
    {
        $reflection = new \ReflectionClass(__CLASS__);
        return $reflection->getConstants();
    }
}