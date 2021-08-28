<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            'Developer',
            'Java Developer',
            'Junior Software Engineer',
            '.NET Developer',
            'Programmer',
            'Programmer Analyst',
            'Senior Applications Engineer',
            'Senior Programmer',
            'Senior Programmer Analyst',
            'Senior Software Engineer',
            'Senior System Architect',
            'Senior System Designer',
            'Senior Systems Software Engineer',
            'Software Architect',
            'Software Developer',
            'Software Engineer',
            'Software Quality Assurance Analyst',
            'System Architect',
            'Systems Software Engineer',
            'Front End Developer',
            'Senior Web Administrator',
            'Senior Web Developer',
            'Web Administrator',
            'Web Developer',
            'Information Security Analyst',
            'Security Specialist',
            'Senior Security Specialist',
            'Chief Information Officer (CIO)',
            'Chief Technology Officer (CTO)',
            'Director of Technology',
            'IT Director',
            'IT Manager',
            'Management Information Systems Director',
            'Technical Operations Officer',
            'Application Support Analyst',
            'Senior System Analyst',
            'Systems Analyst',
            'Systems Designer',
            'Data Center Support Specialist',
            'Data Quality Manager',
            'Database Administrator',
            'Senior Database Administrator',
            'Customer Support Administrator',
            'Customer Support Specialist',
            'Desktop Support Manager',
            'Desktop Support Specialist',
            'Help Desk Specialist',
            'Help Desk Technician',
            'IT Support Manager',
            'IT Support Specialist',
            'IT Systems Administrator',
            'Senior Support Specialist',
            'Senior System Administrator',
            'Support Specialist',
            'Systems Administrator',
            'Technical Specialist',
            'Technical Support Engineer',
            'Technical Support Specialist',
            'Computer and Information Research Scientist',
            'Computer and Information Systems Manager',
            'Computer Network Architect',
            'Computer Systems Analyst',
            'Computer Systems Manager',
            'IT Analyst',
            'IT Coordinator',
            'Network Administrator',
            'Network Architect',
            'Network and Computer Systems Administrator',
            'Network Engineer',
            'Network Systems Administrator',
            'Senior Network Architect',
            'Senior Network Engineer',
            'Senior Network System Administrator',
            'Telecommunications Specialist',
            'Cloud Architect',
            'Cloud Consultant',
            'Cloud Product and Project Manager',
            'Cloud Services Developer',
            'Cloud Software and Network Engineer',
            'Cloud System Administrator',
            'Cloud System Engineer',
        ];
        foreach ($positions as $position) {
            $admin_add = rand(10000000, 99999999);
            Position::create([
                'position' => $position,
                'level' => rand(1, 5),
                'admin_created_id' => $admin_add,
                'admin_updated_id' => $admin_add,
            ]);
        }
    }

}
