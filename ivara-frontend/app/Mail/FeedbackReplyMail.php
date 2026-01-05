<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $feedback;
    public $reply;

    public function __construct($feedback, $reply)
    {
        $this->feedback = $feedback;
        $this->reply = $reply;
    }

    public function build()
    {
        return $this->subject('Reply to Your Feedback')
                    ->view('emails.feedback_reply');
    }

    public function reply(Request $request, $id)
{
    $feedback = Feedback::findOrFail($id);

    $feedback->reply = $request->reply;
    $feedback->save();

    // Send email notification
    if ($feedback->email) {
        Mail::to($feedback->email)->send(new FeedbackReplyMail($feedback, $request->reply));
    }

    return back()->with('success', 'Reply sent successfully!');
}

}

