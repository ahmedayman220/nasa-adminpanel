<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHackathonQrCodeRequest;
use App\Http\Requests\UpdateHackathonQrCodeRequest;
use App\Http\Resources\Admin\HackathonQrCodeResource;
use App\Models\HackathonQrCode;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HackathonQrCodesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('hackathon_qr_code_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HackathonQrCodeResource(HackathonQrCode::with(['created_by'])->get());
    }

    public function store(StoreHackathonQrCodeRequest $request)
    {
        $hackathonQrCode = HackathonQrCode::create($request->all());

        return (new HackathonQrCodeResource($hackathonQrCode))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(HackathonQrCode $hackathonQrCode)
    {
        abort_if(Gate::denies('hackathon_qr_code_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HackathonQrCodeResource($hackathonQrCode->load(['created_by']));
    }

    public function update(UpdateHackathonQrCodeRequest $request, HackathonQrCode $hackathonQrCode)
    {
        $hackathonQrCode->update($request->all());

        return (new HackathonQrCodeResource($hackathonQrCode))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(HackathonQrCode $hackathonQrCode)
    {
        abort_if(Gate::denies('hackathon_qr_code_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hackathonQrCode->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
