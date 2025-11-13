<?php

namespace App\Http\Livewire\Website\Footer;

use App\Models\Admin\Website\Websitesubscribe;
use App\Models\Helper\Sequenceidhelper;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Websitesubscribeslivewire extends Component
{

    public $email;

    protected $rules = [
        'email' => 'required|email|max:60|unique:websitesubscribes,email',
    ];

    public function submit()
    {
        try {

            $this->validate();

            $uniqueId = Sequenceidhelper::getNextSequenceId(10, 'S', 'App\Models\Admin\Website\Websitesubscribe');
            Websitesubscribe::create([
                'email' => $this->email,
                'newsletter_status' => 1,
                'active' => 1,
                'sys_id' => $uniqueId['sys_id'],
                'uniqid' => $uniqueId['uniqid'],
                'sequence_id' => $uniqueId['sequence_id'],
            ]);

            // if (!Newsletter::isSubscribed($this->email)) {
            //     Newsletter::subscribe($this->email);
            //     session()->flash('message', 'You have successfully subscribed to the newsletter.');
            // }
            session()->flash('message', 'You have successfully subscribed to the newsletter.');

        } catch (Exception $e) {
            session()->flash('message', $e->message());
            Log::error('---1---Websitesubscribeslivewire----' . $e->message());
        } catch (QueryException $e) {
            session()->flash('message', $e->message());
            Log::error('---2---Websitesubscribeslivewire----' . $e->message());
        } catch (PDOException $e) {
            session()->flash('message', $e->message());
            Log::error('---3---Websitesubscribeslivewire----' . $e->message());
        }
    }

    public function updatedEmail()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.website.footer.websitesubscribeslivewire');
    }
}
