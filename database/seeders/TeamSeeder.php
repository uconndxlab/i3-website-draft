<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use App\Services\ImageProcessingService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeamSeeder extends Seeder
{
    protected ImageProcessingService $imageProcessingService;

    public function __construct(ImageProcessingService $imageProcessingService)
    {
        $this->imageProcessingService = $imageProcessingService;
    }
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
                'linkedin' => 'https://www.linkedin.com/in/salisburyj/',
                'tags' => ['director', 'senior-staff']
            ],
            [
                'name' => 'Brian Kelleher',
                'title' => 'Senior Applications Developer',
                'img' => 'img/i3/people/kelleher.jpg',
                'linkedin' => 'https://www.linkedin.com/in/briankelleher1/',
                'tags' => ['senior-staff', 'developer']
            ],
            [
                'name' => 'Natalie Lacroix',
                'title' => 'Senior UX Designer',
                'img' => 'img/i3/people/lacroix.jpg',
                'linkedin' => 'https://www.linkedin.com/in/natalie-lacroix-510a42188/',
                'tags' => ['senior-staff', 'designer']
            ],
            [
                'name' => 'Jeff Winston',
                'title' => 'Director: - Nexus',
                'img' => 'img/i3/people/winston.jpg',
                'linkedin' => 'https://www.linkedin.com/in/jeff-winston-60538086/',
                'tags' => ['senior-staff', 'nexus']
            ],
            [
                'name' => 'Brian Daley',
                'title' => 'Faculty Advisor - DMD',
                'img' => 'img/i3/people/daley.jpg',
                'linkedin' => 'https://www.linkedin.com/in/brianpdaley/',
                'tags' => ['faculty-advisor']
            ],
            [
                'name' => 'Michael Vertefeuille',
                'title' => 'Faculty Advisor - DMD',
                'img' => 'img/i3/people/vert-narrow.jpg',
                'linkedin' => 'https://www.linkedin.com/in/michaelvertefeuille/',
                'tags' => ['faculty-advisor']
            ],
            [
                'name' => 'Emma Adams',
                'title' => 'Student Web Developer',
                'img' => 'img/i3/people/adams.jpg',
                'linkedin' => 'https://www.linkedin.com/in/emma-adams-ct/',
                'tags' => ['student-staff']
            ],
            [
                'name' => 'Lauren Busavage',
                'title' => 'Student Web Developer',
                'img' => 'img/i3/people/busavage.png',
                'linkedin' => 'https://www.linkedin.com/in/lauren-busavage/',
                'tags' => ['student-staff', 'dxg']
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
                'img' => 'img/i3/people/cohutt.jpg',
                'linkedin' => 'https://www.linkedin.com/in/ryan-cohutt/',
                'tags' => ['student-staff', 'dxg']
            ],
            [
                'name' => 'Maggie Danielewicz',
                'title' => 'Student Web Developer',
                'img' => 'img/i3/people/danielewicz.jpg',
                'linkedin' => 'https://www.linkedin.com/in/magdalena-danielewicz/',
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
                'img' => 'img/i3/people/mark.jpg',
                'linkedin' => 'https://www.linkedin.com/in/aaronmark05/',
                'tags' => ['student-staff']
            ],
            [
                'name' => 'Kailey Moore',
                'title' => 'Student UI/UX Designer',
                'img' => 'img/i3/people/moore.jpg',
                'linkedin' => 'https://www.linkedin.com/in/kailey-moore-53532a283/',
                'tags' => ['student-staff']
            ],
            [
                'name' => 'William Shostak',
                'title' => 'Student Software Developer',
                'img' => 'img/i3/people/shostak.jpg',
                'linkedin' => 'https://www.linkedin.com/in/willshostak/',
                'tags' => ['student-staff', 'dxg']
            ],
            [
                'name' => 'Emelia Salmon',
                'title' => 'Student UI/UX Designer',
                'img' => 'img/i3/people/jonathan.jpg',
                'linkedin' => 'https://www.linkedin.com/in/emelia-salmon-561516232/',
                'tags' => ['student-staff', 'dxg']
            ],
        ];

        // This loads the alumni team members from a CSV file.
        // The file is currently maintained in the i3 Microsoft Teams/OneDrive.
        // Just stick it in the data directory and you can use it to seed the alumni team members.
        $alumniCsvPath = dirname(__FILE__) . '/data/alumni.csv';
        if (File::exists($alumniCsvPath)) {
            $alumniRows = array_map('str_getcsv', file($alumniCsvPath));
            $headers = array_map('trim', $alumniRows[0]);
            $headers[0] = preg_replace('/\x{FEFF}/u', '', $headers[0]);  // Remove BOM if present
            unset($alumniRows[0]);
            foreach ($alumniRows as $row) {
                $rowData = array_combine($headers, $row);
                $team[] = [
                    'name' => $rowData['Name'] ?? '',
                    'title' => trim(($rowData['Student Position'] ?? '')),
                    'img' => 'img/i3/people/jonathan.jpg',
                    'linkedin' => $rowData['LinkedIn'] ?? '',
                    'tags' => array_filter([
                        'alumni',
                        ...(
                            isset($rowData['Group']) && $rowData['Group']
                                ? array_map(
                                    fn($g) => Str::slug(trim($g)),
                                    explode(',', $rowData['Group'])
                                  )
                                : []
                        ),
                        isset($rowData['Grad Year']) ? 'grad-' . $rowData['Grad Year'] : null,
                    ]),
                ];
            }
        }

        foreach ($team as $memberData) {
            $sourcePath = public_path($memberData['img']);
            $photoPath = null;
            $photoMediumPath = null;
            $photoWebpPath = null;

            if (File::exists($sourcePath)) {
                $fileName = basename($sourcePath);
                $destinationPath = 'team_thumbnails/' . $fileName;
                Storage::disk('public')->put($destinationPath, File::get($sourcePath));
                $photoPath = $destinationPath;

                // Generate additional image formats for existing images
                try {
                    $imagePaths = $this->imageProcessingService->processExistingImage($destinationPath);
                    $photoMediumPath = $imagePaths['medium'];
                    $photoWebpPath = $imagePaths['webp'];
                } catch (\Exception $e) {
                    // If image processing fails, just use the original
                    \Log::warning("Failed to process image for {$memberData['name']}: " . $e->getMessage());
                }
            }

            TeamMember::firstOrCreate(
                [
                    'name' => $memberData['name'],
                ],
                [
                    'role' => $memberData['title'],
                    'photo' => $photoPath,
                    'photo_medium' => $photoMediumPath,
                    'photo_webp' => $photoWebpPath,
                    'tags' => $memberData['tags'],
                    'linkedin' => $memberData['linkedin'] ?? null,
                ]
            );
        }
    }
}
