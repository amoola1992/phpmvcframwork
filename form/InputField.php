<?php

namespace phpcodemvc/phpmvcframwork\form;

use phpcodemvc/phpmvcframwork\Model;

class InputField extends BaseField
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';
    public const TYPE_EMAIL = 'email';

    public string $type;



    public function __construct(Model $model , string $attribute , string $type)
    {
        parent::__construct($model,$attribute,$type);

    }

  

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function renderInput(): string
    {
        return sprintf('<input type="%s" id="username" name="%s" class="form-control %s" value="%s"
        placeholder="%s" required autofocus>',
        $this->type,
        $this->attribute 
        ,$this->attribute,
        $this->attribute,
         $this->model->{$this->attribute}, 
         $this->model->hasError($this->attribute)? 'is-invalid': '',);
    }

}
