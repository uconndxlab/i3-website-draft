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
                'img' => 'img/i3/people/salisbury-narrow.jpg',
                'tags' => ['director', 'senior-staff']
            ],
            [
                'name' => 'Brian Kelleher',
                'title' => 'Senior Applications Developer',
                'img' => 'img/i3/people/kelleher.jpg',
                'tags' => ['senior-staff', 'developer']
            ],
            [
                'name' => 'Natalie Lacroix',
                'title' => 'Senior UX Designer',
                'img' => 'img/i3/people/lacroix.jpg',
                'tags' => ['senior-staff', 'designer']
            ],
            [
                'name' => 'Jeff Winston',
                'title' => 'Director: - Nexus',
                'img' => 'img/i3/people/winston.jpg',
                'tags' => ['senior-staff', 'nexus']
            ],
            [
                'name' => 'Brian Daley',
                'title' => 'Faculty Advisor - DMD',
                'img' => 'img/i3/people/daley.jpg',
                'tags' => ['faculty-advisor']
            ],
            [
                'name' => 'Michael Vertefeuille',
                'title' => 'Faculty Advisor - DMD',
                'img' => 'img/i3/people/vert-narrow.jpg',
                'tags' => ['faculty-advisor']
            ],
            [
                'name' => 'Emma Adams',
                'title' => 'Student Web Developer',
                'img' => 'img/i3/people/adams.jpg',
                'tags' => ['student-staff']
            ],
            [
                'name' => 'Lauren Busavage',
                'title' => 'Student Web Developer',
                'img' => 'img/i3/people/busavage.png',
                'tags' => ['student-staff']
            ],
            [
                'name' => 'Kelis Clarke',
                'title' => 'Student UI/UX Designer',
                'img' => 'img/i3/people/jonathan.jpg',
                'tags' => ['student-staff']
            ],
            [
                'name' => 'Ryan Cohutt',
                'title' => 'Student UI/UX Designer',
                'img' => 'img/i3/people/jonathan.jpg',
                'tags' => ['student-staff']
            ],
            [
                'name' => 'Maggie Danielewicz',
                'title' => 'Student Web Developer',
                'img' => 'img/i3/people/danielewicz.jpg',
                'tags' => ['student-staff']
            ],
            [
                'name' => 'Luna Gonzalez',
                'title' => 'Student Illustrator',
                'img' => 'img/i3/people/luna.jpg',
                'tags' => ['student-staff']
            ],
            [
                'name' => 'Aaron Mark',
                'title' => 'Student Web Developer',
                'img' => 'img/i3/people/jonathan.jpg',
                'tags' => ['student-staff']
            ],
            [
                'name' => 'Jack Medrek',
                'title' => 'Student Software Developer',
                'img' => 'img/i3/people/medrek.jpg',
                'tags' => ['student-staff']
            ],
            [
                'name' => 'Kailey Moore',
                'title' => 'Student UI/UX Designer',
                'img' => 'img/i3/people/moore.jpg',
                'tags' => ['student-staff']
            ],
            [
                'name' => 'William Shostak',
                'title' => 'Student Software Developer',
                'img' => 'img/i3/people/shostak.jpg',
                'tags' => ['student-staff']
            ],
            [
                'name' => 'Emelia Salmon',
                'title' => 'Student UI/UX Designer',
                'img' => 'img/i3/people/jonathan.jpg',
                'tags' => ['student-staff']
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
                'tags' => $memberData['tags']
            ]);
        }
    }
}
