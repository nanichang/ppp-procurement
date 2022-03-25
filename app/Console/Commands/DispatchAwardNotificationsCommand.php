<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Sales;
use App\Award;
use Illuminate\Support\Facades\Mail;
use App\Mail\AwardNotificationContractorMail;

class DispatchAwardNotificationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dispatch:award-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $sale;
    protected $award;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Sales $sale, Award $award)
    {
        parent::__construct();
        $this->sale = $sale;
        $this->award = $award;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Mail::to($this->sale['contractor']['email'])->send(new AwardNotificationContractorMail(
            $this->sale['contractor']['company_name'], 
            $this->award['award_letter_comment']
        ));
    }
}
