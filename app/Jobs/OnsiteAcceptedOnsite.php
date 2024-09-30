namespace App\Jobs;

use App\Mail\OnsiteAcceptedOnsiteMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Log;

class OnsiteAcceptedOnsite implements ShouldQueue
{
use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

private $members;
private $base_url;
private $team;

public function __construct($members, $base_url, $team)
{
$this->members = $members;
$this->base_url = $base_url;
$this->team = $team;
}

/**
* Execute the job.
*/
public function handle(): void
{
foreach ($this->members as $member) {
$relative_path = 'QR/' . $member->uuid . '_' . $member->national . '.png';
$qr_path = public_path($relative_path);

try {
QrCode::format('png')->size(200)->generate($member->uuid, $qr_path);
$qrGeneratedUrl = $this->base_url . '/' . $relative_path;
Mail::to($member->email)->send(new OnsiteAcceptedOnsiteMail($this->team, $member, $qrGeneratedUrl));
} catch (\Exception $e) {
Log::error("Failed to process member: {$member->email}. Error: " . $e->getMessage());
throw $e;
}
}
}

/**
* Handle a job failure.
*/
public function failed(\Exception $exception)
{
// Log failure, notify admin, etc.
Log::error('OnsiteAcceptedOnsite Job failed: ' . $exception->getMessage());
}
}
