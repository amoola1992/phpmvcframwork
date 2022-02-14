<?php

namespace phpcodemvc/phpmvcframwork\form;

use phpcodemvc/phpmvcframwork\Model;

abstract class BaseField 
{

    public Model $model;
    public string $attribute;

    public function __construct(Model $model , string $attribute , string $type)
    {
        $this-> type =$type;
        $this->model = $model;
        $this->attribute = $attribute;

    }

    abstract public function renderInput() : string;

    public function __toString()
    {
        return sprintf('<div class="form-group" data-os-animation="zoomIn" data-os-animation-delay="0.5s">
        <label for="" class="sr-only">%s</label>
        %s
        <div class="invalid-feedback">
        %s
      </div> 
      </div>',
       $this->model->getLabels($this->attribute) ,
       $this->renderInput(),
         $this->model->getFirstError($this->attribute)
        );
    }
}
