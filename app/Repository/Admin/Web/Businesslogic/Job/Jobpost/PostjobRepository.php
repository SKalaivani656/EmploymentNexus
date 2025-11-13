<?php

namespace App\Repository\Admin\Web\Businesslogic\Job\Jobpost;

use App\Models\Admin\Exam\Master\Competitiveexam;
use App\Models\Admin\Job\Jobmaster\Branchjob;
use App\Models\Admin\Job\Jobmaster\Categoryjob;
use App\Models\Admin\Job\Jobmaster\Companyjob;
use App\Models\Admin\Job\Jobmaster\Coursejob;
use App\Models\Admin\Job\Jobmaster\Designationjob;
use App\Models\Admin\Job\Jobmaster\Languagejob;
use App\Models\Admin\Job\Jobmaster\Notificationlinkjob;
use App\Models\Admin\Job\Jobmaster\Rolejob;
use App\Models\Admin\Job\Jobmaster\Skilljob;
use App\Models\Admin\Job\Jobmaster\Tagjob;
use App\Models\Admin\Job\Jobmaster\Typejob;
use App\Models\Admin\Job\Jobpost\Postjob;
use App\Models\Admin\Worldinfo\City;
use App\Models\Admin\Worldinfo\Country;
use App\Models\Admin\Worldinfo\State;
use App\Models\Helper\Sequenceidhelper;
use App\Models\Helper\Trackmessagehelper;
use App\Repository\Admin\Web\Interfacelayer\Job\Jobpost\IPostjobRepository;
use App\Traits\UploadTrait;
use Auth;
use File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PostjobRepository implements IPostjobRepository
{
    use UploadTrait;

    public function index()
    {
        $postjob = Postjob::select(array('id', 'uniqid', 'title', 'active', 'created_by', 'created_at'))
            ->latest();
        return DataTables::of($postjob)
            ->setRowClass(function ($postjob) {
                return ($postjob->active == true) ? '' : 'text-danger';
            })
            ->editColumn('created_at', function ($postjob) {
                return $postjob->created_at->format('d/m/Y H:i:s');
            })
            ->addColumn('action', function ($postjob) {
                $action = '<td class="text-right">';
                if (auth()->user()->can('postjob-show')) {
                    $action .= '<a href="postjob/' . $postjob->id . '" class="shadow rounded btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></a>';
                }
                if (auth()->user()->can('postjob-edit')) {
                    $action .= ' <a href="postjob/' . $postjob->id . '/edit" class="shadow rounded btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>';
                }
                $action .= ' </td>';
                return $action;
            })
            ->rawColumns(['action', 'created_at'])
            ->make(true);
    }

    public function create()
    {
        $data['country'] = [0 => 'Select Countries'] + Country::pluck('name', 'id')->all();
        $data['companyjob'] = [0 => 'Select Company'] + Companyjob::where('active', true)
            ->pluck('name', 'id')->all();
        return $data;
    }

    public function store($collection = [])
    {

        $sessionid = request()->session()->get('sessionid');
        Log::info("SessionID " . $sessionid . ' Function : add/edit Postjob');

        // Need to use later both subtitle and short_description
        $collection['subtitle'] = request('seo_description');
        $collection['short_description'] = request('seo_description');

        $collection['active'] = request()->has('active');
        $collection['is_top'] = request()->has('is_top');
        $collection['is_popular'] = request()->has('is_popular');
        $collection['video_status'] = request()->has('video_status');
        $collection['image_status'] = request()->has('image_status');
        $collection['jobcomment'] = request()->has('jobcomment');
        $collection['slug'] = Str::slug(request()->slug, '-');

        if (request()->hasFile('image')) {
            $collection['image'] = $this->uploadOne(request()->file('image'), '/images/jobpost/images/', '/images/jobpost/thumbnail/', 'App\Models\Admin\Job\Jobpost\Postjob', 70, [250, 125]);
        }
        if (request()->country_id) {
            $collection['country_id'] = request()->country_id;
            $collection['country'] = Country::find(request()->country_id)->name;
        }
        if (request()->state_id && request()->state_id != 'Select' && request()->state_id != 'null') {
            $collection['state_id'] = request()->state_id;
            $collection['state'] = State::find(request()->state_id)->name;
        } else {
            $collection['state_id'] = null;
            $collection['state'] = '';
        }
        if (request()->city_id && request()->city_id != 'Select' && request()->city_id != 'null') {
            $collection['city_id'] = request()->city_id;
            $collection['city'] = City::find(request()->city_id)->name;
        } else {
            $collection['city_id'] = null;
            $collection['city'] = '';
        }
        if (!empty(request()->id)) {
            $collection['updated_id'] = Auth::user()->id;
            $collection['updated_by'] = Auth::user()->name;
            $collection['body'] = $this->domimageoptimization($collection['body'], request()->uniqid);

            $postjob = Postjob::find(request()->id);
            $collection['seo_title'] = request('title') . ' | ' . $postjob->created_at->format('Y') . ' jobs';
            $postjob->branchjob()->sync(request()->branch_select);
            $postjob->categoryjob()->sync(request()->category_select);
            $postjob->coursejob()->sync(request()->course_select);
            $postjob->skilljob()->sync(request()->skill_select);
            $postjob->languagejob()->sync(request()->language_select);
            $postjob->tagjob()->sync(request()->tag_select);
            $postjob->typejob()->sync(request()->type_select);
            $postjob->rolejob()->sync(request()->roles_select);
            $postjob->competitiveexam()->sync(request()->competitiveexam_select);
            $postjob->designationjob()->sync(request()->designation_select);

            $notificationlink = $this->notificationlink($postjob->id);
            Notificationlinkjob::where('postjob_id', request()->id)->delete();
            Notificationlinkjob::insert($notificationlink);

            $postjob->fill($collection);
            $postjob->save();

            toast('Job Post Updated successfully', 'success', 'top-right');
            $trackStatus = request()->uniqid . ' Updated Existing Postjob';
        } else {
            $collection['seo_title'] = request('title') . ' | ' . date('Y') . ' jobs';
            $uniqueId = Sequenceidhelper::getNextSequenceId(10, 'JOB', 'App\Models\Admin\Job\Jobpost\Postjob');
            $collection['sys_id'] = md5(uniqid(rand(), true));
            $collection['uniqid'] = $uniqueId['uniqid'];
            $collection['sequence_id'] = $uniqueId['sequence_id'];
            $collection['user_id'] = Auth::user()->id;
            $collection['created_by'] = Auth::user()->name;

            $collection['body'] = $this->domimageoptimization(request()->body, $uniqueId['uniqid']);

            $postjob = Postjob::create($collection);
            $postjob->branchjob()->attach(request()->branch_select);
            $postjob->categoryjob()->attach(request()->category_select);
            $postjob->coursejob()->attach(request()->course_select);
            $postjob->skilljob()->attach(request()->skill_select);
            $postjob->languagejob()->attach(request()->language_select);
            $postjob->designationjob()->attach(request()->designation_select);
            $postjob->tagjob()->attach(request()->tag_select);
            $postjob->typejob()->attach(request()->type_select);
            $postjob->rolejob()->attach(request()->roles_select);
            $postjob->competitiveexam()->attach(request()->competitiveexam_select);

            $notificationlink = $this->notificationlink($postjob->id);
            Notificationlinkjob::insert($notificationlink);

            toast('New Job Post Created Successfully', 'success', 'top-right');
            $trackStatus = $collection['uniqid'] . ' Created New Postjob';

        }
        Trackmessagehelper::trackmessage($trackStatus, 'ADMIN', 'ADD/EDIT  Post Job', $sessionid, 'WEB');
    }

    public function edit()
    {
        $data['country'] = [0 => 'Select Countries'] + Country::pluck('name', 'id')->all();
        $data['companyjob'] = [0 => 'Select Company'] + Companyjob::where('active', true)
            ->pluck('name', 'id')->all();
        return $data;
    }

    private function domimageoptimization($body, $unique)
    {

        $path = public_path() . '/images/job/jobcontent/' . $unique;

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        $dom = new \DomDocument();
        //@$dom->loadHtml($body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        @$dom->loadHtml(mb_convert_encoding($body, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        // foreach <img> in the submited message
        foreach ($images as $img) {
            $src = $img->getAttribute('src');

            // if the img source is 'data-url'
            if (preg_match('/data:image/', $src)) {

                // get the mimetype
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];

                // Generating a random filename
                $filename = uniqid();
                $filepath = "/images/job/jobcontent/$unique/$filename.$mimetype";

                // @see http://image.intervention.io/api/
                $image = Image::make($src)
                // resize if required
                /* ->resize(300, 200) */
                    ->encode($mimetype, 100) // encode file to the specified mimetype
                    ->save(public_path($filepath));

                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            } // <!--endif
        } // <!--endforeach
        return $dom->saveHTML();

    }

    public function notificationlink($id)
    {

        $notification_name = request()->notification_name;

        $notificationlinkarr = array();
        if (!is_null($notification_name)) {
            for ($i = 0; $i < sizeof($notification_name); $i++) {
                $notificationlinkarr[] = [
                    'postjob_id' => $id,
                    'notification_name' => $notification_name[$i],
                    'notification_source' => request()->notification_source[$i],
                    'notification_link' => request()->notification_link[$i],
                ];
            }
        }

        return $notificationlinkarr;
    }

    public function ajaxcategorylistjob()
    {
        $category = Categoryjob::where('active', true)->get();
        $tag = Tagjob::where('active', true)->get();
        $branch = Branchjob::where('active', true)->get();
        $roles = Rolejob::where('active', true)->get();
        $course = Coursejob::where('active', true)->get();
        $skill = Skilljob::where('active', true)->get();
        $language = Languagejob::where('active', true)->get();
        $type = Typejob::where('active', true)->get();
        $designation = Designationjob::where('active', true)->get();
        $competitiveexam = Competitiveexam::where('active', true)->get();

        $categoryoption = '<option value="">SELECT CATEGORY</option>';
        foreach ($category as $row) {
            $categoryoption .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        $tagoption = '<option value="">SELECT TAG</option>';
        foreach ($tag as $row) {
            $tagoption .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        $branchoption = '<option value="">SELECT BRANCH</option>';
        foreach ($branch as $row) {
            $branchoption .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        $rolesoption = '<option value="">SELECT COMPANY</option>';
        foreach ($roles as $row) {
            $rolesoption .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }

        $courseoption = '<option value="">SELECT COURSE</option>';
        foreach ($course as $row) {
            $courseoption .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        $skilloption = '<option value="">SELECT SKILL</option>';
        foreach ($skill as $row) {
            $skilloption .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        $typeoption = '<option value="">SELECT TYPE</option>';
        foreach ($type as $row) {
            $typeoption .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }

        $languageoption = '<option value="">SELECT LANGUAGE</option>';
        foreach ($language as $row) {
            $languageoption .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }

        $designationoption = '<option value="">SELECT Designation</option>';
        foreach ($designation as $row) {
            $designationoption .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }

        $competitiveexamoption = '<option value="">SELECT COMPETITIVE EXAM</option>';
        foreach ($competitiveexam as $row) {
            $competitiveexamoption .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }

        $output = array(
            'categoryoption' => $categoryoption,
            'tagoption' => $tagoption,
            'branchoption' => $branchoption,
            'rolesoption' => $rolesoption,
            'courseoption' => $courseoption,
            'skilloption' => $skilloption,
            'typeoption' => $typeoption,
            'languageoption' => $languageoption,
            'designationoption' => $designationoption,
            'competitiveexamoption' => $competitiveexamoption,
        );

        echo json_encode($output);
    }

    public function getstatelist()
    {
        $states = State::where("country_id", request()->country_id)
            ->pluck("name", "id");
        return response()->json($states);
    }

    public function getcitylist()
    {
        $cities = City::where("state_id", request()->state_id)
            ->pluck("name", "id");
        return response()->json($cities);
    }

}
