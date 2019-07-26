<?php

namespace Hubertnnn\LaravelNova\Fields\DynamicSelect\Traits;

use Closure;

trait HasDynamicOptions
{
    protected $options = [];
    protected $placeholder;
    protected $noResultText;
    protected $showLabels;

    public function options($options)
    {
        $this->options = $options;

        return $this;
    }

    public function getOptions($parameters = [])
    {
        $options = $this->options instanceof Closure
            ? call_user_func($this->options, $parameters)
            : $this->options;

        $result = [];
        foreach ($options as $key => $option) {
            $result[] = [
                'value' => $key,
                'label' => $option,
            ];
        }

        return $result;
    }

    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    public function noResultText($noResultText)
    {
        $this->noResultText = $noResultText;
        return $this;
    }

    public function getNoResultText()
    {
        return $this->noResultText;
    }

    public function showLabels($show)
    {
        $this->showLabels = $show;
        return $this;
    }

    public function getShowLabels()
    {
        return $this->showLabels;
    }
}
