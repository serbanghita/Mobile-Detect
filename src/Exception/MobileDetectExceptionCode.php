<?php

declare(strict_types=1);

namespace Detection\Exception;

class MobileDetectExceptionCode
{
    public const INVALID_USER_AGENT_ERR = 0x1;
    public const IS_MOBILE_ERR = 0x2;
    public const IS_TABLET_ERR = 0x3;
    public const IS_MAGIC_ERR = 0x4;
}
