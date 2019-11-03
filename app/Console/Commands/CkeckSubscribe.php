<?php

namespace App\Console\Commands;

use App\Subscription;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CkeckSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ckeck:days';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'remove day everyday';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $subcribe = Subscription::where('user_id', auth()->user()->id)->first();
        $annualDate = $subcribe->annual;
        $monthlyDate = $subcribe->monthly;
        $freeDate = $subcribe->free;
        if ($annualDate == $currentDate || $monthlyDate == $currentDate || $freeDate == $currentDate)
        {
            $subcribe->update(array('expired' => 1));
            return "<script>
             alert('You should Pay To use Your System Again');
           </script>";
        }
        else {
            if ($annualDate != null) {
                $AnnualDateSub = Carbon::parse($annualDate)->subDay()->format('Y-m-d');
                $subcribe->update(array('annual' => $AnnualDateSub));
            } elseif ($monthlyDate != null) {
                $monthlyDateSub = Carbon::parse($monthlyDate)->subDay()->format('Y-m-d');
                $subcribe->update(array('monthly' => $monthlyDateSub));
            } else {
                $freeDateSub = Carbon::parse($freeDate)->subDay()->format('Y-m-d');
                $subcribe->update(array('free' => $freeDateSub));
            }

//        $subcribe=Subscription::where('user_id',auth()->user()->id)->first();
//          dd($subcribe);
        }
      $this->info($currentDate);
    }
}

