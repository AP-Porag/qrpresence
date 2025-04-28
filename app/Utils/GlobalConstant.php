<?php

namespace App\Utils;

class GlobalConstant
{
    // Status
    public const STATUS_ACTIVE    = 'active';
    public const STATUS_INACTIVE  = 'inactive';
    public const STATUS_PENDING   = 'pending';
    public const STATUS_DRAFT     = 'draft';
    public const STATUS_PUBLISHED = 'published';
    public const STATUS_CANCELED  = 'canceled';
    public const STATUS_PAID      = 'paid';
    public const STATUS_UNPAID    = 'unpaid';
    public const STATUS_REJECTED  = 'rejected';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_ACCEPTED  = 'accepted';
    public const STATUS_ENROLLED  = 'enrolled';

    // Default
    public const DEFAULT_PER_PAGE     = 12;
    public const DEFAULT_RECENT_LIMIT = 5;
    public const DEFAULT_THUMB_WIDTH  = 300;
    public const DEFAULT_THUMB_HEIGHT = 170;
    public const DEFAULT_QR_CODE_SIZE = 300;

    // Student
    public const CG_STU_PER_PAGE = 12;

    // Event
    public const EVENT_STU_PER_PAGE  = 12;
    public const EVENT_PLACE_ONLINE  = 'online';
    public const EVENT_PLACE_OFFLINE = 'offline';
    public const EVENT_FEE_FREE      = 'free';
    public const EVENT_FEE_PAID      = 'paid';

    public const EVENT_TYPE_EVENT             = 'event';
    public const EVENT_TYPE_SEMINAR           = 'seminar';
    public const EVENT_TYPE_WORKSHOP          = 'workshop';
    public const EVENT_TYPE_SESSION           = 'session';
    public const EVENT_APPLY_STATUS_CONFIRMED = 'confirmed';
    public const EVENT_APPLY_STATUS_PENDING   = 'pending';
    public const EVENT_SPONSORED              = true;

    // Session
    public const SESSION_FEE_FREE = 'free';
    public const SESSION_FEE_PAID = 'paid';

    // Session
    public const COURSE_FEE_FREE = 'free';
    public const COURSE_FEE_PAID = 'paid';

    // Session Type
    public const SESSION_TYPE_ONE_TO_ONE  = 'one_to_one';
    public const SESSION_TYPE_ONE_TO_MANY = 'one_to_many';
    public const SESSION_TYPE_MY_SESSION  = 'my_session';

    // Job
    public const JOB_TYPE_INTERNSHIP  = 'internship';
    public const JOB_TYPE_CONTRACTUAL = 'contractual';
    public const JOB_TYPE_PERMANENT   = 'permanent';

    // Payment
    public const PAYMENT_METHOD_STRIPE = 'stripe';
    public const PAYMENT_METHOD_PAYPAL = 'paypal';
    public const PAYPAL_MODE_SANDBOX   = 'sandbox';
    public const PAYPAL_MODE_LIVE      = 'live';

    //Site Settings
    public const SITE_COMMISSION = 15;

    //transaction
    public const TRANSACTION_PENDING     = 'pending';
    public const TRANSACTION_PAID        = 'paid';
    public const TRANSACTION_REJECTED    = 'rejected';
    public const TRANSACTION_TYPE_CREDIT = 'credit';
    public const TRANSACTION_TYPE_DEBIT  = 'debit';

    // One to one session
    public const SESSION_ALL_ONE_TO_ONE      = 'all_one_to_one';
    public const SESSION_ACCEPTED_ONE_TO_ONE = 'accepted_one_to_one';
    public const SESSION_REJECTED_ONE_TO_ONE = 'rejected_one_to_one';
}

