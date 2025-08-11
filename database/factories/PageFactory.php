<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    /**
     * Nome da model associada.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define os valores padrão para os campos.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'route' => '/' . $this->faker->slug(),
            'name'  => $this->faker->optional()->word(),
        ];
    }
}
