<?php

namespace App\Models;

use App\Models\Traits\HasImagesTrait;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Magic extends Model
{
    use CrudTrait, HasImagesTrait;

    const TABLE_NAME = "magics";
    const COL_NAME = "name";
    const COL_DESC = "description";
    const COL_CIRCLE = "circle";
    const COL_IMAGE = "image";

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = self::TABLE_NAME;
    protected $fillable = [
        self::COL_NAME,
        self::COL_DESC,
        self::COL_CIRCLE,
        self::COL_IMAGE,
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    /**
     * Set the magic's image.
     *
     * @param  string  $value
     * @return void
     */
    public function setImageAttribute($value)
    {
        $this->applyImageMutator(self::COL_IMAGE, $value, 'magics');
    }
}
