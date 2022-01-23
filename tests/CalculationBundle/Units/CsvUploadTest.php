<?php

namespace Tests\CalculationBundle\Units;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CsvUploadTest extends WebTestCase
{
    
    /** @test */
    public function testFileExist() {
        $file_path = __DIR__ . '/testdata/data.csv';
        $this->assertFileExists($file_path);
    }
    
    public function testUpload() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        // Retrieve the Form object for the form belonging to this button.
        $form = $crawler->filter('button[type=submit]')->form();
        $form['file_csv_upload_form[upload_file]']->upload(__DIR__ . '/testdata/data.csv');
        $client->submit($form);
    }

}

