<?php

use Illuminate\Database\Seeder;
use App\Entity\Push;

class PushSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Push::class, 340)->create();
    }
}
