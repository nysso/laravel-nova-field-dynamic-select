<?php

namespace Nysso\LaravelNova\Fields\DynamicSelect\Traits;

use Closure;

trait HasDynamicOptions
{
    protected $options = [];
    protected $placeholder = 'Pick a value';

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
}
