@props(['headers' => []])

<div class="overflow-x-auto rounded border border-stone bg-white">
    <table class="w-full text-left text-sm">
        <thead class="border-b border-stone bg-ivory text-xs tracking-wide text-moss uppercase">
            <tr>
                @foreach ($headers as $header)
                    <th class="px-4 py-3 font-medium whitespace-nowrap">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-stone">
            {{ $slot }}
        </tbody>
    </table>
</div>
