<?php

namespace App\Http\Controllers\Website\Api\Employee;

use App\Http\Controllers\Helper\BaseController;
use App\Repository\Website\Api\Interfacelayer\Employee\IEmployeewebapiRepository;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class EmployeewebapiController extends BaseController
{
    public $employeewebrepo;

    public function __construct(IEmployeewebapiRepository $employeewebrepo)
    {
        $this->employeewebrepo = $employeewebrepo;
    }

    public function devicetoken(Request $request)
    {

        try {

            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'device_token' => 'bail|required|string|max:200|unique:employees',
                'device_model' => 'bail|nullable|string|max:100',
                'device_brand' => 'bail|nullable|string|max:100',
                'device_manufacturer' => 'bail|nullable|string|max:100',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError($validator->errors());
            }

            $data = $this->employeewebrepo->devicetoken();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2]) : $this->sendError($data[1]);

        } catch (Exception $e) {
            Log::error('Exception one: devicetoken Error: ' . $e->getMessage());
            DB::rollback();
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error('Exception two: devicetoken Error: ' . $e->getMessage());
            DB::rollback();
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: devicetoken Error: ' . $e->getMessage());
            DB::rollback();
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function subscribe(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'email' => 'bail|required|email|max:50',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError($validator->errors());
            }

            $data = $this->employeewebrepo->subscribe();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2]) : $this->sendError($data[1]);

        } catch (Exception $e) {
            Log::error('Exception one: subscribe  Error: ' . $e->getMessage());
            DB::rollback();
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error('Exception two: subscribe  Error: ' . $e->getMessage());
            DB::rollback();
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: subscribe  Error: ' . $e->getMessage());
            DB::rollback();
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
