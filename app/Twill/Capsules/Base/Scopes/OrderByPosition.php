<?php

namespace App\Twill\Capsules\Base\Scopes;

use App\Twill\Capsules\Base\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as Eloquent;

class OrderByPosition extends Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder|\App\Twill\Capsules\Base\Model  $builder
     * @param  \App\Twill\Capsules\Base\Model|\Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder|Model $builder, Model|Eloquent $model): void
    {
        $builder->orderBy("{$model->getTable()}.position", 'asc');
    }
}
