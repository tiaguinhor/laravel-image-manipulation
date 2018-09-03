<?php

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageManipulationModelTest extends TestCase{

	public function testCreatingNewImage(){
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
