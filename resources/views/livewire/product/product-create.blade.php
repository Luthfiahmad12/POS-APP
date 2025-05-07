<div>
    <div class="flex flex-col lg:flex-row justify-between lg:items-center">
        <flux:heading size="xl" level="1">Create New Product</flux:heading>
        <flux:button href="{{ route('products.index') }}" variant="danger" wire:navigate>
            Back
        </flux:button>
    </div>
    <flux:separator variant="subtle" class="my-6" />

    <form wire:submit="save" class="max-w-md space-y-4">
        <flux:input wire:model="form.name" type="text" label="Product Name" />
        <flux:input wire:model="form.price" type="number" label="Price" />
        <flux:input wire:model="form.stock" type="number" label="Stock" />
        <flux:textarea wire:model="form.description" label="Description" />

        <flux:fieldset>
            <flux:legend>Active</flux:legend>
            <flux:switch wire:model="form.is_active"
                label="if set active, product will available in transaction page" />
            <flux:error name="form.is_active" />
        </flux:fieldset>
        <flux:button type="submit" variant="primary">Submit</flux:button>
    </form>
</div>
