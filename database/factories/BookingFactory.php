<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::all();
        $rooms = Room::all();
        $timeslots = [];

        //Loop through next 7 days
        for($i = 0; $i < 7; $i++) {
            $day = today()->add($i, 'day');
            //Skip weekends
            if($day->isFriday() || $day->isSaturday()) {
                continue;
            }

            //First time slot is 7:30 AM
            $timeslot = $day->add(7, 'hours')->add(30, 'minutes');
            //Loop through 7:30 AM through 7:30 PM and add to $timeslots
            for($j = 0; $j < 12; $j++) {
                if($timeslot > now()) {
                    array_push($timeslots, new Carbon($timeslot));
                }
                $timeslot = $timeslot->add(1, 'hour');
            }
        }


        return [
            'booking_date' => $this->faker->dateTimeBetween('-1 week', 'now'),
            'approved_date' => function (array $attributes) {
                return $this->faker->optional()->dateTimeBetween($attributes['booking_date'], 'now');
            },
            'timeslot' => $this->faker->unique()->randomElement($timeslots),
            // 'timeslot' => $this->timeslots[$this->faker->unique()->numberBetween(0, 59)],
            'room_id' => $this->faker->randomElement($rooms),
            'user_id' => $this->faker->randomElement($users)
        ];
    }
}
