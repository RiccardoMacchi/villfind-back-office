<?php

namespace App\Console\Commands;

use App\Models\Villain;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AssociateVillainCVs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'villains:associate-cvs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Associate the existing CV PDFs with their respective villains in the database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Path to the folder where the villain CVs are stored
        $cvFolderPath = public_path('storage/uploads/villain_cvs/');

        // Get all villains from the database
        $villains = Villain::all();

        // Loop through each villain
        foreach ($villains as $villain) {
            // Create the expected filename based on the villain's name
            $cvFileName = $villain->name . '_CV.pdf';
            $cvFilePath = $cvFolderPath . $cvFileName;

            // Check if the CV file exists
            if (File::exists($cvFilePath)) {
                // Update the cv_path field in the database
                $villain->cv = 'storage/uploads/villain_cvs/' . $cvFileName;
                $villain->save();

                // Output success message to the console
                $this->info('CV associated for villain: ' . $villain->name);
            } else {
                // Output failure message to the console
                $this->warn('No CV found for villain: ' . $villain->name);
            }
        }

        return 0;
    }
}
