<?php

abstract class AbstractModel extends \Illuminate\Database\Eloquent\Model {

    public function newQuery() {
        $builder = $this->newEloquentBuilder(
                $this->newBaseQueryBuilder()
        );

        $builder->setModel($this)->with($this->with);



        if ($user = \Illuminate\Support\Facades\Auth::user()) {
            $builder->where('user_id', '=', $user->id);
        }

        return $this->applyGlobalScopes($builder);
    }

}
