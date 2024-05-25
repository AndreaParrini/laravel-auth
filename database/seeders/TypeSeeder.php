<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $types = ['Programming', 'Fullstack', 'Backend', 'IoT', 'Cyber Security'];

        foreach ($types as $typ) {
            $type = new Type();
            $type->name = $typ;
            $type->slug = Str::slug($typ, '-');
            $type->save();
        }
    }
}
