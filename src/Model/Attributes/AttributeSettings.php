<?php

namespace LumiteStudios\Common\Model\Attributes;

/**
 * @method mixed getSetting(string $setting)
 * @method array getSettings()
 * @method bool  setSetting(string $setting, mixed $value)
 * @method bool  setSettings(array $settings)
 */
trait AttributeSettings
{
    public function getSetting(string $setting): mixed
    {
        return $this->getSettings()[$setting] ?? null;
    }

    public function getSettings(): array
    {
        $settings = $this->getRawOriginal('settings');
        if (is_array($settings)) {
            return $settings;
        }

        return json_decode($settings, true);
    }

    public function setSetting(string $setting, mixed $value): bool
    {
        return $this->update(['settings' => array_merge($this->getSettings(), [$setting => $value])]) ? true : false;
    }

    public function setSettings(array $settings): bool
    {
        return $this->update(['settings' => array_merge($this->getSettings(), $settings)]) ? true : false;
    }

    protected function setSettingsAttribute($settings)
    {
        $this->attributes['settings'] = json_encode(array_merge($this->getSettings(), $settings));
    }
}
