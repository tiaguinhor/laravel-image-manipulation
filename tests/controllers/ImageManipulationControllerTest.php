<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\AssertionsTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageManipulationControllerTest extends TestCase{

	public function testMainPage(){
		$response = $this->call('GET', '/');
		$response->assertOk();
	}

	public function testStoreAndRedirectToMain(){
		Storage::fake('avatars');

		$data = array(
			'photo-1' => UploadedFile::fake()->image('avatar.jpg'),
			'filter-grey-1' => 'true',
			'token' => csrf_token()
		);

		$response = $this->post('/', $data);
		$response->assertRedirect(URL::to('/'));
	}
}