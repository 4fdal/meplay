<?php

namespace Database\Seeders;

use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::insert([
            ['id' => 1, 'nama' => 'eo', 'desk' => 'eo', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ],
            ['id' => 2, 'nama' => 'artis', 'desk' => 'artis', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ],
            ['id' => 3, 'nama' => 'penonton', 'desk' => 'penonton', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ],
        ]);

        foreach (json_decode('
            [
                {
                    "no_hp": "+6285134384225",
                    "email": "Fitzgerald",
                    "id_level": 2,
                    "id": 1
                },
                {
                    "no_hp": "+6282770987222",
                    "email": "Nero",
                    "id_level": 3,
                    "id": 2
                },
                {
                    "no_hp": "+6284488362756",
                    "email": "Geoffrey",
                    "id_level": 2,
                    "id": 3
                },
                {
                    "no_hp": "+6284652279071",
                    "email": "Lee",
                    "id_level": 2,
                    "id": 4
                },
                {
                    "no_hp": "+6289390576158",
                    "email": "Tate",
                    "id_level": 3,
                    "id": 5
                },
                {
                    "no_hp": "+6283148827121",
                    "email": "Aidan",
                    "id_level": 3,
                    "id": 6
                },
                {
                    "no_hp": "+6280552952936",
                    "email": "Walter",
                    "id_level": 1,
                    "id": 7
                },
                {
                    "no_hp": "+6282884291947",
                    "email": "Garrison",
                    "id_level": 1,
                    "id": 8
                },
                {
                    "no_hp": "+6285650157750",
                    "email": "Melvin",
                    "id_level": 1,
                    "id": 9
                },
                {
                    "no_hp": "+6283543829554",
                    "email": "Preston",
                    "id_level": 2,
                    "id": 10
                },
                {
                    "no_hp": "+6282392015889",
                    "email": "Steel",
                    "id_level": 2,
                    "id": 11
                },
                {
                    "no_hp": "+6285601517041",
                    "email": "Tobias",
                    "id_level": 2,
                    "id": 12
                },
                {
                    "no_hp": "+6280378628707",
                    "email": "Cairo",
                    "id_level": 2,
                    "id": 13
                },
                {
                    "no_hp": "+6286173206140",
                    "email": "Solomon",
                    "id_level": 3,
                    "id": 14
                },
                {
                    "no_hp": "+6286372406240",
                    "email": "Ulric",
                    "id_level": 2,
                    "id": 15
                },
                {
                    "no_hp": "+6289931909659",
                    "email": "Wang",
                    "id_level": 1,
                    "id": 16
                },
                {
                    "no_hp": "+6287056454728",
                    "email": "Rogan",
                    "id_level": 3,
                    "id": 17
                },
                {
                    "no_hp": "+6285933024222",
                    "email": "Bernard",
                    "id_level": 1,
                    "id": 18
                },
                {
                    "no_hp": "+6280232410550",
                    "email": "Macon",
                    "id_level": 3,
                    "id": 19
                },
                {
                    "no_hp": "+6283225731296",
                    "email": "Steel",
                    "id_level": 2,
                    "id": 20
                },
                {
                    "no_hp": "+6286573330274",
                    "email": "Wylie",
                    "id_level": 2,
                    "id": 21
                },
                {
                    "no_hp": "+6280674402705",
                    "email": "Leroy",
                    "id_level": 1,
                    "id": 22
                },
                {
                    "no_hp": "+6289781921599",
                    "email": "Burke",
                    "id_level": 3,
                    "id": 23
                },
                {
                    "no_hp": "+6289939929946",
                    "email": "John",
                    "id_level": 3,
                    "id": 24
                },
                {
                    "no_hp": "+6289466937147",
                    "email": "Nasim",
                    "id_level": 1,
                    "id": 25
                },
                {
                    "no_hp": "+6288113068101",
                    "email": "Colby",
                    "id_level": 2,
                    "id": 26
                },
                {
                    "no_hp": "+6288713999633",
                    "email": "Cadman",
                    "id_level": 1,
                    "id": 27
                },
                {
                    "no_hp": "+6284045975818",
                    "email": "Kennan",
                    "id_level": 2,
                    "id": 28
                },
                {
                    "no_hp": "+6280345668440",
                    "email": "Keegan",
                    "id_level": 1,
                    "id": 29
                },
                {
                    "no_hp": "+6289760733240",
                    "email": "Randall",
                    "id_level": 3,
                    "id": 30
                }
            ]
        ') as $key => $value) {
            if($key >= 0 && $key <= 10) {
                $user = User::create([
                    'no_hp' => $value->no_hp,
                    'email' => strtolower($value->email).'@gmail.com',
                    'id_level' => 1,
                    'password' => Hash::make(123456)
                ]);

            } else if($key >= 11 && $key <= 20) {
                $user = User::create([
                    'no_hp' => $value->no_hp,
                    'email' => strtolower($value->email).'@gmail.com',
                    'id_level' => 2,
                    'password' => Hash::make(123456)
                ]);
            } else {
                $user = User::create([
                    'no_hp' => $value->no_hp,
                    'email' => strtolower($value->email).'@gmail.com',
                    'id_level' => 3,
                    'password' => Hash::make(123456)
                ]);
            }
        }
    }
}
