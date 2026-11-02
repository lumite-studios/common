<?php

namespace LumiteStudios\Common\Extend;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable as BaseMailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

abstract class Mailable extends BaseMailable implements ShouldQueue
{
    use SerializesModels;

    public function __construct()
    {
        $this->queue = app()->environment('production')
            ? 'emails'
            : 'default';
    }

    abstract public function getMailPath(): string;

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->getSubject(),
        );
    }

    public function getSubject(): string
    {
        return $this->title;
    }
}
