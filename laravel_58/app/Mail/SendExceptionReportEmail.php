<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendExceptionReportEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * SendExceptionReportEmail constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $timestamp = date('Y-m-d h:i:s');
        return $this->from(env('MAIL_USERNAME'), env('MAIL_USERNAME'))
            ->subject('ERROR: ' . $timestamp)
            ->view('mails.errors.report', [
                'timestamp' => $timestamp,
                'line' => $this->data['line'],
                'file' => $this->data['file'],
                'error' => $this->data['error'],
                'traceAsString' => $this->data['traceAsString'],
            ]);
    }
}
