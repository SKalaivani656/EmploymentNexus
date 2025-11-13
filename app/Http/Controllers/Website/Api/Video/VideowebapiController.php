<?php

namespace App\Http\Controllers\Website\Api\Video;

use App\Http\Controllers\Helper\BaseController;
use App\Repository\Website\Api\Interfacelayer\Video\IVideowebapiRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class VideowebapiController extends BaseController
{
    public $videowebrepo;

    public function __construct(IVideowebapiRepository $videowebrepo)
    {
        $this->videowebrepo = $videowebrepo;
    }

    public function videolist(Request $request)
    {

        try {
            $data = $this->videowebrepo->videolist();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2]) : $this->sendError($data[1]);

        } catch (Exception $e) {
            Log::error('Exception one: videolist Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error('Exception two: videolist Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: videolist Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function getvideobyid(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'videouuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors());
            }

            $data = $this->videowebrepo->getvideobyid();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2]) : $this->sendError($data[1]);

        } catch (Exception $e) {
            Log::error('Exception one: getvideobyid  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error('Exception two: getvideobyid  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: getvideobyid  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function videoclassification(Request $request)
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

            $data = $this->videowebrepo->videoclassification();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2]) : $this->sendError($data[1]);

        } catch (Exception $e) {
            Log::error('Exception one: videoclassification  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error('Exception two: videoclassification  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: videoclassification  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function getvideoclassificationbyid(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'model' => 'bail|required|max:50',
                'uuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors());
            }

            $data = $this->videowebrepo->getvideoclassificationbyid();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2]) : $this->sendError($data[1]);

        } catch (Exception $e) {
            Log::error('Exception one: getvideoclassificationbyid  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error('Exception two: getvideoclassificationbyid  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: getvideoclassificationbyid  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function videofilter(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'search' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors());
            }

            $data = $this->videowebrepo->videofilter(request()->search);
            return ($data[0]) ? $this->sendResponse($data[1], $data[2]) : $this->sendError($data[1]);

        } catch (Exception $e) {
            Log::error('Exception one: videofilter  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (\Illuminate\Database\QueryException$e) {
            Log::error('Exception two: videofilter  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: videofilter  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
