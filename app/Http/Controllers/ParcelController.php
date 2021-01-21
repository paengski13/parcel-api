<?php

namespace App\Http\Controllers;

use App\Helpers\Interfaces\Standards;
use App\Helpers\Traits\CommonTrait;
use App\Http\Requests\ParcelRequest;
use Illuminate\Http\Request;

use App\Repositories\ParcelRepository;

class ParcelController extends Controller
{
    use CommonTrait;

    public $parcelRepository;

    /**
     * ParcelController constructor.
     * @param ParcelRepository $parcelRepository
     */
    public function __construct(ParcelRepository $parcelRepository)
    {
        $this->parcelRepository = $parcelRepository;
    }

    /**
     * Retrieve a single parcel record
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $parcel = $this->parcelRepository->getSingle($id);
        if (!$parcel) {
            // TODO: create a common function to handle response
            return response()->json([
                'data' => []
            ], 403);
        }
        $parcelDetail = $parcel->parcelDetails()->where('is_optimal_value', 1)->first();
        $standard = $parcelDetail->standard;
        /** @var Standards $object */
        $object = $this->getReflectionModel($standard->model);

        return response()->json([
            'data' => [
                'quote' => $object->formatParcelQuote($parcel->name, $parcelDetail->value, $parcelDetail->price, $standard->measurement_symbol, $standard->model)
            ]
        ], 200);
    }

    /**
     * Record a parcel and return the optimal price value
     *
     * @param ParcelRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ParcelRequest $request)
    {
        $parcel = $this->parcelRepository->createSingle($request->all());
        return response()->json([
            'data' => [
                'id'   => $parcel->id,
                'name' => $parcel->name,
                'quote' => '$' . floatval($parcel->quote), // Todo: create a helper for formatting the price value
            ]
        ], 200);
    }

    /**
     * Update only the basic parcel information
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $this->parcelRepository->updateSingle($id, $request->all());

        return response()->json([
            'data' => []
        ], 200);
    }

    /**
     * Update only the basic parcel information
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $id)
    {
        $parcel = $this->parcelRepository->deleteSingle($id);
        return response()->json([
            'data' => []
        ], 200);
    }

    /**
     * Sum the total of all parcels given
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPrices(Request $request)
    {
        $parcelArr = explode(",", $request->input('parcelIds'));
        $totalQuote = 0;
        if ($parcelArr) {
            $parcel = $this->parcelRepository->getParcels(explode(",", $request->input('parcelIds')));
            $totalQuote = $parcel->sum('quote');
        }
        return response()->json([
            'data' => [
                'total' => $totalQuote
            ]
        ], 200);
    }
}
