<?php

namespace App\Http\Controllers\Website\Api\Blog;

use App\Http\Controllers\Helper\BaseController;
use App\Repository\Website\Api\Interfacelayer\Blog\IBlogwebapiRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class BlogwebapiController extends BaseController
{
    public $blogwebrepo;

    public function __construct(IBlogwebapiRepository $blogwebrepo)
    {
        $this->blogwebrepo = $blogwebrepo;
    }

    public function bloglist(Request $request)
    {

        try {
            $data = $this->blogwebrepo->bloglist();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2]) : $this->sendError($data[1]);

        } catch (Exception $e) {
            Log::error('Exception one: bloglist Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error('Exception two: bloglist Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: bloglist Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function getblogbyid(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'bloguuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors());
            }

            $data = $this->blogwebrepo->getblogbyid();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2]) : $this->sendError($data[1]);

        } catch (Exception $e) {
            Log::error('Exception one: getblogbyid  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error('Exception two: getblogbyid  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: getblogbyid  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function blogclassification(Request $request)
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

            $data = $this->blogwebrepo->blogclassification();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2]) : $this->sendError($data[1]);

        } catch (Exception $e) {
            Log::error('Exception one: blogclassification  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error('Exception two: blogclassification  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: blogclassification  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function getblogclassificationbyid(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'model' => 'bail|required|max:50',
                'uuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors());
            }

            $data = $this->blogwebrepo->getblogclassificationbyid();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2]) : $this->sendError($data[1]);

        } catch (Exception $e) {
            Log::error('Exception one: getblogclassificationbyid  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error('Exception two: getblogclassificationbyid  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: getblogclassificationbyid  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function blogfilter(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'search' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors());
            }

            $data = $this->blogwebrepo->blogfilter(request()->search);
            return ($data[0]) ? $this->sendResponse($data[1], $data[2]) : $this->sendError($data[1]);

        } catch (Exception $e) {
            Log::error('Exception one: blogfilter  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (\Illuminate\Database\QueryException$e) {
            Log::error('Exception two: blogfilter  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: blogfilter  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
