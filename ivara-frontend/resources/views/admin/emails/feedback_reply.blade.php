<h3>Hi {{ $feedback->name ?? $feedback->user_type }},</h3>
<p>Your feedback:</p>
<blockquote>{{ $feedback->message }}</blockquote>
<p>Has received a reply:</p>
<blockquote>{{ $reply }}</blockquote>
<p>Thank you for using our platform!</p>
