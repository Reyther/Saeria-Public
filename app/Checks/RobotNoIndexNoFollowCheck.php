<?php

namespace App\Checks;

use BeyondCode\SelfDiagnosis\Checks\Check;

class RobotNoIndexNoFollowCheck implements Check
{
    public const REGEX = '/<meta(.*)[\r\n]*(.*)[\r\n]*(.*)(noindex|nofollow)(.*)[\r\n]*(.*)>/m';

    public function name(array $config): string
    {
        return 'Meta robot - Noindex Nofollow check';
    }

    public function check(array $config): bool
    {
        $dir = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator('resources/views'));

        foreach ($dir as $file) {
            if ($file->isDir()) {
                continue;
            }

            $content = file_get_contents($file->getPathname());
            if (preg_match(self::REGEX, $content)) {
                return false;
            }
        }

        return true;
    }

    public function message(array $config): string
    {
        return "Please remove <meta name=\"robots\" content=\"noindex, nofollow\"> in your layout";
    }
}
