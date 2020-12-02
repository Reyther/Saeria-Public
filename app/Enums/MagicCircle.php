<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static BASE_PHYSICAL()
 * @method static static BASE_PSYCHIC()
 * @method static static COMBINED_PHYSICAL()
 * @method static static COMBINED_PSYCHIC()
 */
final class MagicCircle extends Enum implements LocalizedEnum
{
    const BASE_PHYSICAL =   "Élémentaire";
    const BASE_PSYCHIC =   "Divin";
    const COMBINED_PHYSICAL = "Secondaire";
    const COMBINED_PSYCHIC =   "Énergétique";
}
