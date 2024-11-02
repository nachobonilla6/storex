<div x-data="{ imageUrl: @entangle('image_url') }">
    <div class="mt-2" x-show="imageUrl">
        <label class="block text-sm font-medium text-gray-700">Preview:</label>
        <img :src="imageUrl" class="mt-2 max-w-full h-auto border rounded-lg" alt="Image Preview" x-show="imageUrl"/>
    </div>
</div>
