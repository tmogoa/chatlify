<?php

namespace Database\Factories;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Chat::class;

    public $sender, $receiver;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->sender = random_int(12, 21);
        $this->receiver = random_int(1, 11);
        $chatText = "{  \"senderId\": " .$this->sender.",
                        \"receiverId\": " .$this->receiver.",
                        \"chatText\":\" " .$this->faker->sentence(20)." \",
                        \"visibilityStatus\": false
                        }";
        return [
            'senderId' => $this->sender,
            'receiverId' => $this->receiver,
            'chatText' => $chatText
        ];
    }
}
