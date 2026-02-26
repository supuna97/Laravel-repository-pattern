<?php

namespace Tests\Unit;

use Tests\TestCase;
use Mockery;
use App\Services\Api\V1\Item\ItemService;
use App\Repositories\Api\V1\Interfaces\ItemRepositoryInterface;
use App\DTO\Api\V1\ItemDTO;
use App\Models\Item;
use PHPUnit\Framework\Attributes\Test;

class ItemServiceTest extends TestCase
{
    protected ItemService $service;
    protected $repo;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repo = Mockery::mock(ItemRepositoryInterface::class);
        $this->service = new ItemService($this->repo);
    }

    #[Test]
    public function it_creates_item_successfully(): void
    {
        $dto = ItemDTO::fromArray([
            'name' => 'Test Item',
            'description' => 'Desc',
            'price' => 100,
        ]);

        $item = new Item($dto->toArray());
        $this->repo->shouldReceive('create')->once()->andReturn($item);

        $result = $this->service->create($dto);
        $this->assertTrue($result->isOk());
        $this->assertEquals('Item created successfully', $result->unwrap()['message']);
    }

    #[Test]
    public function it_returns_error_if_create_fails(): void
    {
        $dto = ItemDTO::fromArray(['name' => 'Fail', 'price' => 100]);
        $this->repo->shouldReceive('create')->once()->andThrow(new \Exception('DB error'));

        $result = $this->service->create($dto);
        $this->assertTrue($result->isErr());
    }

    #[Test]
    public function it_returns_item_list(): void
    {
        $items = collect([new Item(['name' => 'A']), new Item(['name' => 'B'])]);
        $this->repo->shouldReceive('getAll')->once()->andReturn($items);

        $result = $this->service->getItemList();
        $this->assertTrue($result->isOk());
        $this->assertCount(2, $result->unwrap());
    }

    #[Test]
    public function it_returns_item_by_id_success_or_error(): void
    {
        $item = new Item(['name' => 'A']);
        // Success Case
        $this->repo->shouldReceive('getById')->with(1)->once()->andReturn($item);
        $result = $this->service->getItemById(1);
        $this->assertTrue($result->isOk());
        $this->assertEquals('A', $result->unwrap()->name);

        // Error Case
        $this->repo->shouldReceive('getById')->with(99)->once()->andReturn(null);
        $resultNotFound = $this->service->getItemById(99);
        $this->assertTrue($resultNotFound->isErr());
    }

    #[Test]
    public function it_updates_item_success_or_error(): void
    {
        $dto = ItemDTO::fromArray(['price' => 500, 'is_active' => true]);
        $item = Mockery::mock(Item::class);

        // Success Case
        $this->repo->shouldReceive('updateItem')
            ->with(1, $dto->toArray())
            ->once()
            ->andReturn($item);

        $result = $this->service->updateItem(1, $dto);
        $this->assertTrue($result->isOk());

        // Error Case
        $this->repo->shouldReceive('updateItem')
            ->with(99, $dto->toArray())
            ->once()
            ->andReturn(null);

        $resultNotFound = $this->service->updateItem(99, $dto);
        $this->assertTrue($resultNotFound->isErr());
    }

    #[Test]
    public function it_deletes_item_success_or_error(): void
    {
        // Success Case
        $this->repo->shouldReceive('deleteItem')
            ->with(1)
            ->once()
            ->andReturn(true);

        $result = $this->service->deleteItem(1);
        $this->assertTrue($result->isOk());

        // Error Case
        $this->repo->shouldReceive('deleteItem')
            ->with(99)
            ->once()
            ->andReturn(false);

        $resultNotFound = $this->service->deleteItem(99);
        $this->assertTrue($resultNotFound->isErr());
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
