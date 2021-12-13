<?php

namespace OptimistDigital\NovaTranslatable\Fields;

use Laravel\Nova\Fields\Field;
use OptimistDigital\NovaTranslatable\FieldServiceProvider;

class LocaleSelect extends Field
{
    public $component = 'locale-select-field';

    public $showOnIndex = false;

    protected $translatableMeta = [];

    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->translatableMeta = [
            'locales' => FieldServiceProvider::getLocales(),
            'displayType' => config('nova-translatable.locale_select.display_type')
        ];

        return $this->setTranslatableMeta();
    }

    /**
     * @param array|callable $locales
     */
    public function setLocales($locales): self
    {
        $this->translatableMeta['locales'] = FieldServiceProvider::getLocales($locales);
        return $this->setTranslatableMeta();
    }

    public function setDisplayType(string $type): self
    {
        $this->translatableMeta['displayType'] = $type;
        return $this->setTranslatableMeta();
    }

    private function setTranslatableMeta(): self
    {
        return $this->withMeta(['translatable' => $this->translatableMeta]);
    }
}
