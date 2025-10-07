use App\Models\Tag;

it('can access tag show page', function () {
    $tag = Tag::factory()->create(['name' => 'laravel']);
    $response = $this->get(route('tags.show', $tag->name));
    $response->assertStatus(200);
});