<?php

namespace Hubertnnn\LaravelNova\Fields\DynamicSelect\Http\Controllers;

use Hubertnnn\LaravelNova\Fields\DynamicSelect\DynamicSelect;
use Illuminate\Routing\Controller;
use Laravel\Nova\Http\Requests\NovaRequest;

class OptionsController extends Controller
{
    public function index(NovaRequest $request)
    {
        $attribute = $request->input('attribute');
        $dependValues = $request->input('depends');

        $resource = $request->newResource();
        $fields = $resource->updateFields($request);
        $field = $fields->findFieldByAttribute($attribute);

        /** @var DynamicSelect $field */
        return [
            'options'      => $field->getOptions($dependValues),
            'placeholder'  => $field->getPlaceholder(),
            'noResultText' => $field->getNoResultText(),
            'showLabels'   => $field->getShowLabels()
        ];
    }
}
