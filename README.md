# Dynamic select field for Laravel Nova

* Added support for Nova >= 2.0.1

* This field allows you to dynamically fill contents of a select based on values in other dynamic select fields.

Package forked from https://github.com/hubertnnn/laravel-nova-field-dynamic-select

### Usage
Class have 2 special methods on top of default Select from Laravel Nova.
`dependsOn` can take a list of other fields this one depends on.
`options` can be either an array or a callable. 
If its a callable, it will receive array with selected dependency values as 
first argument and should return an array of items to be shown on the select field.


### Example:

```
public function fields(Request $request)
    {
        return [

            ID::make()->sortable(),

            DynamicSelect::make('Country', 'country')
                ->options(['US' => 'United States', 'UK' => 'United Kingdom'])
                ->rules('required')
            ,

            DynamicSelect::make('Provider', 'provider')
                ->options(['PR' => 'Premium', 'ST' => 'Standard'])
                ->placeholder('choose a value')
                ->rules('required')
            ,

            DynamicSelect::make('Product', 'product')
                ->dependsOn(['country', 'provider'])
                ->options(function($values) { 
                    if($values['country'] === 'UK' && $values['provider'] === 'PR') {
                        return ['A' => 'Fast shipping', 'B' => 'Normal shipping', 'C' => 'Free shipping'];
                    } else {
                        return ['A' => 'Fast shipping', 'B' => 'Normal shipping'];
                    }
                })
                ->rules('required')
            ,
        ];
    }

```

