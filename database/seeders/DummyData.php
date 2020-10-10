<?php

namespace Database\Seeders;

use App\Models\Artis;
use App\Models\EO;
use App\Models\KonserEO;
use App\Models\Level;
use App\Models\Penonton;
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

        $fotoKTP = "https://awsimages.detik.net.id/community/media/visual/2017/07/20/3a1c67e8-064d-4f56-80eb-feced76cad3e_169.jpg?w=700&q=90"  ;
        $foto = "http://wartabahari.com/wp-content/uploads/2017/10/IMG_20171019_125049-768x576.jpg" ;

        $fotoKonser = "https://v-pro.id/wp-content/uploads/2019/09/Konser-1024x512.jpg" ;

        foreach (json_decode('
            [
               {
                    "no_hp": "+6287781751389",
                    "email": "William",
                    "id_level": 3,
                    "id": 1,
                    "alamat": "P.O. Box 235, 5505 Tellus. St."
                },
                {
                    "no_hp": "+6287168442816",
                    "email": "Tanner",
                    "id_level": 3,
                    "id": 2,
                    "alamat": "392-6755 Donec Street"
                },
                {
                    "no_hp": "+6281828257319",
                    "email": "Louis",
                    "id_level": 2,
                    "id": 3,
                    "alamat": "Ap #948-8875 Phasellus Street"
                },
                {
                    "no_hp": "+6282813179573",
                    "email": "Austin",
                    "id_level": 1,
                    "id": 4,
                    "alamat": "462-9763 Lorem Road"
                },
                {
                    "no_hp": "+6288052944394",
                    "email": "Dorian",
                    "id_level": 3,
                    "id": 5,
                    "alamat": "P.O. Box 326, 1549 Pellentesque Street"
                },
                {
                    "no_hp": "+6289281386943",
                    "email": "Abbot",
                    "id_level": 3,
                    "id": 6,
                    "alamat": "Ap #365-4857 Felis. Rd."
                },
                {
                    "no_hp": "+6284696540997",
                    "email": "Wyatt",
                    "id_level": 2,
                    "id": 7,
                    "alamat": "218-9327 Aliquam Av."
                },
                {
                    "no_hp": "+6289615567334",
                    "email": "Troy",
                    "id_level": 2,
                    "id": 8,
                    "alamat": "151-2179 Metus Street"
                },
                {
                    "no_hp": "+6287846098476",
                    "email": "Alan",
                    "id_level": 3,
                    "id": 9,
                    "alamat": "Ap #940-5651 Cum St."
                },
                {
                    "no_hp": "+6287100789166",
                    "email": "Emerson",
                    "id_level": 3,
                    "id": 10,
                    "alamat": "798-217 Fusce St."
                },
                {
                    "no_hp": "+6282427185302",
                    "email": "Cyrus",
                    "id_level": 2,
                    "id": 11,
                    "alamat": "P.O. Box 647, 3636 Magna Avenue"
                },
                {
                    "no_hp": "+6286278094565",
                    "email": "Dustin",
                    "id_level": 3,
                    "id": 12,
                    "alamat": "8652 Ultrices Avenue"
                },
                {
                    "no_hp": "+6280601139500",
                    "email": "Arsenio",
                    "id_level": 2,
                    "id": 13,
                    "alamat": "Ap #314-2070 Gravida. Street"
                },
                {
                    "no_hp": "+6286800703414",
                    "email": "Tobias",
                    "id_level": 1,
                    "id": 14,
                    "alamat": "Ap #759-1887 Dolor Street"
                },
                {
                    "no_hp": "+6288853674379",
                    "email": "Murphy",
                    "id_level": 1,
                    "id": 15,
                    "alamat": "345-6394 Ipsum St."
                },
                {
                    "no_hp": "+6283412002579",
                    "email": "Nigel",
                    "id_level": 1,
                    "id": 16,
                    "alamat": "717-3683 Molestie Avenue"
                },
                {
                    "no_hp": "+6287601801068",
                    "email": "Seth",
                    "id_level": 3,
                    "id": 17,
                    "alamat": "P.O. Box 326, 7465 Orci Rd."
                },
                {
                    "no_hp": "+6280584091650",
                    "email": "Nolan",
                    "id_level": 1,
                    "id": 18,
                    "alamat": "Ap #378-1725 Non Ave"
                },
                {
                    "no_hp": "+6281489574592",
                    "email": "Prescott",
                    "id_level": 2,
                    "id": 19,
                    "alamat": "P.O. Box 515, 8689 Arcu St."
                },
                {
                    "no_hp": "+6286350891547",
                    "email": "Timothy",
                    "id_level": 3,
                    "id": 20,
                    "alamat": "P.O. Box 258, 1423 Ultrices, Ave"
                },
                {
                    "no_hp": "+6280874290897",
                    "email": "Fritz",
                    "id_level": 1,
                    "id": 21,
                    "alamat": "P.O. Box 773, 7685 Inceptos St."
                },
                {
                    "no_hp": "+6280486828850",
                    "email": "Alec",
                    "id_level": 2,
                    "id": 22,
                    "alamat": "P.O. Box 524, 3580 Non Avenue"
                },
                {
                    "no_hp": "+6280030808601",
                    "email": "Ishmael",
                    "id_level": 1,
                    "id": 23,
                    "alamat": "P.O. Box 908, 2255 Lectus Road"
                },
                {
                    "no_hp": "+6287526433691",
                    "email": "Quinlan",
                    "id_level": 3,
                    "id": 24,
                    "alamat": "7091 Sit Rd."
                },
                {
                    "no_hp": "+6281179229506",
                    "email": "Levi",
                    "id_level": 1,
                    "id": 25,
                    "alamat": "P.O. Box 485, 3754 Amet Road"
                },
                {
                    "no_hp": "+6281846224322",
                    "email": "Jelani",
                    "id_level": 2,
                    "id": 26,
                    "alamat": "P.O. Box 528, 5130 Aenean Road"
                },
                {
                    "no_hp": "+6289208680184",
                    "email": "Reese",
                    "id_level": 1,
                    "id": 27,
                    "alamat": "Ap #893-4356 Augue St."
                },
                {
                    "no_hp": "+6285515515868",
                    "email": "Rashad",
                    "id_level": 3,
                    "id": 28,
                    "alamat": "P.O. Box 484, 8583 Quis, St."
                },
                {
                    "no_hp": "+6281764716506",
                    "email": "Ali",
                    "id_level": 1,
                    "id": 29,
                    "alamat": "5524 Mus. St."
                },
                {
                    "no_hp": "+6282666094173",
                    "email": "Harper",
                    "id_level": 3,
                    "id": 30,
                    "alamat": "Ap #927-8151 Eros. Street"
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
                $eo = EO::create([
                    'id_user' => $user->id,
                    'foto' => $foto,
                    'foto_ktp' => $fotoKTP,
                    'nama' => $value->email,
                    'alamat' => $value->alamat,
                ]);
                foreach (json_decode('
                    [
                        {
                        "jum_tiket": 20,
                        "judul": "Damaliscus lunatus",
                        "waktu": "9/20/2020",
                        "desk": "Other repair or plastic operations on bone, tibia and fibula"
                        }, {
                        "jum_tiket": 71,
                        "judul": "Oreamnos americanus",
                        "waktu": "12/25/2019",
                        "desk": "Suture of laceration of scrotum and tunica vaginalis"
                        }, {
                        "jum_tiket": 85,
                        "judul": "Geospiza sp.",
                        "waktu": "3/23/2020",
                        "desk": "Rectal massage (for levator spasm)"
                        }, {
                        "jum_tiket": 62,
                        "judul": "Ardea cinerea",
                        "waktu": "7/9/2020",
                        "desk": "Coronary arteriography using two catheters"
                        }, {
                        "jum_tiket": 3,
                        "judul": "Spizaetus coronatus",
                        "waktu": "11/8/2019",
                        "desk": "Orthovoltage radiation"
                        }, {
                        "jum_tiket": 6,
                        "judul": "Columba palumbus",
                        "waktu": "5/9/2020",
                        "desk": "Other iridotomy"
                        }, {
                        "jum_tiket": 27,
                        "judul": "Buteo galapagoensis",
                        "waktu": "2/28/2020",
                        "desk": "Repair of blood vessel with tissue patch graft"
                        }, {
                        "jum_tiket": 56,
                        "judul": "Vanessa indica",
                        "waktu": "4/12/2020",
                        "desk": "Insertion of temporary non-implantable extracorporeal circulatory assist device"
                        }, {
                        "jum_tiket": 39,
                        "judul": "Tamiasciurus hudsonicus",
                        "waktu": "5/3/2020",
                        "desk": "Microscopic examination of specimen from skin and other integument, cell block and Papanicolaou smear"
                        }, {
                        "jum_tiket": 61,
                        "judul": "Otaria flavescens",
                        "waktu": "1/30/2020",
                        "desk": "Wide excision of lesion of lip"
                        }, {
                        "jum_tiket": 54,
                        "judul": "Oncorhynchus nerka",
                        "waktu": "12/28/2019",
                        "desk": "Transurethral clearance of bladder"
                        }, {
                        "jum_tiket": 41,
                        "judul": "Ictalurus furcatus",
                        "waktu": "7/8/2020",
                        "desk": "Other resection of rectum"
                        }, {
                        "jum_tiket": 16,
                        "judul": "Tringa glareola",
                        "waktu": "11/26/2019",
                        "desk": "Other dilation and curettage"
                        }, {
                        "jum_tiket": 64,
                        "judul": "Laniarius ferrugineus",
                        "waktu": "8/7/2020",
                        "desk": "Vaginal reconstruction"
                        }, {
                        "jum_tiket": 72,
                        "judul": "Ninox superciliaris",
                        "waktu": "11/12/2019",
                        "desk": "Biopsy of cul-de-sac"
                        }, {
                        "jum_tiket": 59,
                        "judul": "Ovis musimon",
                        "waktu": "2/23/2020",
                        "desk": "Microscopic examination of peritoneal and retroperitoneal specimen, culture"
                        }, {
                        "jum_tiket": 94,
                        "judul": "Galictis vittata",
                        "waktu": "5/21/2020",
                        "desk": "Production of subcutaneous tunnel without esophageal anastomosis"
                        }, {
                        "jum_tiket": 5,
                        "judul": "Seiurus aurocapillus",
                        "waktu": "2/26/2020",
                        "desk": "Pharyngectomy (partial)"
                        }, {
                        "jum_tiket": 1,
                        "judul": "Herpestes javanicus",
                        "waktu": "2/27/2020",
                        "desk": "Revision or replacement of artificial spinal disc prosthesis, not otherwise specified"
                        }, {
                        "jum_tiket": 92,
                        "judul": "Spheniscus magellanicus",
                        "waktu": "1/17/2020",
                        "desk": "Other antesternal esophageal anastomosis with interposition"
                        }
                    ]
                ') as $keyKonser => $valKonser) {
                    $konserEO = KonserEO::create([
                        'id_eo' => $eo->id,
                        'jum_tiket' => $valKonser->jum_tiket,
                        'foto' => $fotoKonser,
                        'judul' => 'konser'. $value->email.' '.$valKonser->judul,
                        'waktu' => date('Y-m-d', strtotime($valKonser->waktu)),
                        'desk' => 'des' . $value->email .' '.$valKonser->desk,
                    ]);
                    // foreach (json_decode('
                        
                    // ') as $keyTiket => $valTiket) {
                        
                    // }
                }
            } else if($key >= 11 && $key <= 20) {
                $user = User::create([
                    'no_hp' => $value->no_hp,
                    'email' => strtolower($value->email).'@gmail.com',
                    'id_level' => 2,
                    'password' => Hash::make(123456)
                ]);
                $artis = Artis::create([
                    'id_user' => $user->id,
                    'foto' => $foto,
                    'foto_ktp' => $fotoKTP,
                    'nama' => $value->email,
                    'alamat' => $value->alamat,
                ]);
            } else {
                $user = User::create([
                    'no_hp' => $value->no_hp,
                    'email' => strtolower($value->email).'@gmail.com',
                    'id_level' => 3,
                    'password' => Hash::make(123456)
                ]);
                $penonton = Penonton::create([
                    'nama' => $value->email,
                    'alamat' => $value->alamat,
                    'uang' => rand()
                ]);
            }
        }
    }
}
