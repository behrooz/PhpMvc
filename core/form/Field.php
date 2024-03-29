<?php

namespace app\core\form;

use app\core\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';

    public string $type;
    public string $attribute;
    public Model $model;

    /**
     * @param string $attribute
     * @param Model $model
     */
    public function __construct(Model $model,string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->attribute = $attribute;
        $this->model = $model;
    }

    public function __toString()
    {
        return sprintf('
            
        
            <div class="form-group">
                <label class="form-label">%s</label>
                <input type="%s" name="%s" value="%s" class="form-control%s">
                <div class="invalid-feedback">
                    %s
                </div>
            </div>                        
        

        ',
        $this->model->getLabels($this->attribute),
        $this->type,
        $this->attribute,
        $this->model->{$this->attribute},
        $this->model->hasError($this->attribute) ? ' is-invalid' :'',
        $this->model->getFirstError($this->attribute)
        );
    }
    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
}