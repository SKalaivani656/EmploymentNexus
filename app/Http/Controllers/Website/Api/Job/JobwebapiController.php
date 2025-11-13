<?php

namespace App\Http\Controllers\Website\Api\Job;

use App\Http\Controllers\Helper\BaseController;
use App\Repository\Website\Api\Interfacelayer\Job\IJobwebapiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class JobwebapiController extends BaseController
{
    public $jobwebrepo;

    public function __construct(IJobwebapiRepository $jobwebrepo)
    {
        $this->jobwebrepo = $jobwebrepo;
    }

    public function joblist(Request $request)
    {

        try {
            $data = $this->jobwebrepo->joblist();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2]) : $this->sendError($data[1]);

        } catch (Exception $e) {
            Log::error('Exception one: joblist Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error('Exception two: joblist Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: joblist Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function getjobtypelist(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'name' => 'bail|required|max:50',
                'value' => 'bail|required|max:65',
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors());
            }

            $data = $this->jobwebrepo->getjobtypelist();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2]) : $this->sendError($data[1]);

        } catch (Exception $e) {
            Log::error('Exception one: joblist Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error('Exception two: joblist Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: joblist Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function getjobbyid(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'jobuuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors());
            }

            $data = $this->jobwebrepo->getjobbyid();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2]) : $this->sendError($data[1]);

        } catch (Exception $e) {
            Log::error('Exception one: getjobbyid  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error('Exception two: getjobbyid  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: getjobbyid  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function jobclassification(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'model' => 'bail|required|max:50',
                'is_popular' => 'bail|nullable|boolean',
                'is_top' => 'bail|nullable|boolean',
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors());
            }

            $data = $this->jobwebrepo->jobclassification();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2]) : $this->sendError($data[1]);

        } catch (Exception $e) {
            Log::error('Exception one: jobclassification  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error('Exception two: jobclassification  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: jobclassification  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function getjobclassificationbyid(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'model' => 'bail|required|max:50',
                'uuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors());
            }

            $data = $this->jobwebrepo->getjobclassificationbyid();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2]) : $this->sendError($data[1]);

        } catch (Exception $e) {
            Log::error('Exception one: getjobclassificationbyid  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error('Exception two: getjobclassificationbyid  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: getjobclassificationbyid  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function jobsearch(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'search' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors());
            }

            $data = $this->jobwebrepo->jobsearch(request()->search);
            return ($data[0]) ? $this->sendResponse($data[1], $data[2]) : $this->sendError($data[1]);

        } catch (Exception $e) {
            Log::error('Exception one: jobfilter  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (\Illuminate\Database\QueryException$e) {
            Log::error('Exception two: jobfilter  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: jobfilter  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function jobfilter(Request $request)
    {
        try {

            $data = $this->jobwebrepo->jobfilter(request()->search);
            return ($data[0]) ? $this->sendResponse($data[1], $data[2]) : $this->sendError($data[1]);

        } catch (Exception $e) {
            Log::error('Exception one: jobfilter  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (\Illuminate\Database\QueryException$e) {
            Log::error('Exception two: jobfilter  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: jobfilter  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function pushnotification(Request $request)
    {
        try {

            $data = $this->jobwebrepo->pushnotification();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2]) : $this->sendError($data[1]);

        } catch (Exception $e) {
            Log::error('Exception one: jobfilter  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (\Illuminate\Database\QueryException$e) {
            Log::error('Exception two: jobfilter  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: jobfilter  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

}
