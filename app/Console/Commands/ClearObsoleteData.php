<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Record;
use Illuminate\Console\Command;

class ClearObsoleteData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:obsoleteData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'a Scheduled Command to delete records that are 30 days old from database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{
            $ObsoleteRecordsCount = Record::where('created_at','<=',Carbon::now()->subDays(30))->delete();
            $this->info('The command was successful!, Number of obsolete records deleted is (' . $ObsoleteRecordsCount . ') at ' . Carbon::now());
            return Command::SUCCESS;
        }catch(\Exception $ex){
            $this->info('The command was not concluded successfully!');
            return Command::FAILURE;
        }
    }
}
