<?php

namespace App\Repository\Website\Api\Businesslogic\Job;

use App\Http\Resources\Job\JobclassificationCollection;
use App\Http\Resources\Job\JobCollection;
use App\Http\Resources\Job\JobdetailResource;
use App\Models\Admin\Exam\Master\Competitiveexam;
use App\Models\Admin\Job\Jobmaster\Branchjob;
use App\Models\Admin\Job\Jobmaster\Categoryjob;
use App\Models\Admin\Job\Jobmaster\Companyjob;
use App\Models\Admin\Job\Jobmaster\Coursejob;
use App\Models\Admin\Job\Jobmaster\Designationjob;
use App\Models\Admin\Job\Jobmaster\Languagejob;
use App\Models\Admin\Job\Jobmaster\Skilljob;
use App\Models\Admin\Job\Jobmaster\Tagjob;
use App\Models\Admin\Job\Jobmaster\Typejob;
use App\Models\Admin\Job\Jobpost\Postjob;
use App\Models\Admin\Worldinfo\City;
use App\Models\Admin\Worldinfo\State;
use App\Models\Employee\Auth\Employee;
use App\Repository\Website\Api\Interfacelayer\Job\IJobwebapiRepository;

class JobwebapiRepository implements IJobwebapiRepository
{

    public function joblist()
    {
        $postjob = Postjob::where('active', true)->latest()->paginate(10);
        return [true, new JobCollection($postjob), 'joblist'];
    }
    public function getjobbyid()
    {
        $postjob = Postjob::where('active', true)
            ->firstWhere('uuid', request()->jobuuid);

        return [true, new JobdetailResource($postjob), 'getjobbyid'];
    }

    public function getjobtypelist()
    {
        $value = request()->value;

        $query = $this->findmodel(request()->name);
        if ($query) {
            $value && $query->where('name', $value);
        } else {
            return [false, 'Invalid Request'];
        }
        if ($query->first()) {
            return [
                true,
                new JobCollection($query->first()->postjob()->paginate(10)),
                'getjobtypelist',
            ];
        } else {
            return [false, 'Invalid Request'];
        }
    }

    public function jobclassification()
    {
        $model = request()->model;
        $is_popular = request()->is_popular;
        $is_top = request()->is_top;

        $query = $this->findmodel($model);

        if ($query) {
            $is_popular && $query->where('is_popular', $is_popular);
            $is_top && $query->where('is_top', $is_top);
            ($model == 'state') && $query->where('country_id', 101);
        } else {
            return [false, 'Invalid Request'];
        }

        return [
            true,
            new JobclassificationCollection($query->latest()->paginate(15)),
            'jobclassification',
        ];

    }

    public function getjobclassificationbyid()
    {

        $uuid = request()->uuid;

        $query = $this->findmodel(request()->model);
        if ($query) {
            $uuid && $query->where('uuid', $uuid);
        } else {
            return [false, 'Invalid Request'];
        }
        if ($query->first()) {
            return [
                true,
                new JobCollection($query->first()->postjob()->paginate(10)),
                'jobclassification',
            ];
        } else {
            return [false, 'Invalid Request'];
        }

    }

    public function jobsearch()
    {

        $search = request()->search;

        $postjob = Postjob::where('active', true)
            ->where(function ($query) use ($search) {
                $query->where('title', "LIKE", "%{$search}%")
                    ->orWhere('subtitle', "LIKE", "%{$search}%");
            })
            ->latest()->paginate(10);

        return [true, new JobCollection($postjob), 'jobsearch'];
    }

    public function jobfilter()
    {

        $data['type'] = Typejob::where('active', true)->where('is_mobile', true)->select('uuid', 'name')->get();
        $data['skill'] = Skilljob::where('active', true)->where('is_mobile', true)->select('uuid', 'name')->get();
        $data['category'] = Categoryjob::where('active', true)->where('is_mobile', true)->select('uuid', 'name')->get();
        $data['course'] = Coursejob::where('active', true)->where('is_mobile', true)->select('uuid', 'name')->get();
        $data['company'] = Companyjob::where('active', true)->where('is_mobile', true)->select('uuid', 'name')->get();
        $data['language'] = Languagejob::where('active', true)->where('is_mobile', true)->select('uuid', 'name')->get();
        $data['branch'] = Branchjob::where('active', true)->where('is_mobile', true)->select('uuid', 'name')->get();
        $data['tag'] = Tagjob::where('active', true)->where('is_mobile', true)->select('uuid', 'name')->get();
        $data['city'] = City::where('active', true)->where('is_mobile', true)->select('uuid', 'name')->get();
        $data['state'] = State::where('active', true)->where('is_mobile', true)->where('country_id', 101)->select('uuid', 'name')->get();

        return [true, $data, 'jobfilter'];
    }

    private function findmodel($model)
    {
        switch ($model) {
            case "type":
                return Typejob::where('active', true);
                break;
            case "skill":
                return Skilljob::where('active', true);
                break;
            case "category":
                return Categoryjob::where('active', true);
                break;
            case "course":
                return Coursejob::where('active', true);
                break;
            case "designation":
                return Designationjob::where('active', true);
                break;
            case "exam":
                return Competitiveexam::where('active', true);
                break;
            case "company":
                return Companyjob::where('active', true);
                break;
            case "language":
                return Languagejob::where('active', true);
                break;
            case "branch":
                return Branchjob::where('active', true);
                break;
            case "tag":
                return Tagjob::where('active', true);
                break;
            case "city":
                return City::where('active', true);
                break;
            case "state":
                return State::where('active', true);
                break;
            default:
                return false;
        }
    }

    public function pushnotification()
    {
        //https://www.remotestack.io/how-to-send-web-push-notification-in-laravel-with-firebase/
        $title = request()->title;
        $message = request()->message;
        // $id = request()->id;
        // $type = request()->type;

        $firebaseToken = Employee::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = 'AAAA2U-KyCo:APA91bFENNtRRKnD7i6QnkMrFE6wCAKlV9F_DSxWG4MEMwWVieCNHgBdAfmvk1K-PNkRJ8yhyJw88_RPZCPS3ftvF6V1AZ5z0kt_3LwwhLaVs2zGk5zyzf4U1se0zjtvywazToei0CFd';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $title,
                "body" => $message,
            ],
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        return [true, $response, 'pushnotification'];
    }
}

// foreach ($vendordevicetoken as $eachvendordevicetoken) {

//     $dataString = '{
//         "to" : "' . $vendordevicetoken . '",
//         "data" : {
//           "body" : "",
//           "title" : "' . $title . '",
//           "type" : "' . $type . '",
//           "id" : "' . $id . '",
//           "message" : "' . $message . '",
//         },
//         "notification" : {
//              "body" : "' . $message . '",
//              "title" : "' . $title . '",
//              "type" : "' . $type . '",
//              "id" : "' . $id . '",
//              "message" : "' . $message . '",
//             "icon" : "new",
//             "sound" : "alert.mp3"
//             },

//       }';

//     $headers = [

//         'Authorization: key=' . $SERVER_API_KEY,

//         'Content-Type: application/json',

//     ];

//     $ch = curl_init();

//     curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

//     curl_setopt($ch, CURLOPT_POST, true);

//     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//     curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

//     $response = curl_exec($ch);
// }

// Log::info('VendorOrderNotification - toFcm : VendorId' . $vendor->uniqid . ' Order Number: ' . $event->order->ordernumber . ' Response: ' . $response);
// return "success";
