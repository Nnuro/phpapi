<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ApiModel;
use App\Models\CommonModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class ApiController extends Controller
{

    /** @var ApiModel */
    public $Model;

    /** @var Resource */
    public $Resource;

    /** @var Collection */
    public $Collection;

    /** @var Request */
    public $Request;

    public function __construct(CommonModel $model, String $resource = null) {
        $this->Model = $model;

        $this->setResource($resource);
    }

    public function setResource($resource = null) {
        $resourceNS = "\\App\\Http\\Resources";
        $requestNS = "\\App\\Http\\Requests";
        $modelClassName = str_replace('App\\Models\\', '', get_class($this->Model));

        if( $resource ) {
            if (strpos($resource, $resourceNS) === false) {
                $this->Resource = $resourceNS . "\\{$resource}";
            } else {
                $this->Resource = $resource;
            }
        } else {
            $this->Resource = $resourceNS . "\\" . $modelClassName . 'Resource';
        }

        try {
            if( !class_exists($this->Resource) ) {
                throw new Exception('Missing resource');
            }
        } catch(\Error | \Exception $e) {
            $this->Resource = $resourceNS . "\\ApiResource";
        }

        $this->Request = $requestNS . "\\" . $modelClassName . 'Request';
    }

    /**
     * Get All
     *
     * @queryParam limit Total items to return e.g. `?limit=15`
     * @queryParam page Page of items to return e.g. `?page=1`
     * @queryParam sort Sorting options e.g. `?sort=surname:asc,othernames:asc`
     * @queryParam count Count related models. Alternatively `with_count` e.g. `?count=student,student_program`
     * @queryParam contain Contain data from related model e.g. `?contain=program,currency`
     * @queryParam fieldName Pass any field and value to filter results e.g. `name=John&email=any@aol.com`
     *
     * @authenticated
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dataModel = $this->Model->getAll($request);
        return $this->Resource::collection($dataModel);
    }


    /**
     * Create Resource
     *
     * @queryParam count Count related models. Alternatively `with_count` e.g. `?count=student,student_program`
     * @queryParam contain Contain data from related model e.g. `?contain=program,currency`
     *
     * @authenticated
     * @param  \Illuminate\Foundation\Http\FormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if( class_exists($this->Request)) {
                $formRequest = new $this->Request( $request->all() );
                $validator = Validator::make( $request->all(), $formRequest->rules(), $formRequest->messages());

                if( $validator->fails() ) {
                    return response()->json([
                        'status' => 'error',
                        'message' => $validator->errors()->all()
                    ], 400);
                }
            }

            $dataModel = $this->Model->store($request);
            return new $this->Resource($dataModel);

        }catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * View Resource
     *
     * @queryParam sort Sorting options e.g. `?sort=surname:asc,othernames:asc`
     * @queryParam count Count related models. Alternatively `with_count` e.g. `?count=student,student_program`
     * @queryParam contain Contain data from related model e.g. `?contain=program,currency`
     *
     * @authenticated
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $dataModel = $this->Model->getById($id, $request);

        if ($dataModel) {
            return new $this->Resource($dataModel);
        }

        return response()->json([
            'status' => 'failed',
            'message' => 'Resource not found'
        ], 404);
    }

    /**
     * Update Resource
     *
     * @queryParam count Count related models. Alternatively `with_count` e.g. `?count=student,student_program`
     * @queryParam contain Contain data from related model e.g. `?contain=program,currency`
     *
     * @authenticated
     * @param  \Illuminate\Foundation\Http\FormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            if( class_exists($this->Request) ) {
                $formRequest = new $this->Request( $request->all() );
                $validator = Validator::make( $request->all(), $formRequest->rules(), $formRequest->messages());

                if( $validator->fails() ) {
                    return response()->json([
                        'status' => 'error',
                        'message' => $validator->errors()->all()
                    ], 400);
                }
            }

            $dataModel = $this->Model->modify($request, $id);
            return new $this->Resource($dataModel);
        }
        catch(NotFoundHttpException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Resource not found'
            ], 404);
        }
        catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getTrace()
            ], 500);
        }
    }

    /**
     * Delete Resource
     *
     * @authenticated
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataModel = $this->Model->find($id);

        if ($dataModel) {
            $dataModel->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Resource deleted'
            ]);
        }

        return response()->json([
            'status' => 'failed',
            'message' => 'Resource not found'
        ], 404);
    }

    /**
     * Search Resources
     *
     * @queryParam limit Total items to return e.g. `?limit=15`
     * @queryParam page Page of items to return e.g. `?page=1`
     * @queryParam sort Sorting options e.g. `?sort=surname:asc,othernames:asc`
     * @queryParam count Count related models. Alternatively `with_count` e.g. `?count=student,student_program`
     * @queryParam contain Contain data from related model e.g. `?contain=program,currency`
     * @queryParam fieldName Pass any field and value to search by e.g. `name=John&email=any@aol.com`. Search logic may use LIKE or `=` depending on field
     *
     * @authenticated
     */
    public function search(Request $request) {
        $results = $this->Model->search($request);

        return $this->Resource::collection($results);
    }

    /**
     * Count Resources
     *
     * @queryParam fieldName Pass any field and value to search by e.g. `name=John&email=any@aol.com`. Search logic may use LIKE or `=` depending on field
     *
     * @authenticated
     */
    public function count(Request $request) {
        $results = $this->Model->count($request);

        return response()->json(['count' => $results]);
    }
}
