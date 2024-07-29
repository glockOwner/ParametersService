<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class ParameterFilter extends AbstractFilter
{
    public const TITLE = 'title';
    public const ID = 'id';


    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self::ID => [$this, 'id'],
        ];
    }

    public function title(Builder $builder, string $value)
    {
        $builder->where('title', 'like', "%{$value}%");
    }

    public function id(Builder $builder, string $value)
    {
        $builder->where('id', '=', "$value");
    }
}
