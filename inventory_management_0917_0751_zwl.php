<?php
// 代码生成时间: 2025-09-17 07:51:30
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection;

// InventoryItem class represents a single item in the inventory
class InventoryItem extends Model {
    use HasFactory;
    protected $fillable = ['name', 'quantity', 'price'];

    // Method to update the quantity of an item
    public function updateQuantity($newQuantity) {
        if ($newQuantity < 0) {
            throw new \u002f*Exception*/RuntimeException('Quantity cannot be negative.');
        }
        $this->quantity = $newQuantity;
        $this->save();
    }
}

// InventoryService class handles business logic for inventory operations
class InventoryService {
    // Method to add a new item to the inventory
    public function addItem(InventoryItem $item) {
        try {
            $item->save();
        } catch (\Exception $e) {
            // Log error and return a user-friendly message
            Log::error($e->getMessage());
            throw $e;
        }
    }

    // Method to update an item's quantity in the inventory
    public function updateItemQuantity(InventoryItem $item, $newQuantity) {
        try {
            $item->updateQuantity($newQuantity);
        } catch (\Exception $e) {
            // Log error and return a user-friendly message
            Log::error($e->getMessage());
            throw $e;
        }
    }

    // Method to remove an item from the inventory
    public function removeItem(InventoryItem $item) {
        try {
            $item->delete();
        } catch (\Exception $e) {
            // Log error and return a user-friendly message
            Log::error($e->getMessage());
            throw $e;
        }
    }
}

// InventoryController class handles HTTP requests for inventory operations
class InventoryController extends Controller {
    // Method to display the inventory items
    public function index() {
        $items = InventoryItem::all();
        return response()->json($items);
    }

    // Method to store a new inventory item
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric',
        ]);

        $item = new InventoryItem($validatedData);
        $service = new InventoryService();
        $service->addItem($item);

        return response()->json($item, 201);
    }

    // Method to update an inventory item
    public function update(Request $request, $id) {
        $item = InventoryItem::findOrFail($id);
        $validatedData = $request->validate([
            'quantity' => 'integer|min:0',
        ]);

        $service = new InventoryService();
        $service->updateItemQuantity($item, $validatedData['quantity']);

        return response()->json($item);
    }

    // Method to delete an inventory item
    public function destroy($id) {
        $item = InventoryItem::findOrFail($id);
        $service = new InventoryService();
        $service->removeItem($item);

        return response()->json(null, 204);
    }
}
