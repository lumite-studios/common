<?php

namespace LumiteStudios\Common\Extend;

use Illuminate\Database\Seeder as BaseSeeder;

class Seeder extends BaseSeeder
{
    public function info(string $message): void
    {
        $this->command->getOutput()->writeln("<info>{$message}</info>");
    }
}
