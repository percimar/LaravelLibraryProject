<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = [
            'Fantasy',
            'Historical Fiction',
            'Autobiography',
            'Horror',
            'Detective Mystery',
            'Romance',
            'Thrillers'
        ];

        return [
            'title' => $this->faker->words(3,true),
            'isbn' => $this->faker->isbn13,
            'author' => $this->faker->name,
            'category' => $this->faker->randomElement($array = $categories),
            'image' => 'https://picsum.photos/' . $this->faker->numberBetween(195,205) . '/' . $this->faker->numberBetween(295,305),
            // 'image' => $this->faker->imageUrl(200, 300, $this->faker->words($this->faker->numberBetween(0, 4), true), true, $this->faker->randomElement($array = $categories)),
            'pages' => $this->faker->numberBetween($min = 50, $max = 750),
            'publication' => $this->faker->date($format = 'Y-m-d', $max = 'now')
        ];
    }
}
