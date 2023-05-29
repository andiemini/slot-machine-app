<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;

class AssessmentTest extends TestCase
{
    /**
     * Test if the framework is working properly
     *
     * @return void
     */
    public function test_artisan_cli_is_working()
    {
        self::assertStringContainsString(
            "Lumen",
            $this->app->version()
        );
    }

    /**
     * Test if the slot command is implemented
     *
     * @return void
     */
    public function test_slot_command_exists()
    {
        $this->app->withFacades();
        $artisanCommands = Artisan::all();
        self::assertArrayHasKey("slot", $artisanCommands);
    }

    /**
     * Test if the slot command is accepts a --force parameter
     *
     * @return void
     */
    public function test_slot_command_has_force_param()
    {
        $this->app->withFacades();
        $slotCommandOptions = Artisan::all()["slot"]->getDefinition()->getOptions();
        $this->assertArrayHasKey("force", $slotCommandOptions);
    }

    /**
     * Test if the slot command is accepts a --force parameter
     *
     * @return void
     */
    public function test_slot_command_force_param_is_optional()
    {
        $this->app->withFacades();
        $slotCommandForceOption = Artisan::all()["slot"]->getDefinition()->getOptions()["force"];
        $this->assertTrue($slotCommandForceOption->isValueOptional());
    }

    /**
     * Test if the output of the artisan command is a machine-readable JSON
     *
     * @return void
     */
    public function test_output_is_machine_readable_json()
    {
        $this->app->withFacades();
        Artisan::call("slot");
        $result = Artisan::output();
        json_decode($result);
        $json_conversion_error_code = json_last_error();
        $json_conversion_error_message = json_last_error_msg();
        self::assertEquals(JSON_ERROR_NONE, $json_conversion_error_code, "JSON conversion error [$json_conversion_error_code]: $json_conversion_error_message");
    }

    /**
     * Test if the output of the artisan command translates into an object
     *
     * @return void
     */
    public function test_output_is_json_object()
    {
        $this->app->withFacades();
        $artisanCommands = Artisan::call("slot");
        $result = Artisan::output();
        $jsonData = json_decode($result);
        self::assertIsObject($jsonData);
    }

    /**
     * Test if the JSON output has the correct structure
     *
     * @return void
     */
    public function test_validate_json_schema()
    {
        $this->app->withFacades();
        Artisan::call("slot");
        $result = Artisan::output();
        $jsonData = json_decode($result);

        self::assertObjectHasAttribute("board", $jsonData);
        self::assertObjectHasAttribute("paylines", $jsonData);
        self::assertObjectHasAttribute("bet_amount", $jsonData);
        self::assertObjectHasAttribute("total_win", $jsonData);

        self::assertIsArray($jsonData->board);
        self::assertIsArray($jsonData->paylines);
        self::assertIsInt($jsonData->bet_amount);
        self::assertIsInt($jsonData->total_win);

        foreach ($jsonData->paylines as $payline) {
            self::assertIsObject($payline);
        }
    }

    /**
     * Run the slot command multiple times to ensure it is valid despite the difference
     * between multiple runs
     *
     * @return void
     */
    public function test_exhaustive_json_schema()
    {
        for ($i = 0; $i < 100; $i++) {
            $this->test_validate_json_schema();
        }
    }

}
