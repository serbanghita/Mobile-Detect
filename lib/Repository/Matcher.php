<?php
namespace MobileDetect\Matcher;

class Matcher
{
    const MATCH_REGEX = 'regex'; //regular expression
    const MATCH_STR = 'strpos'; //simple case-sensitive string within string check
    const MATCH_STRI = 'stripos'; //simple case-insensitive string within string check
    
    /**
     * Given a type of match, this method will check if a valid match is found.
     *
     * @param  string $test The test subject.
     * @param  string $against The pattern (for regex) or substring (for str[i]pos).
     * @param  string $type The type {{@see $this->knownMatchTypes}}.
     * @return bool True if matched successfully.
     */
    public static function match($test, $against, $type = self::MATCH_REGEX)
    {
        if (!in_array($type, [self::MATCH_REGEX, self::MATCH_STR, self::MATCH_STRI])) {
            throw new \InvalidArgumentException(
                sprintf('Unknown match type: %s', $type)
            );
        }

        // Always take a string.
        if (!is_string($against)) {
            throw new \InvalidArgumentException(
                sprintf('Invalid %s pattern of type "%s" passed for "%s"', $type, gettype($against), $test)
            );
        }

        if ($type == self::MATCH_REGEX) {
            if (self::regexMatch(self::prepareRegex($test), $against)) {
                return true;
            }
        } elseif ($type == self::MATCH_STR) {
            if (false !== strpos($against, $test)) {
                return true;
            }
        } elseif ($type == self::MATCH_STRI) {
            if (false !== stripos($against, $test)) {
                return true;
            }
        }

        return false;
    }
    
    /**
     * @param $tests
     * @param $against
     * @return null
     */
    public static function matchModel(array $tests, $against)
    {
        // Model match must be an array.
        if (empty($tests)) {
            return null;
        }

        //$this->setRegexErrorHandler();

        foreach ($tests as $test) {
            $regex = self::prepareRegex($test);

            if (self::regexMatch($regex, $against, $matches)) {
                // If the match contained a model, save it.
                if (isset($matches['model'])) {
                    //$this->restoreRegexErrorHandler();
                    return $matches['model'];
                }
            }
        }

        //$this->restoreRegexErrorHandler();
        return null;
    }

    public static function matchVersion(array $tests, $against)
    {
        // Model match must be an array.
        if (empty($tests)) {
            return null;
        }

        //$this->setRegexErrorHandler();

        foreach ($tests as $test) {
            $regex = self::prepareRegex($test);

            if (self::regexMatch($regex, $against, $matches)) {
                // If the match contained a version, save it.
                if (isset($matches['version'])) {
                    //$this->restoreRegexErrorHandler();
                    return self::prepareVersion($matches['version']);
                }
            }
        }

        //$this->restoreRegexErrorHandler();
        return null;
    }

    /**
     * Attempts to match the model and extracts
     * the version and model if available.
     *
     * @param $tests array Various tests.
     * @param $against string The test.
     *
     * @return array|bool False if no match, hash of match data otherwise.
     */
    public static function matchModelAndVersion(array $tests, $against)
    {
        // Model match must be an array.
        if (!is_array($tests) || !count($tests)) {
            return false;
        }

        //$this->setRegexErrorHandler();

        $matchReturn = array();

        foreach ($tests as $test) {
            $regex = self::prepareRegex($test);

            if (self::regexMatch($regex, $against, $matches)) {
                // If the match contained a version, save it.
                if (isset($matches['version'])) {
                    $matchReturn['version'] = self::prepareVersion($matches['version']);
                }

                // If the match contained a model, save it.
                if (isset($matches['model'])) {
                    $matchReturn['model'] = $matches['model'];
                }

                //$this->restoreRegexErrorHandler();
                return $matchReturn;
            }
        }

        //$this->restoreRegexErrorHandler();
        return false;
    }

    /**
     * Converts the quasi-regex into a full regex, replacing various common placeholders such
     * as [VER] or [MODEL].
     *
     * @param $regex string|array
     *
     * @return string
     */
    private static function prepareRegex($regex)
    {
        // Regex can be an array, because we have some really long
        // expressions (eg. Samsung) and other programming languages
        // cannot cope with the length. See #352
        if (is_array($regex)) {
            $regex = implode('', $regex);
        }

        $regex = sprintf('/%s/i', addcslashes($regex, '/'));
        $regex = str_replace('[VER]', '(?<version>[0-9\._-]+)', $regex);
        $regex = str_replace('[MODEL]', '(?<model>[a-zA-Z0-9]+)', $regex);

        return $regex;
    }

    /**
     * @param $version string The string to convert to a standard version.
     * @param bool $asArray
     * @return array|string A string or an array if $asArray is passed as true.
     */
    protected static function prepareVersion($version, $asArray = false)
    {
        $version = str_replace('_', '.', $version);
        // @todo Need to remove extra characters from resulting
        // versions like '2.1-' or '2.1.'
        if ($asArray) {
            return explode('.', $version);
        } else {
            return $version;
        }
    }

    /**
     * @param $regex
     * @param $against
     * @param null $matches
     * @return int
     */
    private static function regexMatch($regex, $against, &$matches = null)
    {
        return preg_match($regex, $against, $matches);
    }
}