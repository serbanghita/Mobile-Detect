<?php

namespace MobileDetect\Exception;

class RegexCompileException extends \RuntimeException implements ExceptionInterface
{
    /**
     * Holds any context vars for this exception.
     *
     * @var array
     */
    protected $context;

    /**
     * File where this happened.
     *
     * @var string
     */
    protected $file;

    /**
     * Line number in the file.
     *
     * @var int
     */
    protected $line;

    public function __construct($msg, $code, $file, $line, array $context, \Exception $previous = null)
    {
        $msg = preg_replace('/^preg_[^(]+\(\)[ :]+/', '', $msg);

        parent::__construct($msg, $code, $previous);
        $this->context = $context;
    }
}
