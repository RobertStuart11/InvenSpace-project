<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'role_id' => Role::factory(),
            'nama' => fake()->name(),
            'username' => fake()->unique()->userName(),
            'password' => static::$password ??= Hash::make('password'),
            'kelas' => null,
            'nip' => null,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the user is a student (siswa).
     */
    public function siswa(): static
    {
        return $this->state(fn (array $attributes) => [
            'kelas' => fake()->randomElement(['X RPL 1', 'XI RPL 2', 'XII RPL 1']),
            'nip' => null,
        ]);
    }

    /**
     * Indicate that the user is a teacher (guru).
     */
    public function guru(): static
    {
        return $this->state(fn (array $attributes) => [
            'kelas' => null,
            'nip' => (string) fake()->unique()->numerify('##################'),
        ]);
    }
}
