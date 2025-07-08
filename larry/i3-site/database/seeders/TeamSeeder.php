<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $team = [
            [
                'name' => 'Joel Salisbury',
                'title' => 'Director of i3',
                'img' => 'img/i3/people/salisbury-narrow.jpg'
            ],
            [
                'name' => 'Brian Kelleher',
                'title' => 'Senior Applications Developer',
                'img' => 'img/i3/people/kelleher.jpg'
            ],
            [
                'name' => 'Natalie Lacroix',
                'title' => 'Senior UX Designer',
                'img' => 'img/i3/people/lacroix.jpg'
            ],
            [
                'name' => 'Jeff Winston',
                'title' => 'Director: - Nexus',
                'img' => 'img/i3/people/winston.jpg'
            ],
            [
                'name' => 'Brian Daley',
                'title' => 'Faculty Advisor - DMD',
                'img' => 'img/i3/people/daley.jpg'
            ],
            [
                'name' => 'Michael Vertefeuille',
                'title' => 'Faculty Advisor - DMD',
                'img' => 'img/i3/people/vert-narrow.jpg'
            ],
            [
                'name' => 'Emma Adams',
                'title' => 'Student Web Developer',
                'img' => 'img/i3/people/adams.jpg'
            ],
            [
                'name' => 'Lauren Busavage',
                'title' => 'Student Web Developer',
                'img' => 'img/i3/people/busavage.png'
            ],
            [
                'name' => 'Kelis Clarke',
                'title' => 'Student UI/UX Designer',
                'img' => 'img/i3/people/jonathan.jpg'
            ],
            [
                'name' => 'Ryan Cohutt',
                'title' => 'Student UI/UX Designer',
                'img' => 'img/i3/people/jonathan.jpg'
            ],
            [
                'name' => 'Maggie Danielewicz',
                'title' => 'Student Web Developer',
                'img' => 'img/i3/people/danielewicz.jpg'
            ],
            [
                'name' => 'Luna Gonzalez',
                'title' => 'Student Illustrator',
                'img' => 'img/i3/people/luna.jpg'
            ],
            [
                'name' => 'Aaron Mark',
                'title' => 'Student Web Developer',
                'img' => 'img/i3/people/jonathan.jpg'
            ],
            [
                'name' => 'Jack Medrek',
                'title' => 'Student Software Developer',
                'img' => 'img/i3/people/medrek.jpg'
            ],
            [
                'name' => 'Kailey Moore',
                'title' => 'Student UI/UX Designer',
                'img' => 'img/i3/people/moore.jpg'
            ],
            [
                'name' => 'William Shostak',
                'title' => 'Student Software Developer',
                'img' => 'img/i3/people/shostak.jpg'
            ],
            [
                'name' => 'Emelia Salmon',
                'title' => 'Student UI/UX Designer',
                'img' => 'img/i3/people/jonathan.jpg'
            ]
        ];

        foreach ($team as $memberData) {
            $sourcePath = public_path($memberData['img']);
            $photoPath = null;

            if (File::exists($sourcePath)) {
                $fileName = basename($sourcePath);
                $destinationPath = 'team_thumbnails/' . $fileName;
                Storage::disk('public')->put($destinationPath, File::get($sourcePath));
                $photoPath = $destinationPath;
            }

            TeamMember::create([
                'name' => $memberData['name'],
                'role' => $memberData['title'],
                'photo' => $photoPath,
                'tags' => explode(' ', str_replace([' - ', ': - '], ' ', $memberData['title']))
            ]);
        }
    }
}
