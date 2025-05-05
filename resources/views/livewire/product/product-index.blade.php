<div>
    <flux:heading size="xl" level="1" class="mb-6">Product List</flux:heading>
    <flux:separator variant="subtle" />

    <div id="table">
        <div
            class="overflow-hidden w-full overflow-x-auto rounded-radius border border-outline dark:border-outline-dark">
            <table class="w-full text-left text-sm text-on-surface dark:text-on-surface-dark">
                <thead
                    class="border-b border-outline bg-surface-alt text-sm text-on-surface-strong dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark-strong uppercase">
                    <tr>
                        <th scope="col" class="p-4">sku</th>
                        <th scope="col" class="p-4">Name</th>
                        <th scope="col" class="p-4">price</th>
                        <th scope="col" class="p-4">stock</th>
                        <th scope="col" class="p-4">description</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline dark:divide-outline-dark">
                    @foreach ($products as $item)
                        <tr>
                            <td class="p-4">{{ $item->sku }}</td>
                            <td class="p-4">{{ $item->name }}</td>
                            <td class="p-4">{{ $item->price }}</td>
                            <td class="p-4">{{ $item->stock }}</td>
                            <td class="p-4">{{ Str::limit($item->description, 50) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
