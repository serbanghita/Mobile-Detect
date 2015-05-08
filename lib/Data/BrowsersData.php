<?php
namespace MobileDetect\Data;

class BrowsersData extends AbstractData
{
    /**
     * List of browsers.
     *
     * The order inside a browser family is _important_.
     *
     * Eg. When checking for isChrome() we will first check for 'mobile'
     * and at last the 'desktop' version.
     * This way we don't need to keep accurate two regexes.
     * The last 'desktop' regex is a fallback.
     * At the last step we already know what happened before.
     *
     * @var array
     */
    protected $data = array(
        /**
         * Opera family
         */
        'Opera' => array(
            'Opera Mini' => array(
                'isMobile'     => true,
                'identityMatches'        => 'Opera.*Mini',
                'versionMatches' => array('Opera Mini/[VER]'),
            ),
            'Opera Mobi' => array(
                'isMobile'     => true,
                'identityMatches'        => 'Opera.*Mobi|Android.*Opera|Mobile.*OPR/[0-9.]+',
                'versionMatches' => array('Opera Mobi/[VER]', ' OPR/[VER]', 'Version/[VER]'),
            ),
            'Opera Coast' => array(
                'isMobile'     => true,
                'identityMatches'        => 'Coast/[0-9.]+',
                'versionMatches' => array('Coast/[VER]'),
            ),
            'Opera Desktop' => array(
                'isMobile'     => false,
                'identityMatches'        => '\bOpera\b| OPR/',
                'versionMatches' => array('Opera/[VER]', ' OPR/[VER]', 'Version/[VER]' ),
            ),
        ),
        /**
         * Google Chrome browser family
         *
         * @docs https://developers.google.com/chrome/mobile/docs/user-agent
         */
        'Chrome' => array(
            'Chrome Mobile' => array(
                'isMobile' => true,
                'identityMatches' => '\bCrMo\b|CriOS|Android.*Chrome/[.0-9]* (Mobile)?',
                'versionMatches' => array('Chrome/[VER]', 'CriOS/[VER]', 'CrMo/[VER]'),
            ),
            'Chrome Desktop' => array(
                'isMobile' => false,
                'identityMatches' => '\bChrome\b/[.0-9]*',
                'versionMatches' => array('Chrome/[VER]'),
            ),
        )
    );
}