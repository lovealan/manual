<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Form;

use Xielei\FormBuilder\ItemInterface;
use Xielei\Template;

class Simplemde implements ItemInterface
{

    public function __construct(string $label, string $name, $value = '')
    {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
    }

    public function set(string $name, $value): self
    {
        $this->$name = $value;
        return $this;
    }

    private function getTpl(): string
    {
        return <<<'str'
<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<div class="form-group">
    <label for="field_{:md5($name)}">{$label}</label>
    <textarea
        class="form-control"
        id="field_{:md5($name)}"
        name="{$name}"
        rows="{$rows}"
        {if isset($pattern) && $pattern}pattern="{$pattern}"{/if}
        {if isset($title) && $title}title="{$title}"{/if}
        placeholder="{$placeholder??''}"
        autocomplete="{$autocomplete??''}"
        maxlength="{$maxlength??''}"
        {if isset($required) && $required}required {/if}
        {if isset($readonly) && $readonly}readonly {/if}
        {if isset($disabled) && $disabled}disabled {/if}
        aria-describedby="help_{:md5($name)}"
    >{$value}</textarea>
    {if isset($help) && $help}
    <small id="help_{:md5($name)}" class="form-text text-muted">{$help}</small>
    {/if}
</div>
<script>
    var simplemde = new SimpleMDE({
        element: document.getElementById("field_{:md5($name)}")
    });
</script>
str;
    }

    public function __toString()
    {
        return (new Template())->renderFromString($this->getTpl(), get_object_vars($this));
    }
}
