<h1>Simulated Slot Machine</h1>

<p>Simulated Slot Machine is an open-source project that implements a simplified version of a slot machine using Laravel Lumen. It allows you to simulate spins on a slot machine and calculates the winnings based on the matched paylines. The output is a valid machine-readable JSON object.</p>

<h2>Project Structure</h2>

<pre>
.
├── src/                      Source code folder. Add your implementation inside this folder.
│   │
│   └── lumen/                Laravel Lumen 8 installation folder
│       │
│       ├── app/              Lumen folder for the framework logic. Create files in this subfolder.
│       │
│       ├── tests/            Automated tests folder. You can add extra tests here if needed.
│       │
│       ├── artisan           The artisan CLI entrypoint
│       │
│       ├── composer.json     Composer file for 3rd party dependencies (do not modify)
│       ├── composer.lock     Composer file for 3rd party dependencies (do not modify)
│       │
│       └── ...
│
├── composer.json             Dependencies for our assessment tester. Ignore this file.
│
└── README.md                 This README.md file
</pre>

<h2>Installation</h2>

<p>To get started with the Simulated Slot Machine project:</p>

<ol>
  <li>Make sure you have Laravel Lumen installed and set up on your system.</li>
  <li>Clone this repository and navigate to the <code>src</code> folder.</li>
  <li>Run <code>composer install</code> in the <code>src/lumen</code> folder to install the required dependencies.</li>
</ol>

<h2>Usage</h2>

<p>To use the Simulated Slot Machine:</p>

<ol>
  <li>Implement your code in the <code>src/lumen/app</code> folder. You can create custom commands, modify existing files, or add new files as needed.</li>
  <li>Run the command <code>php src/lumen/artisan slot</code> to execute the slot machine command.</li>
  <li>The command will generate a random board of symbols and evaluate the paylines to calculate the winnings.</li>
  <li>The output will be a valid machine-readable JSON object containing the board, matched paylines, bet amount, and total win.</li>
  <li>You can also use the <code>--force</code> option followed by a comma-separated list of symbols to force a specific spin result for testing purposes. For example: <code>php src/lumen/artisan slot --force=J,J,J,Q,K,cat,J,Q,monkey,bird,bird,A,J,J,J</code>.</li>
</ol>

<h2>Paylines and Payouts</h2>

<p>The Simulated Slot Machine uses the following paylines for evaluating winnings:</p>

<ul>
  <li>Payline 1: 0 3 6 9 12</li>
  <li>Payline 2: 1 4 7 10 13</li>
  <li>Payline 3: 2 5 8 11 14</li>
  <li>Payline 4: 0 4 8 10 12</li>
  <li>Payline 5: 2 4 6 10 14</li>
</ul>

<p>The payouts are as follows:</p>

<ul>
  <li>3 symbols: 20% of the bet</li>
  <li>4 symbols: 200% of the bet</li>
  <li>5 symbols: 1000% of the bet</li>
</ul>

<h2>Contributing</h2>

<p>Simulated Slot Machine is an open-source project, and contributions are welcome. Feel free to submit pull requests with your improvements, bug fixes, or new features.</p>

<h2>License</h2>

<p>Simulated Slot Machine is open-source software licensed under the MIT license.</p>

<p>Enjoy simulating spins on the Slot Machine and calculating your winnings!</p>
