<?php

namespace Bishopm\Hub\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class HubMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(protected array $data, $tenant)
    {
        $this->data=$data;
        $this->data['tenant'] = $tenant['tenant'];
        if (($tenant['contact_firstname']) or ($tenant['contact_surname'])){
            $this->data['contact'] = $tenant['contact_firstname'] . " " . $tenant['contact_surname'];
        } else {
            $this->data['contact']='';
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->data['subject'],
            from: new Address(setting('email.mail_from_address'),setting('email.mail_from_name'))
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'hub::mail.templates.email',
            with: [
                'tenant' => $this->data['tenant'],
                'contact' => $this->data['contact'],
                'subject' => $this->data['subject'] ?? 'Message from Westville Community Hub',
                'body' => $this->data['body'],
                'sender' => $this->data['sender'] ?? ''
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        if ((array_key_exists('attachment',$this->data)) and ($this->data['attachment']<>'')){
            return [
                Attachment::fromPath(storage_path($this->data['attachment']))
            ]; 
        } elseif ((array_key_exists('attachdata',$this->data)) and ($this->data['attachdata']<>'')){
            return [
                Attachment::fromData(fn () => base64_decode($this->data['attachdata']), $this->data['attachname'])
                ->withMime('application/pdf'),
            ]; 
        } else {
            return [];
        }
    }
}
