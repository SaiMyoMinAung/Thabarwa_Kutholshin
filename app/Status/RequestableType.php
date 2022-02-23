<?php

namespace App\Status;

use MyCLabs\Enum\Enum;

/**
 * RequestableType enum
 * @method static RequestableType USER()
 * @method static RequestableType TEAM()
 * @method static RequestableType YOGI()
 * @method static RequestableType UNEXPECTED_PERSON()
 * * @method static RequestableType OTHERCENTER()
 */
class RequestableType extends Enum
{
    // Requestable Type
    // private const USER = 'App\User';
    private const TEAM = 'App\Team';
    private const YOGI = 'App\Yogi';
    private const UNEXPECTEDPERSON = 'App\UnexpectedPerson';
    private const CONTRIBUTION = 'App\Contribution';
}
