<?php

namespace App\Constants;

class PermissionConstant
{
    // forInternalDonatedItemRecordAdminType
    const forIDIRAT = [
        // for internal donated item (အဝေ စာရင်း)
        'create-internal-donated-items',
        'create-and-confirm-internal-donated-items',
        'read-internal-donated-items',
        'edit-internal-donated-items',
        'update-internal-donated-items',
        'delete-internal-donated-items',

        // alms round (ပစ္စည်းဝင်သည့်နေရာ)
        'create-alms-round',

        // item sub type (ပစ္စည်း အမျိုးအစား)
        'create-item-sub-type',

        // item type
        'create-item-type',

        // share internal donated item (အဝေ စာရင်း)
        'create-share-internal-donated-item',
        'read-share-internal-donated-item',
        'update-share-internal-donated-item',
        'delete-share-internal-donated-item',

        // team
        'create-team',

        // center
        'create-center',

        // yogi
        'create-yogi',

        // ward
        'create-ward',

        // volunteer
        'create-volunteer',
    ];
}
