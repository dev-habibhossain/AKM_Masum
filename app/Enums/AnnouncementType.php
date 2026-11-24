<?php

namespace App\Enums;

enum AnnouncementType: string
{
    case Announcement = 'announcement';
    case ScamAlert = 'scam_alert';
    case SafetyNotice = 'safety_notice';
}
