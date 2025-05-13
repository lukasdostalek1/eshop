<?php
class OrderItem implements JsonSerializable {
    private ?int $id;
    private Product $product;
    private int $itemPrice;
    private int $quantity;
    private string $productSize;
    private string $productColor;

    public function __construct(Product $product, int $quantity, string $productSize, string $productColor, ?int $id = null) {
        $this->id = $id;
        $this->product = $product;
        $this->quantity = $quantity;
        $this->productColor = $productColor;
        $this->productSize = $productSize;
        $this->itemPrice = $product->getPrice() * $quantity;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getProductId() {
        return $this->product->getId();
    }

    public function getItemPrice(): int {
        return $this->itemPrice;
    }

    public function getQuantity(): int {
        return $this->quantity;
    }

    public function getProductSize(): string {
        return $this->productSize;
    }

    public function getProductColor(): string {
        return $this->productColor;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function setProductId(int $product_id): void {
        $this->product_id = $product_id;
    }

    public function setItemPrice(int $itemPrice): void {
        $this->itemPrice = $itemPrice;
    }

    public function setQuantity(int $quantity): void {
        $this->quantity = $quantity;
    }

    public function setProductSize(string $productSize): void {
        $this->productSize = $productSize;
    }

    public function setProductColor(string $productColor): void {
        $this->productColor = $productColor;
    }


    public function jsonSerialize(): mixed {
        return [
            'id' => $this->id,
            'product_id' => $this->getProductId(),
            'itemPrice' => $this->itemPrice,
            'quantity' => $this->quantity,
            'productSize' => $this->productSize,
            'productColor' => $this->productColor,
        ];
    }
}

