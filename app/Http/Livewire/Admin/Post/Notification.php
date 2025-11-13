<?php

namespace App\Http\Livewire\Admin\Post;

use App\Models\Admin\Job\Jobmaster\Notificationlinkjob;
use Livewire\Component;

class Notification extends Component
{

    public $notifcation = [];

    protected $rules = [
        'notifcation.*.notification_name' => 'required|min:3',
        'notifcation.*.notification_source' => 'required|min:3',
        'notifcation.*.notification_link' => 'required|min:3',
    ];

    protected $messages = [
        'notifcation.*.notification_name.required' => 'The Notification Name cannot be empty.',
        'notifcation.*.notification_name.min' => 'The Notification Name Required Min 3 Character.',

        'notifcation.*.notification_source.required' => 'The Notification Source cannot be empty.',
        'notifcation.*.notification_source.min' => 'The Notification Source Required Min 3 Character.',

        'notifcation.*.notification_link.required' => 'The Notification Link cannot be empty.',
        'notifcation.*.notification_link.min' => 'The Notification Link Required Min 3 Character.',
    ];

    public function mount($postjobid)
    {
        $arr = [];
        foreach (Notificationlinkjob::where('postjob_id', $postjobid)->get() as $key => $value) {
            array_push($arr, ['notification_name' => $value->notification_name, 'notification_source' => $value->notification_source, 'notification_link' => $value->notification_link]);
        }
        $this->notifcation = $arr;
    }

    public function addnotification()
    {

        $this->notifcation[] = ['notification_name' => '', 'notification_source' => 'Click Here', 'notification_link' => ''];
        $this->validate();
    }

    public function removenotification($index)
    {
        unset($this->notifcation[$index]);
        $this->notifcation = array_values($this->notifcation);
    }

    public function notificationlivevalidation()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.admin.post.notification');
    }
}
