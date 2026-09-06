<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class StockTest extends TestCase
{
    use RefreshDatabase;

    public function test_stock_quantity_is_updated_by_entries_and_exits(): void
    {
        $user = $this->createUser();
        $productId = DB::table('products')->insertGetId([
            'reference' => 'REF-001',
            'name' => 'Piece test',
            'minimum_stock' => 2,
            'active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $supplierId = DB::table('suppliers')->insertGetId([
            'name' => 'Fournisseur test',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->actingAs($user)->post(route('stock.entry'), [
            'product_id' => $productId,
            'supplier_id' => $supplierId,
            'quantity' => 10,
            'purchase_price' => 25,
            'entry_date' => '2026-09-05',
        ])->assertRedirect(route('stock'));

        $this->assertDatabaseHas('stock_entries', [
            'product_id' => $productId,
            'quantity' => 10,
        ]);
        $entryDocument = DB::table('stock_entries')
            ->where('product_id', $productId)
            ->first();
        $this->assertStringStartsWith('%PDF', $entryDocument->document_pdf);
        $this->assertDatabaseHas('products', [
            'id' => $productId,
            'quantity' => 10,
        ]);

        $this->actingAs($user)->post(route('stock.exit'), [
            'product_id' => $productId,
            'quantity' => 3,
            'reason' => 'Vente test',
            'exit_date' => '2026-09-05',
        ])->assertRedirect(route('stock'));

        $this->assertDatabaseHas('stock_exits', [
            'product_id' => $productId,
            'quantity' => 3,
        ]);
        $exitDocument = DB::table('stock_exits')
            ->where('product_id', $productId)
            ->first();
        $this->assertStringStartsWith('%PDF', $exitDocument->document_pdf);
        $this->actingAs($user)
            ->get(route('stock.entry.document', $entryDocument->id))
            ->assertOk()
            ->assertHeader('Content-Type', 'application/pdf');
        $this->actingAs($user)
            ->get(route('stock.exit.document', $exitDocument->id))
            ->assertOk()
            ->assertHeader('Content-Type', 'application/pdf');

        $currentStock = DB::table('stock_entries')->where('product_id', $productId)->sum('quantity')
            - DB::table('stock_exits')->where('product_id', $productId)->sum('quantity');

        $this->assertSame(7, $currentStock);
        $this->assertDatabaseHas('products', [
            'id' => $productId,
            'quantity' => 7,
        ]);
        $this->actingAs($user)->get(route('stock'))
            ->assertOk()
            ->assertSee('7');
    }

    public function test_stock_exit_cannot_exceed_available_quantity(): void
    {
        $user = $this->createUser();
        $productId = DB::table('products')->insertGetId([
            'reference' => 'REF-002',
            'name' => 'Piece test 2',
            'minimum_stock' => 0,
            'active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->actingAs($user)->post(route('stock.exit'), [
            'product_id' => $productId,
            'quantity' => 1,
            'exit_date' => '2026-09-05',
        ])->assertSessionHasErrors('quantity');

        $this->assertDatabaseCount('stock_exits', 0);
    }

    private function createUser()
    {
        return User::factory()->create(['role' => 'admin']);
    }
}