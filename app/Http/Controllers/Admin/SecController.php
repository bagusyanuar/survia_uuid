<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Helper\ValidationRules;
use App\Models\Sec;
use Illuminate\Support\Facades\Validator;

class SecController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        try {
            if ($this->request->method() === 'POST') {
                return $this->store();
            }
            $data = Sec::all();
            return $this->jsonSuccessResponse('success', $data);
        } catch (\Exception $e) {
            return $this->jsonErrorResponse($e->getMessage());
        }
    }

    private function store()
    {
        $validator = Validator::make($this->request->all(), ValidationRules::$SECS);
        if ($validator->fails()) {
            return $this->jsonBadRequestResponse('invalid data request', $validator->errors()->toArray());
        }
        $result = Sec::create([
            'name' => $this->postField('name'),
            'start' => $this->postField('start'),
            'end' => $this->postField('end'),
        ]);
        return $this->jsonSuccessResponse('success', $result);
    }
}
