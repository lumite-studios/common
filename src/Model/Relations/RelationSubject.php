<?php

namespace LumiteStudios\Common\Model\Relations;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

/**
 ***** Relationships
 * @property object|null $subject
 ***** Scopes
 * @method static void forSubject(object $subject)
 */
trait RelationSubject
{
    public function subject()
    {
        return $this->morphTo()->withTrashed();
    }

    public function setSubjectAttribute(?object $subject)
    {
        $this->attributes['subject_id'] = $subject ? $subject->getKey() : null;
        $this->attributes['subject_type'] = $subject ? get_class($subject) : null;
    }

    #[Scope]
    protected function forSubject(Builder $query, object $subject): void
    {
        $query->where('subject_id', $subject->getKey())->where('subject_type', get_class($subject));
    }
}
