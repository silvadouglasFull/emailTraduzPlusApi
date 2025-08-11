<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PagesTableSeeder extends Seeder
{
    use HasFactory;

    /**
     * Executa a inserção de dados.
     *
     * @return void
     */
    public function run(): void
    {
        $user = User::find(1);
        Page::create([
            'title' => 'Home',
            'route' => '/',
            'name'  => 'homepage',
            'user_id' => $user->id,
        ]);

        Page::create([
            'title' => 'About',
            'route' => '/about',
            'name'  => 'about',
            'user_id' => $user->id,
        ]);
    }
}
