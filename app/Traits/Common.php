<?php
namespace App\Traits;

trait Common {
    public function update($id ,$model) {
        
        $update = $model::find($id);
        if($update->active == 1)
        {
            $update->active = 0;
        }elseif($update->active == 0)
        {
            $update->active = 1;
        }
        $update->save();
    }
}