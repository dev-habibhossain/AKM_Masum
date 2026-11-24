<?php

namespace App\Enums;

enum ContentStatus: string
{
    case Draft = 'draft';
    case PendingReview = 'pending_review';
    case Published = 'published';
    case Unpublished = 'unpublished';
    case Archived = 'archived';
}
