<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SlotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slot {--force= : Force the spin result with comma-separated list of symbols}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Slot machine command that outputs JSON';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Define the symbols that can appear on the slot machine
        $symbols = ['9', '10', 'J', 'Q', 'K', 'A', 'cat', 'dog', 'monkey', 'bird'];

        $force = $this->option('force');
        if ($force) {
            $board = explode(',', $force);
        } else {
            // Generate a random array of 15 symbols
            $board = array();
            for ($i = 0; $i < 15; $i++) {
                $symbol = $symbols[array_rand($symbols)];
                $board[] = $symbol;
            }
        }

        // Define the paylines
        $paylines = [
            [0, 3, 6, 9, 12],
            [1, 4, 7, 10, 13],
            [2, 5, 8, 11, 14],
            [0, 4, 8, 10, 12],
            [2, 4, 6, 10, 14],
        ];

        // Loop through the paylines and check for matches
        $matchedPaylines = [];
        foreach ($paylines as $i => $payline) {
            $symbols = array_slice($board, $payline[0], 5);
            $matches = 0;
            foreach ($symbols as $symbol) {
                if (count(array_keys($symbols, $symbol)) == 5) {
                    $matches = 5;
                    break;
                } else if (count(array_keys($symbols, $symbol)) == 4) {
                    $matches = 4;
                } else if (count(array_keys($symbols, $symbol)) == 3) {
                    $matches = 3;
                }
            }
            if ($matches > 0) {
                $paylineKey = json_encode($payline);
                $matchedPaylines[] = [
                    $paylineKey => $matches,
                ];
            }
        }

        // Calculate the total win based on the matched paylines
        $totalWin = 0;
        foreach ($matchedPaylines as $payline) {
            $matches = reset($payline);
            switch ($matches) {
                case 3:
                    $totalWin += 20;
                    break;
                case 4:
                    $totalWin += 200;
                    break;
                case 5:
                    $totalWin += 1000;
                    break;
                default:
                    break;
            }
        }

        // Create the output JSON object
        $output = [
            'board' => $board,
            'paylines' => $matchedPaylines,
            'bet_amount' => 100,
            'total_win' => $totalWin,
        ];

        // Output the JSON object
        $this->info(json_encode($output));
    }


}
