<?php

namespace App\Http\Controllers;

use App\Http\Filters\ParameterFilter;
use App\Http\Filters\PerformerFilter;
use App\Models\Parameter;
use App\Repositories\ParameterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ParameterRepository $repository, Request $request)
    {
        $data = $request->query();
        $filter = App::makeWith(ParameterFilter::class, ['queryParams' => $data]);
        $parameters = $repository->getWithFilter($filter);

        return view('parameters.index', compact('parameters'));
    }


    public function upload(Request $request, string $iconType, Parameter $parameter)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,png,pdf|max:2048',
        ]);

        $file = $request->file('file');
        $fileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), '-').'_'.time().'.'.pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        $path = $file->storePubliclyAs('public', $fileName);


        if (isset($parameter->$iconType)) {
            Storage::delete('public/' . $parameter->$iconType);
        }

        $parameter->$iconType = $fileName;


        $parameter->save();

        return "File uploaded successfully!";
    }

    public function delete(string $iconType, Parameter $parameter)
    {
        if (isset($parameter->$iconType)) {
            Storage::delete('public/' . $parameter->$iconType);
        }

        $parameter->$iconType = null;


        $parameter->save();

        return "File deleted successfully!";
    }

    public function getParams()
    {
        $parameters = Parameter::where('type', '2')->get();

        foreach ($parameters as $parameter) {
            $parameter->icon_path = isset($parameter->icon) ? 'storage/app/public/' . $parameter->icon : null;
            $parameter->icon_gray_path = isset($parameter->icon_gray) ? 'storage/app/public/' . $parameter->icon_gray : null;
        }

        return response()->json($parameters, 200);
    }
}
