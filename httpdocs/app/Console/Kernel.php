<?php

namespace App\Console;

use Exception;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Models\orders;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $orders = orders::whereRaw('UNIX_TIMESTAMP(now())-UNIX_TIMESTAMP(creditcardtime) > 7440')
                ->whereRaw('UNIX_TIMESTAMP(now())-UNIX_TIMESTAMP(creditcardtime) < 7560')
                ->whereRaw('status="paid"')
                ->get();

            // Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

            foreach ($orders as $order) {
                $strStripeChargeObject = trim($order->strip_id);
                //if($strStripeChargeObject=='ch_3NgVGCJnkMeImjxL1Zijpg1V')
                //{

                if (str_starts_with($strStripeChargeObject, 'pi_')) {
                    try {
                        $stripe->paymentIntents->capture(
                            $strStripeChargeObject,
                            []
                        );
                    } /*catch (Stripe\Exception\ApiErrorException $e) {
                            // Display a very generic error to the user, and maybe send
                            // yourself an email
                            $strErrorMessage = $e->getError()->message;
                            echo "Line 47: ".strErrorMessage;
                        }*/
                    catch (Exception $e) {
                        // Something else happened, completely unrelated to Stripe
                        $strErrorMessage = $e->getError()->message;
                        //echo "Line 52: ".strErrorMessage;
                    }
                } else {
                    try {
                        $stripe->charges->capture(
                            $strStripeChargeObject,
                            []
                        );
                    } /*catch (Stripe\Exception\ApiErrorException $e) {
                            // Display a very generic error to the user, and maybe send
                            // yourself an email
                            $strErrorMessage = $e->getError()->message;
                            echo "Line 47: ".strErrorMessage;
                        }*/
                    catch (Exception $e) {

                        // Something else happened, completely unrelated to Stripe
                        $strErrorMessage = $e->getError()->message;
                        //echo "Line 52: ".strErrorMessage;
                    }
                }
                //}


                //print_r($objCapture);
            }


        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
